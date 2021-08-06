<?php

namespace App\Jobs;

use App\Services\MailService;
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


    public function __construct(private MailService $mailService,
                                private ?string        $event = null,
                                private ?Order         $order = null,
                                private                $pdf = null)
    {
        $this->pdf = base64_encode($pdf);
    }


    public function handle()
    {
        match ($this->event) {
            'notConfirmed' => $this->mailService->notConfirmed($this->order),
            'orderChange' => $this->mailService->orderChange($this->order),
            'cancelled' => $this->mailService->cancelled($this->order),
            'completed' => $this->mailService->completed($this->order, $this->pdf),
            'statusChange' => $this->mailService->statusChange($this->order),
        };
    }
}
