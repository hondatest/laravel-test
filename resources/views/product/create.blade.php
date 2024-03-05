<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品投稿</title>
</head>
<body>
  <h1>商品投稿</h1>
  <form action="{{ route('products.store') }}" method="post">
    @csrf
		<div>
			<label for="name">名前</label>
			<input type="text" id="name" name="name">
      @error('name')
        {{ $message }}   
      @enderror
		</div>
		<input type="submit" value="投稿する">
	</form>
</body>
</html>