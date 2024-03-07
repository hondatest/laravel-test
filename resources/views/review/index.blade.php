<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>投稿済みクチコミ</title>
</head>
<body>
  <h1>投稿済みクチコミ</h1>
  @foreach ($products as $product)
    商品名: {{ $product->name }}<br>
    クチコミ: {{ $product->pivot->text }}<br>
    <hr>      
  @endforeach
</body>
</html>