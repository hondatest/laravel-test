<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>クチコミ編集</title>
</head>
<body>
  <h1>クチコミ編集</h1>
  <form action="{{ route('reviews.update', ['review' => $product->pivot->id]) }}" method="post">
    @csrf
    @method('put')
		<div>
			<label for="text">本文</label><br>
      <textarea id="text" name="text" rows="4" cols="100">{{ old('text', $product->pivot->text) }}</textarea>
      @error('text')
        {{ $message }}   
      @enderror
		</div>
		<input type="submit" value="更新する">
	</form>
</body>
</html>