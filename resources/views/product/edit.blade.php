<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="{{ route('products.update', [ 'product' => $product->id ]) }}" method="post">
    @method('put')
    @csrf
		<div>
			<label for="name">名前</label>
			<input type="text" name="name" value="{{ $product->name }}">
		</div>
		<input type="submit" value="更新する">
	</form>
</body>
</html>