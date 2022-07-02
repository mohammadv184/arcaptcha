<?php

namespace Mohammadv184\ArCaptcha;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Mohammadv184\ArCaptcha\Adapter\Http;

class ArCaptcha
{
    /**
     * Api Base Uri
     * @var string
     */
    protected $api_base_uri = 'https://api.arcaptcha.ir/arcaptcha/api/';

    /**
     * Script Url
     * @var string
     */
    protected $script_url = 'https://widget.arcaptcha.ir/1/api.js';

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
    public function __construct(protected string $site_key, protected string $secret_key)
    {
        $this->http = new Http($this->site_key, $this->secret_key, $this->api_base_uri);
    }

    /**
     * Get ArCaptcha Script
     * @return string
     */
    public function getScript(): string
    {
        return sprintf('<script src="%s" async defer></script>', $this->script_url);
    }

    /**
     * Get Arcaptcha Widget
     * @return string
     */
    public function getWidget(): string
    {
        return sprintf('<div class="arcaptcha" data-site-key="%s"></div>', $this->site_key);
    }

    /**
     * Verify Captcha challenge id
     * @param string $challenge_id
     * @return bool
     */
    public function verify(string $challenge_id):bool
    {
        try {
            $response = $this->http->submit('verify', $challenge_id);
        } catch (GuzzleException $e) {
            return false;
        }
        return $response['success']??false;
    }
}
