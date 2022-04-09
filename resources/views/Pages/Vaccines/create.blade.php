@extends('layouts.app')
@section('title')
Create | Vaccines
@endsection
@section('breadcrumbs')
Vaccines > Create
@endsection
@section('content')
<div class="intro-y block sm:flex items-center h-10 mt-6">
    <h2 class="text-lg font-medium truncate mr-5">
        Create Vaccines
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <form action="{{route('vaccines.store')}}" method="POST">
            @csrf
        <div class="intro-y box p-5">
            <div  class="mt-3">
                <label>Name of Vaccines</label>
                <input type="text" class="input w-full border mt-2" placeholder="Please insert the name of the vaccine" name="vaccines_name">
                @if(session('error'))
                    <div class="text-theme-6 mt-2">{{session('error')}}</div>
                @endif
                @error('vaccines_name')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div  class="mt-3">
                <label>Brand/Manufacturer of Vaccines</label>
                <input type="text" class="input w-full border mt-2" placeholder="Please insert the brand of the vaccine" name="brand_name">
                @error('brand_name')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div  class="mt-3">
                <label for="">Has dose?</label>
                <div class="relative mt-2" >
                    <select class="input w-full  border mr-2" name="has_dose">
                        <option value="">--- Select Dose ---</option>
                        <option value="1st-dose">1st dose</option>
                        <option value="2nd-dose">2nd dose</option>
                        <option value="3rd-dose">3rd dose</option>
                    </select>
                </div>
                @error('has_dose')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
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
