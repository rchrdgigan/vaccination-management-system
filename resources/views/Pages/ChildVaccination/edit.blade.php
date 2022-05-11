@extends('layouts.app')
@section('title')
Edit | Vaccines
@endsection
@section('breadcrumbs')
Vaccines > Edit
@endsection
@push('links')

@endpush
@section('content')
<div class="intro-y block sm:flex items-center h-10 mt-6">
    <h2 class="text-lg font-medium truncate mr-5">
        Edit Child Vaccination
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
            @if(session('message'))
            <div class="rounded-md flex items-center px-5 py-4 mb-2 border border-theme-9 text-theme-9 dark:border-theme-9"> 
                <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> 
                {{ session('message') }}
            </div>
            @endif
           
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Profile Menu -->
                <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
                    <div class="intro-y box mt-5">
                        <div class="relative flex items-center p-5">
                            <div class="w-12 h-12 image-fit">
                                @if($child->gender == 'Male')
                                    <img class="rounded-full" src="{{asset('images/son.png')}}">
                                @else
                                    <img class="rounded-full" src="{{asset('images/daughter.png')}}">
                                @endif
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium text-base">{{$child->childs_name}}</div>
                                <div class="text-gray-600">Date of Birth : {{Carbon\Carbon::parse($child->date_of_birth)->format('M d, Y')}}</div>
                            </div>
                            
                        </div>
                        <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                            <a class="flex items-center mt-5"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Family No. : {{$child->family_no}} </a>
                            <a class="flex items-center mt-5"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Mother : {{$child->mothers_name}} </a>
                            <a class="flex items-center mt-5"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Father :  {{$child->fathers_name}} </a>
                            <a class="flex items-center mt-5"> <i data-feather="navigation" class="w-4 h-4 mr-2"></i> Address : {{$child->address}} </a>
                            <a class="flex items-center mt-5"> <i data-feather="calendar" class="w-4 h-4 mr-2"></i> Date of Registration : {{Carbon\Carbon::parse($child->date_of_registration)->format('M d, Y')}} </a>
                            <a class="flex items-center mt-5"> <i data-feather="map-pin" class="w-4 h-4 mr-2"></i> Place of Birth : {{$child->place_of_birth}} </a>
                        </div>
                        <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                            <a class="flex items-center mt-5"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Gender : {{$child->gender}} </a>
                            <a class="flex items-center mt-5"> <i data-feather="hash" class="w-4 h-4 mr-2"></i> Weight : {{$child->birth_height}} </a>
                            <a class="flex items-center mt-5"> <i data-feather="hash" class="w-4 h-4 mr-2"></i> Height : {{$child->birth_weight}} </a>
                        </div>
                    </div>
                </div>
                <!-- END: Profile Menu -->

                <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            
                    <!-- BEGIN: Daily Sales -->
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                            <a href="{{route('child-vaccines.index')}}" class="button px-2 mr-1 box">
                                <div class="flex">
                                    <span class="w-5 h-5 flex items-center justify-center"><i data-feather="arrow-left" class="w-4 h-4 mr-2"></i></span> Back
                                </div>
                            </a>
                            <h2 class="font-medium text-base mx-auto">
                                Vaccine Information
                            </h2>
                            <a href="{{route('child-vaccines.available',$child->id)}}" class="button px-2 mr-1 box">
                                <div class="flex">
                                    <span class="w-5 h-5 flex items-center justify-center"><i data-feather="eye" class="w-4 h-4 mr-2"></i></span> Available Vaccines
                                </div>
                            </a>
                            
                        </div>
                        
                        <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5 p-5">
                        @foreach($child_vaccines as $data)
                            <div class="col-span-12 md:col-span-4 xxl:col-span-4 box p-5 cursor-pointer zoom-in">
                                <div class="font-medium text-base">{{$data->vaccine->vaccines_name}} - {{$data->vaccine->has_dose}} Dose</div>
                                <div class="text-gray-600">{{$data->vaccine->brand_name}}</div>
                                <div class="text-gray-600">
                                    @foreach($data->dose_inject as $sub_data)
                                        <input type="checkbox" disabled {{($sub_data->has_inj == true)? 'checked' : ''}} value="1"> {{$sub_data->dose}} dose |
                                        @if($sub_data->inj_date != null)
                                        <input type="datetime-local" readonly value="{{Carbon\Carbon::parse($sub_data->inj_date)->format('Y-m-d\TH:i')}}"><br>
                                        @else
                                        <input type="datetime-local" readonly><br>
                                        @endif
                                        <a href="javascript:;" data-toggle="modal" data-target="#edit-modal-preview"
                                                                data-id="{{$sub_data->id}}" 
                                                                data-vaccine_id="{{$data->vaccine->id}}" 
                                                                data-vaccine_name="{{$data->vaccine->vaccines_name}}"
                                                                data-vaccine_dose="{{$data->vaccine->has_dose}}"
                                                                data-vaccine_description="{{$data->vaccine->brand_name}}"  
                                                                data-dose="{{$sub_data->dose}}" 
                                                                data-remarks="{{$sub_data->reason}}" 
                                                                data-status="{{$sub_data->status}}"
                                                                data-date="{{Carbon\Carbon::parse($sub_data->inj_date)->format('Y-m-d\TH:i')}}"
                                                                data-inj="{{$sub_data->has_inj}}"  
                                                                class="flex items-center block mb-2 edit-dialog"><i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit</a>
                                    @endforeach
                                    @if($data->status != 'Fully-Vaccinated')
                                    <label for="">Remarks : </label>
                                    <textarea type="text" class="input mt-2 ml-2 border" readonly>{{$sub_data->reason}}</textarea><br>
                                    @endif
                                    <label for="">Status : </label>
                                    @if($sub_data->status != 'Pending')
                                    <a class="text-white {{($data->status == 'Fully-Vaccinated')? 'bg-theme-9' : 'bg-theme-20' }} mt-2 mr-2 rounded-lg p-1">{{$data->status}}</a><br>
                                    @else
                                    <a class="text-white {{($sub_data->status == 'Pending')? 'bg-theme-15' : 'bg-theme-20' }} mt-2 mr-2 rounded-lg p-1">{{$sub_data->status}}</a><br>
                                    @endif
                                </div>
                                <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical w-5 h-5 text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg> </a>
                                    <div class="dropdown-box w-40" id="_f7cx5pv5u" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; transform: translate(-140px, 20px);">
                                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                            <a href="{{route('child-vaccines.destroy',$data->id)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-1"></i>  Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3 p-3">
                                @if($data->vaccine->has_dose !== $sub_data->dose)
                                    <a href="javascript:;" data-toggle="modal" data-target="#add-modal-preview" 
                                                            data-child_id="{{$child->id}}" 
                                                            data-vaccine_id="{{$data->vaccine->id}}" 
                                                            data-vaccine_name="{{$data->vaccine->vaccines_name}}"
                                                            data-vaccine_dose="{{$data->vaccine->has_dose}}"
                                                            data-vaccine_description="{{$data->vaccine->brand_name}}"  
                                                            data-dose="{{$sub_data->dose+1}}" 
                                                            class="button button--sm text-white bg-theme-1 mt-2 mr-2 open-dialog">Add Dose</a>
                                @endif
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <!-- END: Daily Sales -->

                </div>
               
            </div>
        <!-- END: Form Layout -->
    </div>
</div>
<!-- Modal-Edit -->
<div class="modal" id="edit-modal-preview">
    <div class="modal__content p-10">
        <form action="{{route('child-vaccines.update',$child->id)}}" method="POST">
        @csrf
        @method('PUT')
            <div class="modal-body">
                <input hidden id="vaccine_id" name="vaccine_id">
                <input hidden id="id" name="vacc_dose_id">
                <div class="font-medium text-base">
                    <input id="vacc_dose">
                </div>
                <div class="text-gray-600">
                    <input id="description">
                </div>
                <div class="text-gray-600">
                    <input type="checkbox" name="has_inj" id="has_inj" value="1"><input class="w-4 m-2" id="dose" readonly> dose |
                    <input type="datetime-local" id="date" name="inj_date" required><br>
                    <label for="">Status :</label>
                        <select class="input w-18 border mt-2 flex-1 ml-2" name="status" id="status">
                            <option value="Normal">Normal</option>
                            <option value="Pending">Pending</option>
                        </select>
                    <br>
                    <label for="">Reason :</label>
                    <textarea type="text" class="input ml-2 mt-2 border" name="reason" id="remarks"></textarea><br>
                </div>
                <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical w-5 h-5 text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg> </a>
                    <div class="dropdown-box w-40" id="_f7cx5pv5u" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; transform: translate(-140px, 20px);">
                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-1"></i>  Remove </a>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-3 p-3">
                    <button type="button" data-dismiss="modal" class="button button--sm text-white bg-theme-1 mt-2 mr-2">Cancel</button>
                    <button class="button button--sm text-white bg-theme-1 mt-2 mr-2">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal-Add -->
<div class="modal" id="add-modal-preview">
    <div class="modal__content p-10">
        <form action="{{route('child-vaccines.add',$child->id)}}" method="POST" id="vacc_frm">
        @csrf
            <div class="modal-body">
                <input hidden id="vaccine_id" name="vaccine_id">
                <div class="font-medium text-base">
                    <input id="vacc_dose">
                </div>
                <div class="text-gray-600">
                    <input id="description">
                </div>
                <div class="text-gray-600">
                    <input type="checkbox"  name="has_inj" value="1"><input class="w-4 m-2" name="dose" id="dose" readonly> dose |
                    <input type="datetime-local" required name="inj_date"><br>
                    <label>Status :</label>
                    <select class="input w-18 border mt-2 flex-1 ml-2" name="status">
                        <option value="Normal">Normal</option>
                        <option value="Pending">Pending</option>
                    </select>
                    <br>
                    <label>Remarks :</label>
                    <textarea type="text" class="input ml-2 mt-2 border" name="reason"></textarea><br>
                  
                </div>
            </div>
            <div class="text-right mt-3 p-3">
                <button type="button" data-dismiss="modal" class="button button--sm text-white bg-theme-1 mt-2 mr-2">Cancel</button>
                <button class="button button--sm text-white bg-theme-1 mt-2 mr-2">Add</button>
               
            </div>
        </form>
    </div>
</div>
@endsection
