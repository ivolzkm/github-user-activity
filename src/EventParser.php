<?php

namespace App;

/**
 * Class EventParser
 *
 * Responsável por traduzir e formatar os eventos da API do GitHub.
 */
class EventParser
{
    // Constantes de cores ANSI para o terminal.
    private const COLOR_GREEN = "\033[32m";
    private const COLOR_YELLOW = "\033[33m";
    private const COLOR_CYAN = "\033[36m";
    private const COLOR_RED = "\033[31m";
    private const COLOR_RESET = "\033[0m";

    /**
     * Itera sobre um array de eventos e os formata.
     *
     * @param array $events Um array de eventos da API do GitHub.
     * @return array Um array de strings com os eventos formatados.
     */
    public function parse(array $events): array
    {
        $parsedEvents = [];

        foreach ($events as $event) {
            $parsedEvents[] = $this->parseEvent($event);
        }

        return $parsedEvents;
    }

    /**
     * Formata um único evento da API do GitHub, adicionando cores.
     *
     * @param array $event Um único evento da API do GitHub.
     * @return string Uma string com o evento formatado.
     */
    private function parseEvent(array $event): string
    {
        $actor = self::COLOR_GREEN . $event['actor']['login'] . self::COLOR_RESET;
        $repo = self::COLOR_CYAN . $event['repo']['name'] . self::COLOR_RESET;

        // A expressão `match` é uma alternativa mais moderna e legível ao `switch`.
        // Ela compara o tipo de evento e retorna a string formatada correspondente.
        return match ($event['type']) {
            'PushEvent' => "{$actor} " . self::COLOR_YELLOW . "fez push para" . self::COLOR_RESET . " {$repo}",
            'CreateEvent' => "{$actor} " . self::COLOR_YELLOW . "criou {$event['payload']['ref_type']} {$event['payload']['ref']} em" . self::COLOR_RESET . " {$repo}",
            'WatchEvent' => "{$actor} " . self::COLOR_YELLOW . "começou a seguir" . self::COLOR_RESET . " {$repo}",
            'PullRequestEvent' => "{$actor} " . self::COLOR_YELLOW . "{$event['payload']['action']} o pull request #{$event['payload']['pull_request']['number']} em" . self::COLOR_RESET . " {$repo}",
            // O `default` é usado para eventos que não foram mapeados.
            default => self::COLOR_RED . "Evento desconhecido: {$event['type']}" . self::COLOR_RESET,
        };
    }
}
