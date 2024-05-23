<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: 0 auto;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<form action="{{ route("admin.submit_login") }}" method="post">
    @csrf
    <h2>Login Form</h2>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    @error('email')
    <div style="color: red">{{ $message }}</div>
    @enderror
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    @error('password')
    <div style="color: red">{{ $message }}</div>
    @enderror
    <input type="submit" value="Register">
</form>

</body>
</html>
