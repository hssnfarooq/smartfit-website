@php
    $meta = (array) $order->meta;
    $vehicle = (array) ($meta['vehicle'] ?? []);
    $location = (array) ($meta['service_location'] ?? []);
    $appointments = (array) ($meta['preferred_appointments'] ?? []);
@endphp
<!doctype html>
<html lang="en">
<body style="margin:0; padding:24px; background:#f3f4f6; color:#202124; font-family:Arial, Helvetica, sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; width:100%; background:#ffffff; border:1px solid #e4e5e7; border-radius:10px; overflow:hidden;">
                <tr>
                    <td style="padding:28px 32px; text-align:center; border-bottom:4px solid #ed1e24;">
                        <a href="{{ env('APP_URL') }}"><img src="{{ env('APP_URL').env('INVOICE_LOGO') }}" alt="Smartfit Autos" style="max-width:180px; height:auto;"></a>
                        <h1 style="margin:24px 0 8px; font-size:26px;">Your booking is confirmed</h1>
                        <p style="margin:0; color:#60646c;">Thank you, {{ $order->billingAddress?->fullName }}. We have received your booking and payment.</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:26px 32px;">
                        <table role="presentation" width="100%" cellpadding="7" cellspacing="0" border="0" style="font-size:15px;">
                            <tr><td style="color:#60646c;">Booking reference</td><td align="right"><strong>{{ $order->reference }}</strong></td></tr>
                            <tr><td style="color:#60646c;">Payment status</td><td align="right"><strong>Paid</strong></td></tr>
                            <tr><td style="color:#60646c;">Total paid</td><td align="right"><strong>{{ $order->total->formatted }}</strong></td></tr>
                        </table>

                        <h2 style="margin:28px 0 12px; font-size:19px;">Vehicle</h2>
                        <table role="presentation" width="100%" cellpadding="7" cellspacing="0" border="0" style="font-size:15px; background:#f7f7f8; border-radius:8px;">
                            <tr><td style="color:#60646c;">Registration</td><td align="right"><strong>{{ $vehicle['registration'] ?? 'Not provided' }}</strong></td></tr>
                            <tr><td style="color:#60646c;">Make and model</td><td align="right">{{ trim(($vehicle['make'] ?? '').' '.($vehicle['model'] ?? '')) ?: 'Not provided' }}</td></tr>
                            @if(!empty($vehicle['fuel_type']))
                                <tr><td style="color:#60646c;">Fuel type</td><td align="right">{{ $vehicle['fuel_type'] }}</td></tr>
                            @endif
                        </table>

                        <h2 style="margin:28px 0 12px; font-size:19px;">Service centre</h2>
                        <p style="margin:0; font-size:15px; line-height:1.6;">
                            <strong>{{ $location['title'] ?? 'Smartfit Autos' }}</strong><br>
                            {{ $location['address'] ?? '7 Welland Rd, Dogsthorpe, Peterborough, PE1 3SA' }}
                            @if(!empty($location['phone']))<br>{{ $location['phone'] }}@endif
                        </p>

                        <h2 style="margin:28px 0 12px; font-size:19px;">Preferred appointments</h2>
                        @forelse($appointments as $appointment)
                            <p style="margin:0 0 6px; font-size:15px;">{{ $appointment['date'] ?? '' }}{{ !empty($appointment['time_of_day']) ? ' — '.$appointment['time_of_day'] : '' }}</p>
                        @empty
                            <p style="margin:0; font-size:15px; color:#60646c;">The garage will contact you to confirm your appointment time.</p>
                        @endforelse

                        <h2 style="margin:28px 0 12px; font-size:19px;">Services</h2>
                        <table role="presentation" width="100%" cellpadding="9" cellspacing="0" border="0" style="font-size:15px; border-collapse:collapse;">
                            @foreach($order->digitalLines as $line)
                                <tr style="border-bottom:1px solid #e4e5e7;">
                                    <td>{{ $line->description }}</td>
                                    <td align="right"><strong>{{ $line->sub_total->formatted }}</strong></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td style="padding-top:14px;"><strong>Total paid</strong></td>
                                <td align="right" style="padding-top:14px;"><strong>{{ $order->total->formatted }}</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px 32px; background:#18191c; color:#ffffff; text-align:center; font-size:13px; line-height:1.6;">
                        {{ env('PDF_ORDER_NAME') }}<br>
                        7 Welland Rd, Dogsthorpe, Peterborough, PE1 3SA<br>
                        01733 569998
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
