<?php

namespace App\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class NotificationStatusStateMachine extends StateMachine
{
    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            'new' => ['seen']
        ];
    }

    public function defaultState(): ?string
    {
        return 'new';
    }
}
