<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品編集</title>
</head>
<body>
  <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post">
    @method('put')
    @csrf
    <h1>商品編集</h1>
		<div>
			<label for="name">名前</label>
			<input type="text" name="name" value="{{ old('name', $product->name) }}">
      @error('name')
        {{ $message }}   
      @enderror
		</div>
		<input type="submit" value="更新する">
	</form>
</body>
</html>