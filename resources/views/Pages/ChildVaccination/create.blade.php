@extends('layouts.app')
@section('title')
Create | Vaccinated Child
@endsection
@section('breadcrumbs')
Vaccinated Child > Create
@endsection
@section('content')
<div class="intro-y block sm:flex items-center h-10 mt-6">
    <h2 class="text-lg font-medium truncate mr-5">
        Create Vaccinated Child
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <form action="{{route('child-vaccines.store')}}" method="POST">
            @csrf
        <div class="intro-y box p-5">
            <div  class="mt-3">
                <div id="basic-select">
                    <div class="preview">
                        <label>Select Child</label>
                        <div class="mt-2">
                            <select data-search="true" class="tail-select w-full" name="child_id">
                                <option value="">---Select child---</option>
                                @foreach($child as $child_data)
                                <option value="{{$child_data->id}}">{{$child_data->childs_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('child_id')
                            <div class="text-theme-6 mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div  class="mt-3">
                <div id="basic-select">
                    <div class="preview">
                        <label>Select Vaccines</label>
                        <div class="mt-2">
                            <select data-placeholder="Select vaccine" name="vaccine_id[]" value="{{ old('vaccine_id') }}" data-search="true" class="tail-select w-full" multiple> 
                                @foreach($vaccine as $vaccine_data)
                                <option value="{{$vaccine_data->id}}">{{$vaccine_data->vaccines_name}}</option> 
                                @endforeach
                            </select> 
                        </div>
                        @if(session('error'))
                            <div class="text-theme-6 mt-2">{{session('error')}}</div>
                        @endif
                        @error('vaccine_id')
                            <div class="text-theme-6 mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-right mt-5">
                <a href="{{route('child-vaccines.index')}}" type="button" class="button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</a>
                <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
            </div>
        </div>
    </form>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection
