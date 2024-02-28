<!DOCTYPE html>

<title>My Blog</title>
<link rel="stylesheet" type="text/css" href="/app.css">

<body>
    @foreach($posts as $post)
        <article>
            {!! $post !!}
        </article>
    @endforeach
</body>