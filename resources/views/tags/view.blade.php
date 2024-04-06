<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p> Hello Tag</p>
    @php
    @endphp
    @foreach ($posts as $index => $post)
      <p>{{$post}} </p>
    @endforeach
</body>
</html>