 <nav class="side-nav">
                <a href="" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{asset('assets/images/logo.svg')}}">
                    <span class="hidden xl:block text-white text-lg ml-3"> Mid<span class="font-medium">one</span> </span>
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li>
                        <a href="{{route('home')}}" class="side-menu {{!request()->routeIs('home') ?: 'side-menu--active'}}">
                            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('children.index')}}" class="side-menu {{!request()->routeIs('children.*') ?: 'side-menu--active'}}">
                            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="side-menu__title"> Children </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('vaccines.index')}}" class="side-menu {{!request()->routeIs('vaccines.*') ?: 'side-menu--active'}}">
                            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="side-menu__title"> Vaccines </div>
                        </a>
                    </li>
                </ul>
            </nav>
