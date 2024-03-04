<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
	<div>
		<p>商品ID: {{ $product->id }}</p>
		<p>商品名: {{ $product->name }}</p>
    <p>商品投稿日: {{ $product->created_at }}</p>
	</div>
</body>
</html>