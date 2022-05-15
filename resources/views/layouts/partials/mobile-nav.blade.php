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
                <div class="menu__title"> Generate Report  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down side-menu__sub-icon"><polyline points="6 9 12 15 18 9"></polyline></svg> </div>
            </a>
            <ul class="" style="display: none;">
                <li>
                    <a href="{{route('generate-report.view')}}" class="menu {{!request()->routeIs('generate-report.view') ?: 'menu--active'}}">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                        <div class="menu__title"> Vaccine Report </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('generate-report.viewchild')}}" class="menu {{!request()->routeIs('generate-report.viewchild') ?: 'menu--active'}}">
                        <div class="menu__icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                        <div class="menu__title"> Child Vaccines Report </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
