@extends('layouts.app')
@section('title')
Edit | Vaccines
@endsection
@section('breadcrumbs')
Vaccines > Edit
@endsection
@section('content')
<div class="intro-y block sm:flex items-center h-10 mt-6">
    <h2 class="text-lg font-medium truncate mr-5">
        Edit Vaccine
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <form action="{{route('vaccines.update',$vaccine->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="intro-y box p-5">
            <div  class="mt-3">
                <label>Name of Vaccines</label>
                <input type="text" class="input w-full border mt-2" value="{{$vaccine->vaccines_name}}" placeholder="Please insert the name of the vaccine" name="vaccines_name">
            </div>
            @error('vaccines_name')
                <div class="text-theme-6 mt-2">{{$message}}</div>
            @enderror
            <div  class="mt-3">
                <label for="">Has dose?</label>
                <div class="relative mt-2" >
                    <select class="input w-full  border mr-2" name="has_dose">
                        <option {{($vaccine->has_dose == '1st-dose') ? 'selected' : ''}} value="1st-dose">1st dose</option>
                        <option {{($vaccine->has_dose == '2nd-dose') ? 'selected' : ''}} value="2nd-dose">2nd dose</option>
                        <option {{($vaccine->has_dose == '3rd-dose') ? 'selected' : ''}} value="3rd-dose">3rd dose</option>
                    </select>
                </div>
            </div>
            @error('has_dose')
                div class="text-theme-6 mt-2">{{$message}}</div>
            @enderror
            <div class="text-right mt-5">
                <a href="{{route('vaccines.index')}}" type="button" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</a>
                <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
            </div>
        </div>
    </form>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection
