<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Code</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #343a40;
            padding: 20px;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .email-header h1 {
            font-size: 24px;
            color: #007bff;
        }

        .email-body {
            padding: 20px 0;
        }

        .email-body h2 {
            font-size: 22px;
            color: #28a745;
            text-align: center;
            margin: 20px 0;
            letter-spacing: 2px;
        }

        .email-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }

        .email-footer p {
            font-size: 14px;
            color: #868e96;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: #ffffff;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="email-header">
            <h1>Email Verification Required</h1>
        </div>

        <div class="email-body">
            <p>Hello,</p>
            <p>Thank you for signing up! To complete your registration and start using our services, please verify your email address by using the code below:</p>
            <h2><?php echo e($code); ?></h2>
            <p>If you did not request this, please ignore this email or contact our support team for assistance.</p>
            <div class="text-center">
                <a href="<?php echo e(route('verify.email', ['code' => $code])); ?>" class="btn btn-primary">Verify Email</a>
            </div>

        </div>

        <div class="email-footer">
            <p>If you have any questions or need further assistance, feel free to reply to this email or visit our <a href="#">Help Center</a>.</p>
            <p>Best regards,<br>The Team</p>
        </div>
    </div>

</body>

</html>
<?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/emails/verify_code.blade.php ENDPATH**/ ?>