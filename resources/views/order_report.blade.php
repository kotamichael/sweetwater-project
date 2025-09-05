<div>
    <h1>Categorized Comment List</h1>

    @foreach ($categorizedComments as $category => $comments)
        <h2>{{ $category }}</h2>
        @foreach ($comments as $comment)
            <p>{{ $comment }}</p>
        @endforeach
    @endforeach
</div>
