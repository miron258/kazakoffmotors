<?php

namespace App\Jobs;

use App\Models\Cart\FormOrder\FormOrder;
use App\Notifications\FormOrderNotification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendFormOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $formOrder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FormOrder $formOrder)
    {
        $this->formOrder = $formOrder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin = User::where('id', 1)->first();
        $admin->notify(new FormOrderNotification($this->formOrder));
        $this->formOrder->notify(new FormOrderNotification($this->formOrder));
    }
}
