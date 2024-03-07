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
  @forelse  ($products as $product)
    商品名: {{ $product->name }}<br>
    クチコミ: {{ $product->pivot->text }}<br>
    <a href="{{ route('reviews.edit', ['review' => $product->pivot->id]) }}">クチコミ編集ページへ</a><br>
    <form action="{{ route('reviews.destroy', ['review' => $product->pivot->id]) }}" method="post">
      @csrf
      @method('delete')
      <input type="submit" value="クチコミを削除する">
    </form>
    <hr>
    @empty
      クチコミが投稿されていません
  @endforelse
</body>
</html>