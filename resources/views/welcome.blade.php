<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.R.I.M. - Public Portal</title>
</head>
<body style="font-family: sans-serif; text-align: center; padding-top: 100px; background-color: #f3f4f6;">

    <h1>Welcome to B.R.I.M.</h1>
    <p>Barangay Resident Information Management System</p>
    
    <div style="margin-top: 30px;">
        @auth
            <a href="{{ url('/dashboard') }}" style="background: blue; color: white; padding: 10px 20px; text-decoration: none;">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" style="background: gray; color: white; padding: 10px 20px; text-decoration: none; margin-right: 10px;">Log In</a>
            
            <a href="{{ route('register') }}" style="background: green; color: white; padding: 10px 20px; text-decoration: none;">Register as Resident</a>
        @endauth
    </div>

</body>
</html>