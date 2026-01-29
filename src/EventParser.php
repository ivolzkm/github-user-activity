<?php

namespace App;

class EventParser
{
    public function parse(array $events): array
    {
        $parsedEvents = [];

        foreach ($events as $event) {
            $parsedEvents[] = $this->parseEvent($event);
        }

        return $parsedEvents;
    }

    private function parseEvent(array $event): string
    {
        return match ($event['type']) {
            'PushEvent' => "{$event['actor']['login']} fez push para {$event['repo']['name']}",
            'CreateEvent' => "{$event['actor']['login']} criou {$event['payload']['ref_type']} {$event['payload']['ref']} em {$event['repo']['name']}",
            'WatchEvent' => "{$event['actor']['login']} começou a seguir {$event['repo']['name']}",
            default => "Evento desconhecido: {$event['type']}",
        };
    }
}
