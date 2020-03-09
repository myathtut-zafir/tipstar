<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    protected $fillable = ['name', 'email', 'avatar', 'provider', 'provider_id', 'access_token', 'messenger_user_id'];
}
