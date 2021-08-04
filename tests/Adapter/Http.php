<?php

namespace Mohammadv184\ArCaptcha\Tests\Adapter;

use GuzzleHttp\Exception\RequestException;
use Mohammadv184\ArCaptcha\Adapter\Adapter;
use Mohammadv184\ArCaptcha\Tests\TestCase;
use Prophecy\Argument\Token\ArrayEntryToken;

class Http extends TestCase
{
    protected $http;

    protected function setUp(): void
    {
        $this->http = new \Mohammadv184\ArCaptcha\Adapter\Http('site_key', 'secret_key', 'https://httpbin.org/');
    }

    public function testInstance()
    {
        $this->assertInstanceOf(Adapter::class, $this->http);
    }
    public function testSubmit()
    {
        $response = $this->http->submit('post','challenge_id');

        $data = [
            'challenge_id'=>'challenge_id',
            'secret_key' => 'secret_key',
            'site_key' => 'site_key',
        ];

        $this->assertIsArray($response);

        $this->assertArrayHasKey('challenge_id',$response['json']);

        $this->assertArrayHasKey('secret_key',$response['json']);

        $this->assertArrayHasKey('site_key',$response['json']);

        $this->assertCount(3,$response['json']);

        $this->assertEquals($data,$response['json']);

    }
    public function testException(){
        $this->expectException(RequestException::class);

        $this->http->submit('status/404','challenge_id');
    }
}
