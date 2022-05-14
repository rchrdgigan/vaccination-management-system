<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img class="w-20" src="{{asset('images/vaccine_logo.png')}}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{route('home')}}" class="menu menu {{!request()->routeIs('home') ?: 'menu--active'}}">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="{{route('children.index')}}" class="menu menu {{!request()->routeIs('children.*') ?: 'menu--active'}}">
                <div class="menu__icon"> <i data-feather="users"></i> </div>
                <div class="menu__title"> Children </div>
            </a>
        </li>
        <li>
            <a href="{{route('vaccines.index')}}" class="menu menu {{!request()->routeIs('vaccines.*') ?: 'menu--active'}}">
                <div class="menu__icon"> <i data-feather="edit"></i> </div>
                <div class="menu__title"> Vaccines </div>
            </a>
        </li>
        <li>
            <a href="{{route('child-vaccines.index')}}" class="menu menu {{!request()->routeIs('child-vaccines.*') ?: 'menu--active'}}">
                <div class="menu__icon"> <i data-feather="user"></i> </div>
                <div class="menu__title"> Children Vaccination </div>
            </a>
        </li>
        <li>
            <a href="#" class="menu menu">
                <div class="menu__icon"> <i data-feather="calendar"></i> </div>
                <div class="menu__title"> Generate Report </div>
            </a>
        </li>
    </ul>
</div>
