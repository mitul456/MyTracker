<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>

<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;background:#f4f7fb;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 8px 25px rgba(0,0,0,.08);">

                    <!-- Header -->
                    <tr>
                        <td align="center"
                            style="background:linear-gradient(135deg,#06b6d4,#4f46e5);padding:35px;">

                            <h1 style="margin:0;color:#ffffff;font-size:28px;">
                                Finance Tracker
                            </h1>

                            <p style="margin-top:10px;color:#e2e8f0;font-size:15px;">
                                Email Verification
                            </p>

                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:40px;">

                            <h2 style="margin-top:0;color:#0f172a;">
                                Hello, {{ $name }}
                            </h2>

                            <p style="font-size:16px;color:#475569;line-height:28px;">

                                We received a request to verify your email address.
                                Please use the following One-Time Password (OTP).

                            </p>

                            <!-- OTP Box -->
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">

                                        <div
                                            style="display:inline-block;background:#f8fafc;border:2px dashed #06b6d4;padding:20px 40px;border-radius:12px;margin:25px 0;">

                                            <span
                                                style="font-size:38px;font-weight:bold;letter-spacing:10px;color:#0f172a;">

                                                {{ $otp }}

                                            </span>

                                        </div>

                                    </td>
                                </tr>
                            </table>

                            <p style="font-size:15px;color:#64748b;line-height:28px;">

                                This OTP is valid for
                                <strong>10 minutes</strong>.

                            </p>

                            <p style="font-size:15px;color:#64748b;line-height:28px;">

                                Never share this OTP with anyone.

                            </p>

                            <hr style="border:none;border-top:1px solid #e2e8f0;margin:35px 0;">

                            <p style="font-size:14px;color:#94a3b8;">

                                If you didn't request this verification,
                                you can safely ignore this email.

                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="background:#f8fafc;padding:25px;color:#64748b;font-size:14px;">

                            © {{ date('Y') }}
                            Finance Tracker

                            <br>

                            Secure Personal Finance Management System

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>