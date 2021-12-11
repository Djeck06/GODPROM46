<?php

namespace App\Listeners;

use App\Events\Quotation\QuotationWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendQuotationAdminNotification implements ShouldQueue
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
     * @param  QuotationWasCreated  $event
     * @return void
     */
    public function handle(QuotationWasCreated $event)
    {
        //
    }
}
