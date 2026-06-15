<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Transaction Completed</h2>

    <p>Hello,</p>

    <p>Your recurring transaction has been processed successfully.</p>

    <ul>
        <li>Amount: {{ $transaction->amount }}</li>
        <li>Type: {{ ucfirst($transaction->type) }}</li>
        <li>Date: {{ $transaction->transaction_date }}</li>
    </ul>

    <p>Thank you.</p>
</body>
</html>