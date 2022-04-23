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
        Edit Child Vaccination
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        
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
                            
                        </div>
                        
                        <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5 p-5">
                        @foreach($child_vaccines as $vaccines)
                            <div class="col-span-12 md:col-span-4 xxl:col-span-4 box p-5 cursor-pointer zoom-in">
                                <form action="{{route('child-vaccines.update',$vaccines->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                    <div class="font-medium text-base">{{$vaccines->vaccines_name}}</div>
                                    <div class="text-gray-600">{{$vaccines->brand_name}}</div>
                                    <div class="text-gray-600">
                                        <?php 
                                        $strArrVal = array($vaccines->has_inj_1st_dose,
                                                            $vaccines->has_inj_2nd_dose,
                                                            $vaccines->has_inj_3rd_dose);

                                        $ArrValDate = array($vaccines->inj_1st_date,
                                                            $vaccines->inj_2nd_date,
                                                            $vaccines->inj_3rd_date);

                                        $strArrVar = array('has_inj_1st_dose',
                                                            'has_inj_2nd_dose',
                                                            'has_inj_3rd_dose');

                                        $ArrVarDate = array('inj_1st_date',
                                                            'inj_2nd_date',
                                                            'inj_3rd_date');
                                        ?>
                                        @for($i = 0; $i < $vaccines->has_dose; $i++)
                                            <input type="checkbox"  name="{{$strArrVar[$i]}}" {{($strArrVal[$i] == 1)? 'checked' : '';}} value="1"> {{$i+1}} dose |
                                            @if($ArrValDate[$i] != null)
                                            <input type="datetime-local" name="{{$ArrVarDate[$i]}}" value="{{Carbon\Carbon::parse($ArrValDate[$i])->format('Y-m-d\TH:i')}}"><br>
                                            @else
                                            <input type="datetime-local" name="{{$ArrVarDate[$i]}}"><br>
                                            @endif
                                        @endfor

                                        @if($child_vaccines->where( $strArrVar[$vaccines->has_dose - 1], true)->where('id', $vaccines->id)->isEmpty())
                                        <div class="text-left mt-1 p-1">
                                            <label class="text-white text-center rounded-md bg-theme-27 p-1 mt-1">Partial-Vaccinated</label>
                                        </div>
                                        @else
                                        <div class="text-left mt-1 p-1">
                                            <label class="text-white text-center rounded-md bg-theme-9 p-1 mt-1">Fully-Vaccinated</label>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical w-5 h-5 text-gray-500"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg> </a>
                                        <div class="dropdown-box w-40" id="_f7cx5pv5u" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; transform: translate(-140px, 20px);">
                                            <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                                <a href="{{route('child-vaccines.remove',$vaccines->id)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-1"></i>  Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right mt-3 p-3">
                                        <a href="{{route('child-vaccines.show', $child->id)}}" class="button button--sm text-white bg-theme-34 mr-2">Vaccine Status</a>
                                        <button type="submit" class="button button--sm text-white bg-theme-1 mt-2 mr-2">Update</button>
                                    </div>
                                </form>
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
@endsection
