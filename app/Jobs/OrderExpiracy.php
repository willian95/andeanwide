<?php

namespace App\Jobs;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AdminPaymentRecjectionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class OrderExpiracy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(is_null($this->order->payment)) {
            $this->order->rejected_at = now();
            $this->order->observation = "La orden No. " . str_pad($this->order->id, 6, 0, STR_PAD_LEFT) . " ha sido eliminada por el sistema, la orden alcanzo su tiempo de expiración.";
            $this->order->save();
            event(new AdminPaymentRecjectionEvent($this->order->user, $this->order));

        }
    }
}
