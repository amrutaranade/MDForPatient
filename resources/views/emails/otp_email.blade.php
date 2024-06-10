<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $details['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dddddd;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>{{ $details['title'] }}</h2>
        </div>
        <div class="content">
            <p>Dear Recipient.</p>
            <p>Greetings from MD For Patients!</p>
            <p>We are sending you this email to provide you with your One-Time Password (OTP) code. Please use the following code to check your consultation</p>
            <p><strong>OTP is :{{ $details['body'] }}</strong></p>
            <p>For security purposes, this code is valid for 10 minutes.</p>
            <p><i>This is an automatically generated email.</i></p>
            <p>Client Services<br>MD for Patients</p>
        </div>

    </div>
</body>
</html>
