<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Recurring Transaction Reminder</h2>

    <p>Hello,</p>

    <p>Your recurring transaction will be processed in 3 days.</p>

    <ul>
        <li>Amount: {{ $recurring->amount }}</li>
        <li>Type: {{ ucfirst($recurring->type) }}</li>
        <li>Frequency: {{ ucfirst($recurring->frequency) }}</li>
        <li>Transaction Date: {{ $recurring->next_run_date }}</li>
    </ul>

    <p>Please ensure sufficient balance is available.</p>
</body>
</html>