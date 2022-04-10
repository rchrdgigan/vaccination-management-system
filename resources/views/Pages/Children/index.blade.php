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
