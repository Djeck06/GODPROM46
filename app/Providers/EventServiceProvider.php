<?php

namespace App\Providers;

use App\Events\Order\OrderWasCreated;
use App\Events\Quotation\QuotationWasCreated;
use App\Listeners\Order\SetCreatedEvent;
use App\Listeners\Quotation\SendQuotationAdminNotification;
use App\Listeners\Quotation\SendQuotationClientNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderWasCreated::class => [
            SetCreatedEvent::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
