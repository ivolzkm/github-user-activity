<?php

namespace App;

/**
 * Class EventParser
 *
 * Responsável por traduzir e formatar os eventos da API do GitHub.
 */
class EventParser
{
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
     * Formata um único evento da API do GitHub.
     *
     * @param array $event Um único evento da API do GitHub.
     * @return string Uma string com o evento formatado.
     */
    private function parseEvent(array $event): string
    {
        // A expressão `match` é uma alternativa mais moderna e legível ao `switch`.
        // Ela compara o tipo de evento e retorna a string formatada correspondente.
        return match ($event['type']) {
            'PushEvent' => "{$event['actor']['login']} fez push para {$event['repo']['name']}",
            'CreateEvent' => "{$event['actor']['login']} criou {$event['payload']['ref_type']} {$event['payload']['ref']} em {$event['repo']['name']}",
            'WatchEvent' => "{$event['actor']['login']} começou a seguir {$event['repo']['name']}",
            'PullRequestEvent' => "{$event['actor']['login']} {$event['payload']['action']} o pull request #{$event['payload']['pull_request']['number']} em {$event['repo']['name']}",
            // O `default` é usado para eventos que não foram mapeados.
            default => "Evento desconhecido: {$event['type']}",
        };
    }
}
