<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Include Bootstrap or any other CSS framework if needed -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Payment Successful!</h2>
            </div>
            <div class="card-body">
                <p>Thank you for your payment. Your subscription is now active.</p>
                <h4>Subscription Details</h4>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Subscription Package:</strong> {{ $subscription->package_type }}
                    </li>
                    <li class="list-group-item"><strong>Status:</strong> {{ $subscription->status }}</li>
                    <li class="list-group-item"><strong>Start Date:</strong>
                        {{ $subscription->created_at->format('M d, Y') }}</li>
                    <li class="list-group-item"><strong>End Date:</strong>
                        {{ $subscription->created_at->addMonth()->format('M d, Y') }}</li>
                </ul>
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn btn-primary">Go to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap JS or any other JS framework if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
