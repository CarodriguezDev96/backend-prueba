<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    RegisterUserRequest,
    LoginUserRequest,
    LogoutUserRequest,
    CreateMessageRequest
};
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Facades\App\Models\{
    User,
    ErrorLog,
    Message
};

class ServicesController extends Controller
{
    public function registerUser(RegisterUserRequest $request): array
    {
        try {
            $data = $request->all();
            $data["password"] = Hash::make($data["password"]);
            $user = User::saveOrUpdate($data);
            if ($user) {
                return [
                    "status" => true,
                    "message" => "User successfully created.",
                    "data" => $user,
                    'statusCode' => 201
                ];
            }
            return [
                "status" => false,
                "message" => "User not created.",
                "data" => [],
                'statusCode' => 501
            ];
        } catch (\Throwable $th) {
            $error = [
                'type'       => 'registerUser',
                'error'      => $th->getMessage(),
                'created_at' => date('Y-m-d H:i:s')
            ];
            ErrorLog::saveOrUpdate($error);
            return [false, $th->getMessage(), []];
        }
    }

    
    public function loginUser(LoginUserRequest $request): array
    {
        try {
            $data = $request->all();
            return User::login($data);
        } catch (\Throwable $th) {
            $error = [
                'type'       => 'loginUser',
                'error'      => $th->getMessage(),
                'created_at' => date('Y-m-d H:i:s')
            ];
            ErrorLog::saveOrUpdate($error);
            return [false, $th->getMessage(), []];
        }
    }

    public function logoutUser(LogoutUserRequest $request): array
    {
        try {
            $data = $request->all();
            $data['token'] = $request->header('Authorization');
            return User::logout($data);
        } catch (\Throwable $th) {
            $error = [
                'type'       => 'logoutUser',
                'error'      => $th->getMessage(),
                'created_at' => date('Y-m-d H:i:s')
            ];
            ErrorLog::saveOrUpdate($error);
            return [false, $th->getMessage(), []];
        }
    }

    public function saveMessage(CreateMessageRequest $request)
    {
        try {
            $data = $request->all();
            $message = Message::saveOrUpdate($data);

            if ($message) {
                return [
                    "status" => true,
                    "message" => "Message successfully created.",
                    "data" => $message,
                    'statusCode' => 201
                ];
            }
            return [
                "status" => false,
                "message" => "Message not created.",
                "data" => [],
                'statusCode' => 501
            ];
        } catch (\Throwable $th) {
            $error = [
                'type'       => 'logoutUser',
                'error'      => $th->getMessage(),
                'created_at' => date('Y-m-d H:i:s')
            ];
            ErrorLog::saveOrUpdate($error);
            return [false, $th->getMessage(), []];
        }
    }

}
