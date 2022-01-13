<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="/profile/{{ $notification->data['follower_id'] }}">{{ $notification->data['follower_name'] }} followed you</a>
    <br><br>
</body>
</html>
