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
            <button class="button px-2 mr-1 bg-theme-1 text-white">Export</button>
            <button class="button px-2 mr-1 bg-theme-1 text-white">Import</button>
        </div>
    </div>
    <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
        <table class="table table-report sm:mt-2">
            <thead>
                <tr>
                    <th class="text-center whitespace-no-wrap">VACCINES NAME</th>
                    <th class="text-center whitespace-no-wrap">HAS DOSE</th>
                    <th class="text-center whitespace-no-wrap">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vaccines as $data)
                <tr class="intro-x">
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-medium whitespace-no-wrap">{{$data->vaccines_name}}</p>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <p class="font-medium whitespace-no-wrap">{{$data->has_dose}}</p>
                        </div>
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{route('vaccines.edit', $data->id)}}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                            @livewire('vaccines.delete-vaccines', ['vaccine' => $data], key($data->id))
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
