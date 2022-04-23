@extends('layouts.app')
@section('title')
Vaccinated Children
@endsection
@section('breadcrumbs')
Vaccinated Children
@endsection
@push('links')

@endpush
@section('content')
<div class="col-span-12 mt-6">
    <x-success/>

    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            Vaccinated Children List
        </h2>
        <!-- BEGIN:Filter -->
        <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
            <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
                <i class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-gray-700 dark:text-gray-300" data-feather="search"></i> 
                <input type="text" class="input w-full sm:w-64 box px-10 text-gray-700 dark:text-gray-300 placeholder-theme-13" placeholder="Search Child Name">
                <div class="inbox-filter dropdown absolute inset-y-0 mr-3 right-0 flex items-center" data-placement="bottom-start">
                    <i class="dropdown-toggle w-4 h-4 cursor-pointer text-gray-700 dark:text-gray-300" data-feather="chevron-down"></i> 
                    <div class="inbox-filter__dropdown-box dropdown-box pt-2">
                        <div class="dropdown-box__content box p-5">
                            <div class="grid grid-cols-12 gap-4 row-gap-3">
                                <div class="col-span-6">
                                    <div class="text-xs">Date From</div>
                                    <input type="datetime-local" class="input w-full border mt-2 flex-1">
                                </div>
                                <div class="col-span-6">
                                    <div class="text-xs">Date To</div>
                                    <input type="datetime-local" class="input w-full border mt-2 flex-1">
                                </div>
                                <div class="col-span-6">
                                    <div class="text-xs">Vaccine Name</div>
                                    <input type="text" class="input w-full border mt-2 flex-1" placeholder="Vaccine">
                                </div>
                                <div class="col-span-6">
                                    <div class="text-xs">Dose</div>
                                        <select class="input w-full border mt-2 flex-1" name="has_dose">
                                            @for ($x = 1; $x <= 3; $x++)
                                            <option {{($vaccine->has_dose == $x) ? 'selected' : ''}} value="{{$x}}">{{$x}} dose</option>
                                            @endfor
                                        </select>
                                    </div>
                                <div class="col-span-12 flex items-center mt-3">
                                    <button class="button w-32 justify-center block bg-theme-1 text-white ml-2">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END:Filter -->
       
        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
            <a href="{{route('child-vaccines.create')}}" class="button text-white bg-theme-1 shadow-md mr-2"> Add Vaccinated Child </a>
            @livewire('child-vaccines.child-vaccines-export')

            <a  href="javascript:;" data-toggle="modal" data-target="#basic-modal-preview" class="ml-2 flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><span class="w-5 h-5 flex items-center justify-center"> <i data-feather="file-text" class="w-4 h-4"></i> </span> Import </a>
                        
            <!-- Modal show -->
            <div class="modal" id="basic-modal-preview">
                <div class="modal__content">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Import Vaccinated Children List
                        </h2>
                        <div class="dropdown sm:hidden">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-gray-700 dark:text-gray-600"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> </a>
                            <div class="dropdown-box w-40">
                                <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                    <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file w-4 h-4 mr-2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Download Docs </a>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <form action="/vaccines/import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <div class="col-span-12 sm:col-span-12">
                            <label>REMINDERS : </label>
                            <p>1.) Be careful not to modify the Headers of the template.</p>
                            <p>2.) The systen will only accepts file format .xls, xlsx, .csv extension.</p>
                            <p>3.) Failure to do the above informations will throw an error.</p>
                        </div>
                        <div class="col-span-12 sm:col-span-12">
                            <label>Choose File :</label>
                            <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                        <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                        <button type="submit" class="button w-20 bg-theme-1 text-white">Import</button>
                    </div>
                    </form>
                    
                </div>
            </div>
            <!-- Modal end -->

        </div>
    </div>
    <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
          
        <!-- Vaccinated Children List -->
        @foreach($child_vaccines as $data)
        <div class="intro-y col-span-12 md:col-span-3">
            <div class="box">
                <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                        @if($data->gender == 'Male')
                        <img class="rounded-full" src="images/son.png">
                        @else
                        <img class="rounded-full" src="images/daughter.png">
                        @endif
                    </div>
                    <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                        <a href="" class="font-medium">{{$data->childs_name}}</a> 
                        <div class="text-gray-600 text-xs">Mother : {{$data->mothers_name}}</div>
                        <div class="text-gray-600 text-xs">Father : {{$data->fathers_name}}</div>
                        <div class="text-gray-600 text-xs">Date of Birth : {{Carbon\Carbon::parse($data->date_of_birth)->format('M d, Y')}}</div>
                    </div>
                    <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical w-5 h-5 text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg> </a>
                        <div class="dropdown-box w-40" id="_f7cx5pv5u" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; transform: translate(-140px, 20px);">
                            <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                <a href="{{route('child-vaccines.edit', $data->child_id)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i>  Edit Vaccine</a>
                                <a href="{{route('child-vaccines.destroy',$data->child_id)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-1"></i>  Delete Record</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap lg:flex-no-wrap p-5">
                    <a href="{{route('child-vaccines.show', $data->child_id)}}" class="button button--sm text-white bg-theme-34 mr-2">Vaccine Status</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
</div>
@endsection
@push('scripts')

@endpush
