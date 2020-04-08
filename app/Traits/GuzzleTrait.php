<?php
namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait GuzzleTrait {

    public function apiRequest($url, $body, $step=0)
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];
        $client = new Client([
            'headers' => $headers
        ]);
        try {
            $request = $client->request(
                'POST',
                $url, [
                    'body' => json_encode($body)
                ]
            );
            $response = $request->getBody();
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $response = $response->getBody();
        }
        if($step === 1) {
            return json_decode($response->getContents(), true);
        }
        return $response->getContents();

    }
}
