ht
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    style="font-family: Arial, sans-serif; line-height: 1.6; color: #333333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="background-color: #f8f8f8; text-align: center; padding: 20px;">
                <h1 style="color: #444444; margin: 0;">Password Reset</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>Hello,{{ $mail['email'] }}</p>
                <p>We received a request to reset your password. If you didn't make this request, you can ignore this
                    email.</p>
                <p>To reset your password, please click the button below:</p>
                <p style="text-align: center;">
                    <a href="{{ $mail['link'] }}"
                        style="display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 4px; font-weight: bold;">Reset
                        Password</a>
                </p>
                <p>If the button doesn't work, you can also copy and paste the following link into your browser:</p>

                <p>This link will expire in 24 hours for security reasons.</p>
                <p>If you didn't request a password reset, please ignore this email or contact our support team if
                    you
                    have any concerns.</p>
                <p>Best regards,<br>Your Support Team</p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f8f8f8; text-align: center; padding: 20px; font-size: 12px; color: #666666;">
                <p>&copy; {{ \Carbon\Carbon::now()->format('Y') }} Lihblary. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>
