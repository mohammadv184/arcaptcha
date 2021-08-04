<?php

namespace Mohammadv184\ArCaptcha;

use GuzzleHttp\Exception\RequestException;
use Mohammadv184\ArCaptcha\Adapter\Http;

class ArCaptcha
{
    /**
     * Api Base Uri
     * @var string
     */
    protected $api_base_uri = 'https://api.arcaptcha.ir/';

    /**
     * Script Url
     * @var string
     */
    protected $script_url = 'https://widget.arcaptcha.ir/1/api.js';

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
     * Http Adapter
     * @var Http
     */
    protected $http;

    /**
     * ArCaptcha Constructor
     * @param string $site_key
     * @param string $secret_key
     */
    public function __construct(string $site_key , string $secret_key)
    {
        $this->site_key =$site_key;
        $this->secret_key = $secret_key;

        $this->http = new Http($this->site_key,$this->secret_key,$this->api_base_uri);
    }

    /**
     * Get ArCaptcha Script
     * @return string
     */
    public function getScript(): string
    {
        return sprintf('<script src="%s" async defer></script>',$this->script_url);
    }

    /**
     * Get Arcaptcha Widget
     * @return string
     */
    public function getWidget(): string
    {
        return sprintf('<div class="arcaptcha" data-site-key="%s"></div>',$this->site_key);
    }

    /**
     * Verify Captcha challenge id
     * @param string $challenge_id
     * @return bool
     */
    public function verify(string $challenge_id):bool
    {
        try {
            $response = $this->http->submit($challenge_id);

        }catch (RequestException $e){
            return false;
        }
        return ((array)$response)['status'];
    }

}