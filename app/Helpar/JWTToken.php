<?php

namespace App\Helpar;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PhpParser\Node\Expr;

class JWTToken
{

    public static function createToken($userEmail, $userId)
    {
        $key = "abc";
        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 60,
            'userEmail' => $userEmail,
            'userId' => $userId
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function verifyToken($token)
    {
        try {
            if ($token == null) {
                return "unauthorized";
            } else {
                $key = 'abc';
                $decode =  JWT::decode($token, new Key($key, 'HS256'));
                return $decode;
            }
        } catch (Exception $e) {
            return "unauthorized";
        }
    }

    public static function createTokenForSetPassword($userEmail)
    {
        $key = "abc";
        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 60,
            'userEmail' => $userEmail,
            'userId' => "0"
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
}
