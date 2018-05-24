<?php

namespace App\Services;

use GuzzleHttp\Client;

class ClientService
{
    public function request($method, $url, $type, $data = null, $auth = null)
    {
        $client = new Client();
        $res = $client->request(
            $method,
            $url,
            [
                'headers' => [
                    'Authorization' => $auth,
                ],
                $type => $data
            ]
        );

        return json_decode($res->getBody(), true);
    }
}