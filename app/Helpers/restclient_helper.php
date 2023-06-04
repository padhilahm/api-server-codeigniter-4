<?php

function akses_restapi($method, $url, $data)
{
    $client = \Config\Services::curlrequest();
    $token = "";
    $headers = [
        'Authorization' => 'Bearer ' . $token
    ];

    $response = $client->request(
        $method,
        $url,
        [
            'headers' => $headers,
            'form_params' => $data,
            'http_errors' => false
        ]
    );

    return $response->getBody();
}
