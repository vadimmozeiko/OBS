<?php

namespace App\Jobs;

use App\Http\Controllers\MailController;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(private MailController $mailController,
                                private ?string        $event = null,
                                private ?Order         $order = null,
                                private                $pdf = null)
    {
        $this->pdf = base64_encode($pdf);
    }


    public function handle()
    {
        match ($this->event) {
            'notConfirmed' => $this->mailController->notConfirmed($this->order),
            'orderChange' => $this->mailController->orderChange($this->order),
            'cancelled' => $this->mailController->cancelled($this->order),
            'completed' => $this->mailController->completed($this->order, $this->pdf),
            'statusChange' => $this->mailController->statusChange($this->order),
        };
    }
}
