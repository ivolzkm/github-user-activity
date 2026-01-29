<?php

require __DIR__ . '/vendor/autoload.php';

use App\GitHubClient;

use App\EventParser;

$args = $argv;
array_shift($args);

$username = array_shift($args);
$type = null;

foreach ($args as $arg) {
    if (strpos($arg, '--type=') === 0) {
        $type = substr($arg, 7);
    }
}

$client = new GitHubClient();
$activity = $client->getUserActivity($username);

if ($type) {
    $activity = array_filter($activity, fn($event) => $event['type'] === $type);
}

$parser = new EventParser();
$parsedActivity = $parser->parse($activity);

foreach ($parsedActivity as $parsedEvent) {
    echo $parsedEvent . "\n";
}

