<?php

namespace App\Services;

use App\Models\DeliveryService;
use GuzzleHttp\Client;

class NovaPostService
{

    public $delivery_service;
    public $delivery_data_response;

    public function __construct()
    {
        $this->delivery_service = DeliveryService::where('slug', 'nova_post');
    }

    public function deliveryData($data)
    {
        try {

            $base_url = config('delivery_services.nova_post.base_url');
            $api_key = config('delivery_services.nova_post.api_key');

            $end_point = $base_url . '/delivery';

            $headers = [
                'Content-type' => 'application/json',
                'X-TXC-APIKEY' => $api_key,
            ];

            $client = new Client();
            $response = $client->request('POST', $end_point, [
                'headers' => $headers,
                'body' => $data,
            ]);

            $api_response = $response->getBody()->getContents();
            $json_array_response = json_decode($api_response);
            $this->delivery_data_response = $json_array_response;

            return true;

        } catch (\Exception $e) {
            // Handle any exceptions or errors here
            $this->error('Error fetching currency rates: ' . $e->getMessage());
        }

    }
}
