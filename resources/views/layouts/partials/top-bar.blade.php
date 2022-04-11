<div class="top-bar">
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">@yield('breadcrumbs')</a> </div>
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
            <img alt="Midone Tailwind HTML Admin Template" src="{{asset('assets/images/profile-1.jpg')}}">
        </div>
        <div class="dropdown-box w-56">
            <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                    <div class="font-medium">John Travolta</div>
                    <div class="text-xs text-theme-41 dark:text-gray-600">DevOps Engineer</div>
                </div>
                <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md" onclick="event.preventDefault();this.closest('form').submit();"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
