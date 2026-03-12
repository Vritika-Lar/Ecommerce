<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmation</title>
</head>
<body style="margin:0; padding:0; background:#f6f6f6; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f6f6f6; padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border:1px solid #e5e5e5; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="padding:24px; background:#0d6efd; color:#ffffff;">
                            <h1 style="margin:0; font-size:20px;">Order Confirmed</h1>
                            <p style="margin:6px 0 0; font-size:13px;">Thank you for your purchase.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <p style="margin:0 0 8px;">Hi {{ $order->address->name ?? 'Customer' }},</p>
                            <p style="margin:0 0 16px;">We have received your order. Here are your details:</p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
                                <tr>
                                    <td style="font-weight:bold; padding:4px 0;">Order Number:</td>
                                    <td style="padding:4px 0;">{{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold; padding:4px 0;">Order Date:</td>
                                    <td style="padding:4px 0;">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold; padding:4px 0;">Payment Method:</td>
                                    <td style="padding:4px 0;">{{ strtoupper($order->payment_method) }}</td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin-bottom:16px;">
                                <thead>
                                    <tr>
                                        <th align="left" style="border-bottom:1px solid #e5e5e5; padding:8px 0;">Item</th>
                                        <th align="center" style="border-bottom:1px solid #e5e5e5; padding:8px 0;">Qty</th>
                                        <th align="right" style="border-bottom:1px solid #e5e5e5; padding:8px 0;">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td style="padding:8px 0;">{{ $item->product->name ?? 'Item' }}</td>
                                            <td align="center" style="padding:8px 0;">{{ $item->quantity }}</td>
                                            <td align="right" style="padding:8px 0;">{{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
                                <tr>
                                    <td style="padding:4px 0;">Subtotal</td>
                                    <td align="right" style="padding:4px 0;">{{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:4px 0;">Tax</td>
                                    <td align="right" style="padding:4px 0;">{{ number_format($order->tax, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:4px 0;">Shipping</td>
                                    <td align="right" style="padding:4px 0;">{{ number_format($order->shipping_cost, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; font-weight:bold; border-top:1px solid #e5e5e5;">Total</td>
                                    <td align="right" style="padding:8px 0; font-weight:bold; border-top:1px solid #e5e5e5;">
                                        {{ number_format($order->total_amount, 2) }}
                                    </td>
                                </tr>
                            </table>

                            <div style="margin-bottom:16px;">
                                <p style="margin:0 0 6px; font-weight:bold;">Shipping Address</p>
                                <p style="margin:0;">
                                    {{ $order->address->address ?? '' }}<br>
                                    {{ $order->address->city ?? '' }}, {{ $order->address->state ?? '' }} {{ $order->address->zip_code ?? '' }}<br>
                                    {{ $order->address->country ?? '' }}<br>
                                    Phone: {{ $order->address->phone ?? '' }}
                                </p>
                            </div>

                            <p style="margin:0;">If you have any questions, reply to this email.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 24px; background:#f1f1f1; font-size:12px; color:#666;">
                            This is an automated confirmation for your order.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
