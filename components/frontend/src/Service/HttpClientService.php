<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;

/**
 * Example HTTP Service
 * Class HttpClientService
 */
class HttpClientService
{
    /** @var Client */
    private $httpClient;

    /** @var string */
    private $baseUri;

    public function __construct(string $baseUri)
    {
        $this->httpClient = new Client();
        $this->baseUri    = $baseUri;
    }

    /**
     * Get Hello String
     *
     * @param string $name
     *
     * @return string
     */
    public function getHelloString(string $name): string
    {
        $response = $this->httpClient->get(new Uri("{$this->baseUri}/hello/{$name}"), [
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $body   = $response->getBody();
        var_export($body.'');
        $object = \json_decode($body);

        return $object? $object->message : false;
    }

    /**
     * Get Goodbye String
     *
     * @param string $name
     *
     * @return string
     */
    public function getGoodbyeString(string $name): string
    {
        $response = $this->httpClient->get("{$this->baseUri}/goodbye/{$name}", [
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $body   = $response->getBody();
        $object = \json_decode($body);

        return $object? $object->message : false;
    }
}
