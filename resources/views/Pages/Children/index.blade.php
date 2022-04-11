@extends('layouts.app')
@section('title')
Children
@endsection
@section('breadcrumbs')
Children
@endsection
@push('links')

@endpush
@section('content')
<div class="col-span-12 mt-6">
    <x-success/>
    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-small truncate mr-5">
            Children List
        </h2>
        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
            <a href="{{route('children.create')}}" class="button text-white bg-theme-1 shadow-md mr-2"> Add Children </a>
            @livewire('children.child-export')
            <a  href="javascript:;" data-toggle="modal" data-target="#basic-modal-preview" class="ml-2 flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><span class="w-5 h-5 flex items-center justify-center"> <i data-feather="file-text" class="w-4 h-4"></i> </span> Import </a>
            <!-- Modal show -->
            <div class="modal" id="basic-modal-preview">
                <div class="modal__content">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Import Vaccine File
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
                    <form action="/child/import" method="POST" enctype="multipart/form-data">
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
        </div>
    </div>
    <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
        <table class="table table-report sm:mt-2">
            <thead>
                <tr>
                    <th class="text-center whitespace-no-wrap">CHILD'S Name</th>
                    <th class="text-center whitespace-no-wrap">MOTHER'S NAME</th>
                    <th class="text-center whitespace-no-wrap">FATHER'S NAME</th>
                    <th class="text-center whitespace-no-wrap">DATE OF BIRTH</th>
                    <th class="text-center whitespace-no-wrap">PLACE OF BIRTH</th>
                    <th class="text-center whitespace-no-wrap">DATE OF REGISTRATION</th>
                    <th class="text-center whitespace-no-wrap">GENDER</th>
                    <th class="text-center whitespace-no-wrap">BIRTH HEIGHT</th>
                    <th class="text-center whitespace-no-wrap">BIRTH WEIGHT</th>
                    <th class="text-center whitespace-no-wrap">ADDRESS</th>
                    <th class="text-center whitespace-no-wrap">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($childrens as $child)
                <tr class="intro-x">
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small text-center">{{$child->childs_name}}</p>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small  text-center">{{$child->mothers_name}}</p>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small text-center">{{$child->fathers_name}}</p>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small text-center">{{$child->date_of_birth}}</p>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small   text-center">{{$child->place_of_birth}}</p>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small  text-center">{{$child->date_of_registration}}</p>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small  text-center">{{$child->gender}}</p>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small  text-center">{{$child->birth_height}}</p>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small  text-center">{{$child->birth_weight}}</p>
                        </div>
                    </td>

                    <td class="w-40">
                        <div class="flex">
                            <p class="font-small text-center">{{$child->address}}</p>
                        </div>
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{route('children.edit', $child->id)}}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                            @livewire('children.delete-children', ['child' => $child], key($child->id))
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')

@endpush
