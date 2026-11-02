<?php

namespace App\Listeners;

use App\Support\BookingConfirmationSender;
use Lunar\Events\PaymentAttemptEvent;
use Lunar\Models\Order;

class SendBookingConfirmation
{
    public function handle(PaymentAttemptEvent $event): void
    {
        if (! $event->paymentAuthorize->success || ! $event->paymentAuthorize->orderId) {
            return;
        }

        $order = Order::find($event->paymentAuthorize->orderId);

        if ($order) {
            BookingConfirmationSender::send($order);
        }
    }
}
