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

    private $message;
    private $requestOldResponse;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     * @param bool $requestOldResponse
     */
    public function __construct(Order $order, bool $requestOldResponse = false)
    {
        $this->order = $order;
        $this->requestOldResponse = $requestOldResponse;
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
        $this->message = $this->order->toArray();

        $this->transform();

        return $this->message;
    }

    /**
     * Transform the actual message
     */
    private function transform()
    {

        if ($this->requestOldResponse)
            $this->addOldFields();

        $this->addExtraFields();

    }

    /**
     * Add extra data to message
     */
    private function addExtraFields()
    {
        $extra = [
            'status_name' => $this->order->status->name,
            'status_percent' => $this->order->status->percent
        ];

        $this->message = array_merge($this->message, $extra);
    }

    /**
     * Add old fields to request
     */
    private function addOldFields()
    {

        $oldFields = [
            'status_deprecated' => 'This field is very deprecated, please dont use this',
        ];

        $this->message = array_merge($this->message, $oldFields);

    }


}
