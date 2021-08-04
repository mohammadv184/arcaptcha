<?php

namespace Mohammadv184\ArCaptcha\Adapter;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use phpDocumentor\Reflection\Types\True_;

class Http implements Adapter
{
    /**
     * User Site Key
     * @var string
     */
    protected $site_key;

    /**
     * User Secret Key
     * @var string
     */
    protected $secret_key;

    /**
     * guzzle http client
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Http Constructor
     * @param string $site_key
     * @param string $secret_key
     * @param string $base_uri
     */
    public function __construct(string $site_key, string $secret_key, string $base_uri)
    {
        $this->site_key = $site_key;

        $this->secret_key = $secret_key;

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $base_uri
        ]);
    }

    /**
     * submit Request
     * @param string $challenge_id
     * @return array
     * @throws GuzzleException
     */
    public function submit(string $challenge_id):array
    {

        $response = $this->client->post('challenges/verify' ,[
            'json'=>[
                'challenge_id' => $challenge_id,
                'site_key' => $this->site_key,
                'secret_key' => $this->secret_key
            ]
        ]);

        return json_decode($response->getBody()->getContents(),true);
    }
}