<?php

namespace App;

use GuzzleHttp\Client;

class GitHubClient {
    private const API_URL = 'https://api.github.com';
    private Client $client;
    public function __construct(){
        $this->client = new Client(
        [
        
            'base_uri' => self::API_URL,
            'headers'=> [
                'Accept' => 'application/vnd.github.v3+json',
            ],
            ]);
            }

    public function getUserActivity(string $username): array {
        $response = $this->client->get("/users/{$username}/events");
        return json_decode($response->getBody()->getContents(), true);
    }
}