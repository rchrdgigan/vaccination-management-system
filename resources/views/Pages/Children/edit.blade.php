@extends('layouts.app')
@section('title')
Edit | Children
@endsection
@section('breadcrumbs')
Edit
@endsection
@section('content')
<div class="intro-y block sm:flex items-center h-10 mt-6">
    <h2 class="text-lg font-medium truncate mr-5">
        Edit Child
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <form action="{{route('children.update',$child->id)}}" name="myForm" method="POST">
            @csrf
            @method('PUT')
        <div class="intro-y box p-5">
            <div  class="mt-3">
                <label>Family's Number</label>
                <input type="text" class="input w-full border mt-2" placeholder="Please insert the Family number" name="family_no" value="{{$child->family_no}}">
                @error('family_no')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div  class="mt-3">
                <label>Child's Name</label>
                <input type="text" class="input w-full border mt-2" placeholder="Please insert the Full name of the Child" name="child_name" value="{{$child->childs_name}}">
                @error('child_name')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div  class="mt-3">
                <label>Mother's Name</label>
                <input name="mother_name" type="text" class="input w-full border mt-2" placeholder="Please insert the Full name of the Mother" value="{{$child->mothers_name}}">
                @error('mother_name')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div  class="mt-3">
                <label>Father's Name</label>
                <input  name="father_name" type="text" class="input w-full border mt-2" placeholder="Please insert the Full name of the Father" value="{{$child->fathers_name}}">
                @error('father_name')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label>Date of Registration</label>
                <input name="reg_date" class="datepicker input w-full border mt-2" data-single-mode="true" value="{{$child->date_of_registration}}">
                @error('reg_date')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label>Date of Birth</label>
                <input name="birth_date" class="datepicker input w-full border mt-2" data-single-mode="true" value="{{$child->date_of_birth}}">
                @error('birth_date')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label>Place of Birth</label>
                <div class="relative mt-2">
                    <input name="birth_place" type="text" class="input pr-16 w-full border col-span-4" placeholder="Place of Birth" value="{{$child->place_of_birth}}">
                </div>
                @error('birth_place')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label>Birth Height</label>
                <div class="relative mt-2">
                    <input name="height" type="text" onkeypress="return validate();" class="input pr-16 w-full border col-span-4" placeholder="Birth Height" value="{{$child->birth_height}}">
                    <p id="height_err" class="text-theme-6 mt-2"></p>
                </div>
                @error('height')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label>Birth Weight</label>
                <div class="relative mt-2">
                    <input name="weight" type="text" onkeypress="return validate();" class="input pr-16 w-full border col-span-4" placeholder="Birth Weight" value="{{$child->birth_weight}}">
                    <p id="weight_err" class="text-theme-6 mt-2"></p>
                </div>
                @error('weight')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label>Address</label>
                <div class="relative mt-2">
                    <input name="address" type="text" class="input pr-16 w-full border col-span-4" placeholder="Purok/Street Barangay" value="{{$child->address}}">
                </div>
                @error('address')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="">Gender</label>
                <div class="relative mt-2" >
                    <select class="input w-full  border mr-2" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                @error('gender')
                    <div class="text-theme-6 mt-2">{{$message}}</div>
                @enderror
            </div> 
            <div class="text-right mt-5">
                <a href="{{route('children.index')}}" type="button" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</a>
                <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
            </div>
        </div>
    </form>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection
