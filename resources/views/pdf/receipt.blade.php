@php
    $settings = App\Models\SystemSetting::first();
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Receipt</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .header p {
            margin: 0;
            color: #666;
        }

        .details-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .details-table th,
        .details-table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }

        .details-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .details-table td {
            background-color: #fff;
            color: #666;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #666;
            font-size: 12px;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Receipt</h1>
            <p>Thank you for your purchase!</p>
        </div>
        <table class="details-table">
            <tr>
                <th>Transaction ID</th>
                <td>{{ $transaction->transaction_id }}</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>${{ number_format($transaction->amount, 2) }}</td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td>{{ ucfirst($transaction->payment_status) }}</td>
            </tr>

            <tr>
                <th>Purchase Date</th>
                <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Subscription Type</th>
                <td>{{ $subscription->package_type }}</td>
            </tr>
            <tr>
                <th>Start Date</th>
                <td>{{ $start_date->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>End Date</th>
                <td>{{ $end_date->format('d/m/Y') }}</td>
            </tr>
        </table>
        <div class="footer">
            <p>
                If you have any questions about this receipt, please contact
                <a href="mailto:support@example.com">{{ $settings->email ?? 'Tradespeople@gmail.com' }}</a>.
            </p>
        </div>
    </div>
</body>

</html>
