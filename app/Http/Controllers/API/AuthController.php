<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\LoginRequest;
use App\Models\User;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\StreamFactory;
use Laminas\Diactoros\UploadedFileFactory;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class AuthController extends AppBaseController
{
    //use AuthenticatesUsers;

    protected $accessTokenController;

    public function __construct(AccessTokenController $accessTokenController)
    {
        $this->accessTokenController = $accessTokenController;
    }

    public function login(Request $request) {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
  
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel-9-Passport-Auth')->accessToken;
            $output = [
                'name' => auth()->user()->name,
                'token' => $token
            ];

            return $this->sendResponse($output, 'Login Successfull');
        } else {
            return $this->sendError('Please check your email and password', 401);
        }
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return $this->sendSuccess('Successfully logged out');
    }
}
