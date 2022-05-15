 <nav class="side-nav">
                <a href="" class="intro-x flex items-center pl-5 pt-4">
                    <img class="w-12" src="{{asset('images/vaccine_logo.png')}}">
                    <span class="hidden xl:block text-white text-lg ml-3">VMS</span>
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
                            <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                            <div class="side-menu__title"> Children </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('vaccines.index')}}" class="side-menu {{!request()->routeIs('vaccines.*') ?: 'side-menu--active'}}">
                            <div class="side-menu__icon"> <i data-feather="edit"></i> </div>
                            <div class="side-menu__title"> Vaccines </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('child-vaccines.index')}}" class="side-menu {{!request()->routeIs('child-vaccines.*') ?: 'side-menu--active'}}">
                            <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                            <div class="side-menu__title"> Children Vaccination </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu {{!request()->routeIs('generate-report.*') ?: 'side-menu--active'}}">
                            <div class="side-menu__icon"> <i data-feather="calendar"></i> </div>
                            <div class="side-menu__title"> Generate Report <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down side-menu__sub-icon"><polyline points="6 9 12 15 18 9"></polyline></svg> </div>
                        </a>
                        <ul class="" style="display: none;">
                            <li>
                                <a href="{{route('generate-report.view')}}" class="side-menu {{!request()->routeIs('generate-report.view') ?: 'side-menu--active'}}">
                                    <div class="side-menu__icon">  <i data-feather="clipboard"></i></div>
                                    <div class="side-menu__title"> Vaccine Report </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('generate-report.viewchild')}}" class="side-menu {{!request()->routeIs('generate-report.viewchild') ?: 'side-menu--active'}}">
                                    <div class="side-menu__icon"> <i data-feather="clipboard"></i></div>
                                    <div class="side-menu__title"> Child Vaccines Report </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
