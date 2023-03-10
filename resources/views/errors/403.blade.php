<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unauthorized Access - 403 Forbidden</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f1f1f1;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
        }
        h1 {
            font-size: 48px;
            margin-bottom: 0;
        }
        p {
            font-size: 24px;
            margin-top: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Unauthorized Access</h1>
        <p>We're sorry, but you do not have permission to access this resource.</p>
        <p>If you believe this is an error, please contact the site administrator.</p>
        <a href="{{url('home')}}" class="btn btn-sm btn-primary">Go to Home Page</a>
    </div>
</body>
</html>
