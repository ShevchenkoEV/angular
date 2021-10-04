        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            @foreach($menuItems as $menu)

                <li><a href="{{ route($menu->path) }}" class="nav-link px-4  text-warning">{{$menu->title}}</a></li>

            @endforeach
        </ul>






