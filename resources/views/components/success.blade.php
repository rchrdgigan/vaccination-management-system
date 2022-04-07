@if (session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white">
    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i>
    {{session('success')}}
</div>
@endif

