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
                @error('vaccines_name')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
           
            <div  class="mt-3">
                <label>Description of Vaccines</label>
                <input type="text" class="input w-full border mt-2" placeholder="Please insert the description of the vaccine" value="{{$vaccine->brand_name}}" name="brand_name">
                @error('brand_name')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div  class="mt-3">
                <label for="">Has dose?</label>
                <div class="relative mt-2" >
                    <select class="input w-full  border mr-2" name="has_dose">
                        @for ($x = 1; $x <= 3; $x++)
                        <option {{($vaccine->has_dose == $x) ? 'selected' : ''}} value="{{$x}}">{{$x}} dose</option>
                        @endfor
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
