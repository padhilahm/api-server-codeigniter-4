<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\OtentikasiModel;

function getJWT($otentikasiHeader)
{
    if (is_null($otentikasiHeader)) {
        throw new Exception('Otentikasi JWT gagal');
    }
    return explode(' ', $otentikasiHeader)[1];
}

function validateJWT($encodeToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodedToken = JWT::decode(
        $encodeToken,
        new Key($key, 'HS256')
    );
    $otentikasiModel = new OtentikasiModel();
    $otentikasiModel->getEmail($decodedToken->email);
}

function createJWT($email)
{
    $requestTime = time();
    $tokenTime = getenv('JWT_TIME_TO_LIVE');
    $expiredTime = $requestTime + $tokenTime;
    $payload = array(
        "email" => $email,
        "iat" => $requestTime,
        "exp" => $expiredTime
    );
    $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
    return $jwt;
}
