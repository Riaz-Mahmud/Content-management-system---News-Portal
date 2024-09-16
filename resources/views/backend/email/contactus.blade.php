<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Us Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .details {
            margin-bottom: 10px;
        }
        .details strong {
            display: inline-block;
            width: 100px;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="heading">You have received a new message from {{ $name }}</div>

    <div class="details">
        <strong>Name:</strong> {{ $name }}
    </div>
    <div class="details">
        <strong>Email:</strong> {{ $email }}
    </div>

    <div class="message">
        <strong>Message:</strong> <br>
        {{ $data }}
    </div>
</div>

</body>
</html>
