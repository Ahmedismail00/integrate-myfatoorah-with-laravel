<?php

namespace App\Services;

//use App\Models\CLient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class MyFatoorahServices
{
    private $request_client;
    private $headers;
    private $base_url;

    /**
     * @param CLient $request_client
     */
    public function __construct(CLient $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('MYFATOORAH_BASE_URL');
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.env('MYFATOORAH_API_KEY')
        ];
    }

    /**
     * @param $method
     * @param $uri
     * @param array $body
     */
    public function buildRequest($method='POST', $uri, $body=[])
    {
        $request = new Request($method, $this->base_url.$uri, $this->headers);
        if (!$body) {
            return false;
        }

        $response = $this->request_client->send($request, [
            'json'=>$body
        ]);
        if ($response->getStatusCode() != 200) {
            return false;
        }
        $response = json_decode($response->getBody(), true);
        return $response;
    }

    /**
     * @param array $data
     */
    public function sendPayment($data)
    {
        $response = $this->buildRequest('POST', '/v2/SendPayment', $data);
        dd($response);
    }
}
