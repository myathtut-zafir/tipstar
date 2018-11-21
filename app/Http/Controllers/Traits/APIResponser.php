<?php

/**
 * Created by PhpStorm.
 * User: myathtut
 * Date: 6/26/18
 * Time: 1:15 PM
 */

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Response;

trait APIResponser
{

    public function respondCollection($message, $data)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => $message,
            'data' => $data,
        ], 201);
    }

    protected function respondPermissionDenied()
    {
        return response()->json([
            'code' => 403,
            'message' => 'Permission denied',
        ], 200);
    }

    protected function exceptionResponse($msg, $code)
    {
        $result = [
            'code' => $code,
            'message' => $msg,
        ];

        return response()->json($result, 200);
    }


    protected function errorResponse($msg)
    {
        $result = [
            'code' => 426,
            'message' => $msg,
        ];

        return response()->json($result, 200);
    }


    public function respondSuccessMsgOnly($message)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => $message,
        ], 200);
    }
    public function responseSucessWithPaginateCustomize($limit, $data)
    {
        return response()->json([
            'pagination'=>[
                'status' => 'SUCCESS',
                'limit' => $limit,
                'status_code' => Response::HTTP_OK,
                'current_page' => $data->count(),
                'total_count' => $data->total(),
                'total_page' => ceil($data->total() / $data->perPage()),
                'hasMoreData' => $data->hasMorePages(),
                'next_page' => $data->nextPageUrl(),
            ],
            'matches' => collect($data->getCollection()),
        ], 200);
    }
}
