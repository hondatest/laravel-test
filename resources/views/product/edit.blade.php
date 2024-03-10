<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品編集</title>
</head>
<body>
  <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <h1>商品編集</h1>
    <label for="name">名前</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}">
    @error('name')
      {{ $message }}   
    @enderror
    <br><br>
    @foreach ($product->productImages as $product_image)
			<label>商品画像{{ $loop->iteration }}</label><br>
      <img src="{{ asset('storage/images/product/' . $product_image->name) }}"><br>
			<input type="file" name="files[]"><br><br>
      @error('files.{{ $loop->index }}')
        {{ $message }}
      @enderror
    @endforeach
		<input type="submit" value="更新する">
	</form>
</body>
</html>