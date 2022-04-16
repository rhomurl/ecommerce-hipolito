
    @foreach($categories as $category)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.search', $category->slug )}}">{{ $category->name }}</a>
        </li>   
    @endforeach