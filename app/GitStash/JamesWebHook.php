<?php

namespace App\GitStash;


use App\Repository;
use GuzzleHttp\Client;

class JamesWebHook
{

    protected $url = 'http://domain.tld';
    protected $endpoint = '/api_hook';
    protected $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function post(Repository $repository)
    {
        $this->guzzle->request('POST', $this->url . $this->endpoint,
            [
                'body' => $repository->toJson(),
                'timeout' => '1000',
                'headers' => [
                    'content-type' => 'application/json',
                ],
            ]);
    }

}