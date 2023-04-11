<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Database;
use Illuminate\Support\Str;

class User extends Model
{
    use Database;
    private $apiToken;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'api_token',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function __construct()
    {
        $this->apiToken = uniqid(base64_encode(Str::random(60)));
    }

    /**
     * validate api_token user
     * @param string $token
     * @param int $user_id
     * @return User user information
     */
    public function validateTokenUser($token, $userId): ?User
    {
        return User::where('id', $userId)
                    ->where('api_token', $token)
                    ->first();
    }

    public function saveOrUpdate(array $data): ?User
    {
        return $this->persist(User::class, $data);
    }


    public function login(array $data): ?array
    {
        $user = User::where('email', $data['email'])->first();
        $response = [
            "message" => "user not found",
            "status" => false,
            "data" => [],
            "statusCode" => 401
        ];

        if ($user) {

            if (password_verify($data['password'], $user->password)) {
                $user = User::saveOrUpdate([
                    "id" => $user->id,
                    "api_token" => $this->apiToken
                ]);
                $response["message"] = "User login successful";
                $response["status"] = true;
                $response["data"] = $user;
                $response["statusCode"] = 200;
                return $response;
            }

            $response["message"] = "User login failed";
        }

        return $response;
    }

    public function logout(array $data): array
    {
        
        $user = User::where('id', $data['user_id'])
                     ->where('api_token', $data['token'])
                     ->first();
        $response = [
            "message" => "user not found",
            "status" => false,
            "data" => [],
            "statusCode" => 401
        ];
        if ($user) {
            $user->api_token = null;
            $user->save();
            $response["message"] = "User logout successful";
            $response["status"] = true;
            $response["statusCode"] = 200;
            return $response;
        }
        return $response;
    }
}
