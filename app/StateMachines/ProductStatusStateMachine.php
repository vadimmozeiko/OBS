<?php

namespace App\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class ProductStatusStateMachine extends StateMachine
{
    public function recordHistory(): bool
    {
        return true;
    }

    public function transitions(): array
    {
        return [
            'available' => ['unavailable', 'broken'],
            'unavailable' => ['available', 'broken'],
            'broken' => ['unavailable', 'available'],
        ];
    }

    public function defaultState(): ?string
    {
        return 'available';
    }
}
