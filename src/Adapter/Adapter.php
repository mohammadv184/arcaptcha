<?php

namespace Mohammadv184\ArCaptcha\Adapter;

interface Adapter
{
    /**
     * Constructor
     * @param string $site_key
     * @param string $secret_key
     * @param string $base_uri
     */
    public function __construct(string $site_key, string $secret_key, string $base_uri);

    /**
     * Submit Request
     * @param string $challenge_id
     * @return mixed
     */
    public function submit(string $uri,string $challenge_id):array;
}