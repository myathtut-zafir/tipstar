<?php

namespace App\Http\Controllers\Auth;

use App\Customer;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Traits\APIResponser;
use App\Http\Resources\CustomerResource;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class AuthController extends Controller
{
    use APIResponser;

    public function __construct()
    {
    }

    public function SocialSignUp(Request $request, $provider, Facebook $fb)
    {
        Log::info('all_not_in_try', ['data' => $request->all()]);
        try {
            Log::info('all_in_try', ['data' => $request->all()]);
            Log::debug("Social Sign Up");
            // retrieve form input parameters
//            $uid = request()->input('uid');
            $access_token = request()->input('access_token');
            // get long term access token for future use
            $oAuth2Client = $fb->getOAuth2Client();
            $access_token = $oAuth2Client->getLongLivedAccessToken($access_token)->getValue();
            $fb->setDefaultAccessToken($access_token);

            // call api to retrieve person's public_profile details
            $fields = "id,cover,name,first_name,last_name,email,age_range,link,gender,locale,picture,timezone,updated_time,verified";
            $fb_user = $fb->get('/me?fields=' . $fields)->getGraphUser();
            $fb_user['token'] = $access_token;

            $user = $this->convertToObject($fb_user);
        } catch (Exception $e) {
            Log::info('catch', ['data' => $request->all()]);
            Log::info('catch_message', ['data' => $e->getMessage()]);
            $responseData = ['message' => "$e->getMessage()"];
            return response($responseData, 400);
        }

        // Check user email exists
        if (empty($user->email)) {
            Log::info('no_email', ['data' => $user ?? ""]);
            $responseData = ['message' => "User email not exists.",];
            return response($responseData, 400);
        }

        // Save the data into the database
        $customer = $this->saveCustomerInfoAndLogin($user, $provider);


//        Log::info('end', ['data' => $userResponseData ?? ""]);
        return $this->respondCollection('You have been successfully logged in!',new CustomerResource(Customer::find($customer->id)));
//        return response($userResponseData, 201);
    }

    protected function saveCustomerInfoAndLogin($providerUser, $driver)
    {
        // check for already has account
        Log::info('save_db_enter', ['data' => $providerUser ?? ""]);
        $customer = Customer::where('email', $providerUser->email)->first();

        // if user already found
        if ($customer) {
            // update the avatar and provider that might have changed
            $customer->update([
                'avatar' => $providerUser->picture['url'],
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token,
                'messenger_user_id' => $providerUser->messenger_user_id ?? ""
            ]);

        } else {
            // create a new user
            $customer = Customer::create([
                'name' => $providerUser->name,
                'email' => $providerUser->email,
                'avatar' => $providerUser->picture['url'],
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token,
                'messenger_user_id' => $providerUser->messenger_user_id ?? "",

                // user can use reset password to create a password
                'password' => ''
            ]);
        }

        // login the user
//        auth('customer')->login($customer, true);
        Log::info('save_db_exit', ['data' => $customer ?? ""]);
        return $customer;
    }

    function convertToObject($array)
    {
        $object = new stdClass();
        foreach ($array as $key => $value) {
            $object->$key = $value;
        }

        return $object;

    }
}