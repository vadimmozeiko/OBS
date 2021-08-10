<?php

namespace App\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class MessageStatusStateMachine extends StateMachine
{
    public function recordHistory(): bool
    {
        return true;
    }

    public function transitions(): array
    {
        return [
            'new' => ['read', 'replied'],
            'read' => ['replied']
        ];
    }

    public function defaultState(): ?string
    {
        return 'new';
    }
}
