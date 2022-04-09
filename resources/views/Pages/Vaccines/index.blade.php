@extends('layouts.app')
@section('title')
Vaccines
@endsection
@section('breadcrumbs')
Vaccines
@endsection
@push('links')

@endpush
@section('content')
<div class="col-span-12 mt-6">
    <x-success/>

    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            Vaccines List
        </h2>
        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
            <a href="{{route('vaccines.create')}}" class="button text-white bg-theme-1 shadow-md mr-2"> Add Vaccines </a>
            <div class="dropdown" style="position: relative;">
                <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                    <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
                </button>
                <div class="dropdown-box w-40" id="_13mfv1da8">
                    <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                        <a href="{{route('vaccines.export')}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><span class="w-5 h-5 flex items-center justify-center"> <i data-feather="file-text" class="w-4 h-4"></i> </span> Export </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><span class="w-5 h-5 flex items-center justify-center"> <i data-feather="file-text" class="w-4 h-4"></i> </span> Import </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
        @foreach ($vaccines as $data)
        <div class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
            <div class="font-medium text-base">{{$data->vaccines_name}}</div>
            <div class="text-gray-600">{{$data->brand_name}}</div>
            <div class="text-gray-600">{{$data->has_dose}}</div>
            <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical w-5 h-5 text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg> </a>
                <div class="dropdown-box w-40" id="_f7cx5pv5u" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; transform: translate(-140px, 20px);">
                    <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                        <a href="{{route('vaccines.edit', $data->id)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i>  Edit </a>
                        @livewire('vaccines.delete-vaccines', ['vaccine' => $data], key($data->id))
                    </div>
                </div>
            </div>
        </div>
        @endforeach                
    </div>
    
    
</div>
@endsection
@push('scripts')

@endpush
