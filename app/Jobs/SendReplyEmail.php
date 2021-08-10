<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Services\MailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReplyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private MailService $mailService;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Contact $contact, private array $request)
    {
        $this->mailService = new MailService();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->mailService->sendReply($this->contact, $this->request);
    }
}
