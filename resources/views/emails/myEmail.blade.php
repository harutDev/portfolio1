<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <link rel="stylesheet" href="{{ asset('asset/css/styles.css') }}">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Message from {{$name}}</h1>
    </div>
    <div class="content">
        <p><strong>Name:</strong> {{$name}}</p>
        <p><strong>Email:</strong> {{$email}}</p>
        <p><strong>Message:</strong></p>
        <p>{{$messageInfo}}</p>
    </div>
    <div class="footer">
        <p>&copy; 2024 Your Company. All rights reserved.</p>
    </div>
</div>
</body>
</html>
