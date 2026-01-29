<?php

namespace App;

use GuzzleHttp\Client;

/**
 * Class GitHubClient
 *
 * Responsável por se comunicar com a API do GitHub.
 */
class GitHubClient
{
    /**
     * URL base da API do GitHub.
     */
    private const API_URL = 'https://api.github.com';

    /**
     * Instância do cliente Guzzle para fazer requisições HTTP.
     * @var Client
     */
    private Client $client;

    /**
     * Construtor da classe.
     *
     * Configura o cliente Guzzle com a URL base da API e o cabeçalho `Accept`
     * para garantir que estamos usando a versão 3 da API do GitHub.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::API_URL,
            'headers' => [
                'Accept' => 'application/vnd.github.v3+json',
            ],
            // Desativa a verificação do certificado SSL.
            // IMPORTANTE: Isso é inseguro e só deve ser usado para desenvolvimento local.
            'verify' => false,
        ]);
    }

    /**
     * Busca a atividade recente de um usuário no GitHub.
     *
     * @param string $username O nome de usuário do GitHub.
     * @return array Um array com os eventos da atividade do usuário.
     */
    public function getUserActivity(string $username): array
    {
        // Faz uma requisição GET para o endpoint de eventos do usuário.
        $response = $this->client->get("/users/{$username}/events");

        // Decodifica a resposta JSON para um array associativo e a retorna.
        return json_decode($response->getBody()->getContents(), true);
    }
}