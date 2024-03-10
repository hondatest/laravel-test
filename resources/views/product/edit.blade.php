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
    <label>商品画像1</label><br>
    <img src="{{ asset('storage/images/product/' . $product->productImages[0]->name) }}"><br>
    <input type="file" name="files[]">
    @error('files.0')
      {{ $message }}
    @enderror
    <br><br>
    <label>商品画像2</label><br>
    <img src="{{ asset('storage/images/product/' . $product->productImages[1]->name) }}"><br>
    <input type="file" name="files[]">
    @error('files.1')
      {{ $message }}
    @enderror
    <br><br>
    <label>商品画像3</label><br>
    <img src="{{ asset('storage/images/product/' . $product->productImages[2]->name) }}"><br>
    <input type="file" name="files[]">
    @error('files.2')
      {{ $message }}
    @enderror
    <br><br>
		<input type="submit" value="更新する">
	</form>
</body>
</html>