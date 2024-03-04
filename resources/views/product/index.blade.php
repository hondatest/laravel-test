<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <ul>
  @foreach ($products as $product)
    <ul>
      <div>
        <p>商品名:{{ $product->name }}</p>
        <a href="{{ route('products.show', [ 'product' => $product->id ]) }}">商品詳細ページへ</a>
        <a href="{{ route('products.edit', [ 'product' => $product->id ]) }}">商品編集ページへ</a>
        <form action="{{ route('products.destroy', [ 'product' => $product->id ]) }}" method="post">
          @method('delete')
          @csrf
          <input type="submit" value="商品を削除する">
        </form>
      </div>
    </ul>
  @endforeach
  </ul>
</body>
</html>