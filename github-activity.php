<?php

// Ponto de entrada da aplicação.
// Este arquivo é responsável por processar os argumentos da linha de comando,
// buscar os dados da atividade do usuário e exibi-los no terminal.

// Carrega o autoloader do Composer para que as classes sejam encontradas.
require __DIR__ . '/vendor/autoload.php';

use App\GitHubClient;
use App\EventParser;

// `$argv` é um array que contém os argumentos passados para o script.
// O primeiro elemento (`$argv[0]`) é sempre o nome do script.
// `array_shift` remove o primeiro elemento do array.
$args = $argv;
array_shift($args);

// O primeiro argumento após o nome do script é o nome de usuário.
$username = array_shift($args);

// Se o nome de usuário não for fornecido, exibe uma mensagem de uso e encerra o script.
if (!$username) {
    echo "Uso: php github-activity.php <username> [--type=<event_type>]\n";
    exit(1);
}

// O tipo de evento é opcional.
$type = null;

// Itera sobre os argumentos restantes para encontrar o filtro de tipo.
foreach ($args as $arg) {
    // Verifica se o argumento começa com `--type=`.
    if (strpos($arg, '--type=') === 0) {
        // Extrai o valor do tipo de evento.
        $type = substr($arg, 7);
    }
}

// Cria uma instância do cliente da API do GitHub.
$client = new GitHubClient();
// Busca a atividade do usuário.
$activity = $client->getUserActivity($username);

// Se um tipo de evento foi fornecido, filtra a atividade.
if ($type) {
    // `array_filter` itera sobre o array e retorna apenas os elementos
    // para os quais a função anônima (closure) retorna `true`.
    $activity = array_filter($activity, fn($event) => $event['type'] === $type);
}

// Cria uma instância do parser de eventos.
$parser = new EventParser();
// Formata a atividade.
$parsedActivity = $parser->parse($activity);

// Exibe a atividade formatada no terminal.
foreach ($parsedActivity as $parsedEvent) {
    echo $parsedEvent . "\n";
}

