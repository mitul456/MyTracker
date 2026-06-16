<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recurring Transaction Reminder</title>
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

                            Recurring Transaction Reminder

                        </p>

                    </td>
                </tr>

                <!-- Body -->

                <tr>
                    <td style="padding:35px;">

                        <h2
                            style="margin-top:0;color:#f8fafc;font-size:24px;">

                            ⏰ Upcoming Recurring Transaction

                        </h2>

                        <p
                            style="color:#cbd5e1;font-size:15px;line-height:26px;">

                            Hello,

                        </p>

                        <p
                            style="color:#cbd5e1;font-size:15px;line-height:26px;">

                            This is a friendly reminder that your recurring
                            transaction will be processed in
                            <strong style="color:#22d3ee;">3 days</strong>.

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

                                                ৳ {{ number_format($recurring->amount,2) }}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="color:#94a3b8;">
                                                Type
                                            </td>

                                            <td style="color:#f8fafc;">

                                                {{ ucfirst($recurring->type) }}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="color:#94a3b8;">
                                                Frequency
                                            </td>

                                            <td style="color:#f8fafc;">

                                                {{ ucfirst($recurring->frequency) }}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="color:#94a3b8;">
                                                Next Run Date
                                            </td>

                                            <td style="color:#f8fafc;">

                                                {{ $recurring->next_run_date }}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="color:#94a3b8;">
                                                Account
                                            </td>

                                            <td style="color:#f8fafc;">

                                                {{ $recurring->account->name }}

                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="color:#94a3b8;">
                                                Category
                                            </td>

                                            <td style="color:#f8fafc;">

                                                {{ $recurring->category->name }}

                                            </td>
                                        </tr>

                                    </table>

                                </td>
                            </tr>

                        </table>

                        <!-- Reminder Box -->

                        <div
                            style="margin-top:30px;padding:18px;background:#3f2d00;border-left:4px solid #facc15;border-radius:8px;">

                            <p
                                style="margin:0;color:#fde68a;font-size:14px;line-height:24px;">

                                Please make sure your selected account has
                                sufficient balance before the scheduled
                                transaction date to avoid processing failure.

                            </p>

                        </div>

                        <!-- Button -->

                        <div
                            style="margin-top:35px;text-align:center;">

                            <a href="{{ config('app.url') }}"
                                style="display:inline-block;background:linear-gradient(90deg,#06b6d4,#6366f1);padding:14px 28px;color:#020617;font-weight:bold;text-decoration:none;border-radius:10px;">

                                View Recurring Transactions

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

                            This is an automated reminder email. Please do not reply.

                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>