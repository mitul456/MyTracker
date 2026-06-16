<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Completed</title>
</head>
<body style="margin:0;padding:0;background:#020617;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0"
                style="background:#0f172a;border:1px solid #1e293b;border-radius:16px;overflow:hidden;">

                <!-- Header -->

                <tr>
                    <td
                        style="background:linear-gradient(90deg,#06b6d4,#6366f1);padding:30px;text-align:center;">

                        <h1
                            style="margin:0;color:#020617;font-size:28px;font-weight:bold;">

                            Finance Tracker

                        </h1>

                        <p
                            style="margin-top:8px;color:#0f172a;font-size:15px;">

                            Recurring Transaction Notification

                        </p>

                    </td>
                </tr>

                <!-- Body -->

                <tr>
                    <td style="padding:35px;">

                        <h2
                            style="margin-top:0;color:#f8fafc;font-size:24px;">

                            ✅ Transaction Completed

                        </h2>

                        <p
                            style="color:#cbd5e1;font-size:15px;line-height:26px;">

                            Hello,

                        </p>

                        <p
                            style="color:#cbd5e1;font-size:15px;line-height:26px;">

                            Your recurring transaction has been processed successfully.
                            Below are the transaction details.

                        </p>

                        <!-- Details Card -->

                        <table width="100%" cellpadding="0" cellspacing="0"
                            style="margin-top:25px;background:#020617;border:1px solid #334155;border-radius:12px;">

                            <tr>
                                <td style="padding:18px;">

                                    <table width="100%" cellpadding="8">

                                        <tr>
                                            <td style="color:#94a3b8;width:40%;">
                                                Amount
                                            </td>

                                            <td
                                                style="color:#22c55e;font-weight:bold;font-size:18px;">
                                                ৳ {{ number_format($transaction->amount,2) }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="color:#94a3b8;">
                                                Type
                                            </td>

                                            <td style="color:#f8fafc;">
                                                {{ ucfirst($transaction->type) }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="color:#94a3b8;">
                                                Transaction Date
                                            </td>

                                            <td style="color:#f8fafc;">
                                                {{ $transaction->transaction_date }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="color:#94a3b8;">
                                                Account
                                            </td>

                                            <td style="color:#f8fafc;">
                                                {{ $transaction->account->name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="color:#94a3b8;">
                                                Category
                                            </td>

                                            <td style="color:#f8fafc;">
                                                {{ $transaction->category->name }}
                                            </td>
                                        </tr>

                                    </table>

                                </td>
                            </tr>

                        </table>

                        <!-- Success Message -->

                        <div
                            style="margin-top:30px;padding:18px;background:#022c22;border-left:4px solid #22c55e;border-radius:8px;">

                            <p
                                style="margin:0;color:#bbf7d0;font-size:14px;line-height:24px;">

                                Your recurring transaction has been completed successfully.
                                No further action is required.

                            </p>

                        </div>

                        <!-- Button -->

                        <div
                            style="margin-top:35px;text-align:center;">

                            <a href="{{ config('app.url') }}"
                                style="display:inline-block;background:linear-gradient(90deg,#06b6d4,#6366f1);padding:14px 28px;color:#020617;font-weight:bold;text-decoration:none;border-radius:10px;">

                                Open Finance Tracker

                            </a>

                        </div>

                    </td>
                </tr>

                <!-- Footer -->

                <tr>
                    <td
                        style="padding:25px;text-align:center;border-top:1px solid #1e293b;">

                        <p
                            style="margin:0;color:#64748b;font-size:13px;">

                            © {{ date('Y') }} Finance Tracker

                        </p>

                        <p
                            style="margin-top:8px;color:#475569;font-size:12px;">

                            This is an automated email. Please do not reply.

                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>