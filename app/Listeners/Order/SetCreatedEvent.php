<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetCreatedEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderWasCreated  $event
     * @return void
     */
    public function handle(OrderWasCreated $event)
    {
        $event->order->events()->create([
            'event' => 'Order '. $event->order->reference .  ' was created!',
            'event_type' => 'info',
            'event_code' => 'ORDER_CREATED',
            'event_date' => now(),
            'event_initiator' => 'Client',
            'event_initiator_id' => $event->order->client->user->id,
        ]);

        $event->order->info()->create();
    }
}
