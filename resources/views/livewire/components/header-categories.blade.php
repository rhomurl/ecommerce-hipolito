<div class="col-6">
    @foreach($categories as $category)
        <a href="{{ route('category.search', $category->slug )}}">{{ $category->name }}</a>
    @endforeach
</div>