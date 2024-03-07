<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>クチコミ投稿</title>
</head>
<body>
  <h1>クチコミ投稿</h1>
  <form action="{{ route('reviews.store', ['product_id' => request()->product_id]) }}" method="post">
    @csrf
		<div>
			<label for="text">本文</label><br>
      <textarea id="text" name="text" rows="4" cols="100"></textarea>
      @error('text')
        {{ $message }}   
      @enderror
		</div>
		<input type="submit" value="投稿する">
	</form>
</body>
</html>