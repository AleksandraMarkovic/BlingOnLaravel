<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><h2>Bling <em>On</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    @foreach($menu as $link)
                        <li class="nav-item @if(request()->routeIs($link->route)) active @endif">
                            <a class="nav-link" href="{{ route($link->route) }}"> {{ $link->name }} </a>
                        </li>
                    @endforeach
                    @if(session()->has('user') && session('user')->role_id == 1)
                            <li class="nav-item @if(request()->routeIs('admin')) active @endif">
                                <a class="nav-link" href="{{ route('admin') }}"> Admin </a>
                            </li>
                        @endif
                        @if(session()->has('user'))
                            <li class="nav-item @if(request()->routeIs('cart')) active @endif">
                                <a class="nav-link" href="{{ route('cart') }}" id="cart"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>
                            </li>
                        @endif
                    @if(!session()->has('user'))
                        <li class="nav-item @if(request()->routeIs('loginRegister')) active @endif">
                            <a class="nav-link" href="{{ route('loginRegister') }}"> Login | Register </a>
                        </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"> Logout </a>
                            </li>
                        @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
