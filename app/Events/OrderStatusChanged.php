<?php

namespace App\Events;

use App\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @param $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['private-pizza-tracker.' . $this->order->id, 'pizza-tracker'];
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        $extra = [
            'status_name' => $this->order->status->name,
            'status_percent' => $this->order->status->percent
        ];

        return array_merge($this->order->toArray(), $extra);
    }
}
