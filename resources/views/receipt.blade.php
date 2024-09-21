{{--Author: Shi Lei--}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>

<h2>Order Receipt</h2>
<p>Thank you for your purchase, {{ $order->user->name }}!</p>
<p>Order ID: {{ $order->order_id }}</p>
<p>Date: {{ $order->created_at->format('d M Y, h:i A') }}</p>

<h3>Order Details</h3>
<table>
    <thead>
    <tr>
        <th>Food</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->details as $detail)
        <tr>
            <td>{{ $detail->food->name }}</td>
            <td>RM {{ number_format($detail->price, 2) }}</td>
            <td>{{ $detail->quantity }}</td>
            <td>RM {{ number_format($detail->subtotal, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h3>Summary</h3>
<table>
    <tr>
        <th>Total</th>
        <td>RM {{ number_format($order->total, 2) }}</td>
    </tr>
    <tr>
        <th>Discount</th>
        <td>RM {{ number_format($order->discount, 2) }}</td>
    </tr>
    <tr>
        <th>Tax</th>
        <td>RM {{ number_format($order->tax, 2) }}</td>
    </tr>
    <tr class="total-row">
        <th>Final Total</th>
        <td>RM {{ number_format($order->final, 2) }}</td>
    </tr>
</table>

<h3>Delivery Details</h3>
<table>
    <tr>
        <th>Delivery Address</th>
        <td>{{ $order->delivery->address }}</td>
    </tr>
    <tr>
        <th>Rider</th>
        <td>{{ $order->delivery->rider }}</td>
    </tr>
    <tr>
        <th>Delivery Status</th>
        <td>{{ $order->delivery->status }}</td>
    </tr>
</table>

<div class="footer">
    <p>Thank you for shopping with us!</p>
</div>

</body>
</html>
