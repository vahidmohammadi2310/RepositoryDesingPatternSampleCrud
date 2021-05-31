<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * @param Request username, password(national_code is password)
     * @return token and refresh_token
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login(Request $request)
    {
        $http = new Client();
        try {
            $response = $http->post(env('login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('client_id'),
                    "client_secret" => env('client_secret'),
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            return json_decode($response->getBody(),true);

        } catch (RequestException $e) {
            // To catch exactly error 400 use
            if ($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() == '400') {
                    return response()->json(['message'=>'نام کاربری یا کلمه عبور اشتباه است.'],400);
                }
            }
        }
    }

}
