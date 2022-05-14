@extends('layouts.app')
@section('title')
Show | Vaccination Status
@endsection
@section('breadcrumbs')
{{$child->childs_name}} > Vaccination Status
@endsection
@section('content')
<div class="intro-y block sm:flex items-center h-10 mt-6">
    <a href="{{route('child-vaccines.index')}}" class="button px-2 mr-1">
        <div class="flex">
            <span class="w-5 h-5 flex items-center justify-center"><i data-feather="arrow-left" class="w-4 h-4 mr-2"></i></span> Back
        </div>
    </a>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->

        <!-- BEGIN: Recent Activities -->
        <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
            
            <div class="report-timeline mt-5 relative">
            @foreach($child_vaccines as $vaccines)
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
                ?>
                @for($i = 0; $i < $vaccines->has_dose; $i++)
                    @if($ArrValDate[$i] != null)
                    <a href="{{route('child-vaccines.edit', ['child_id' => $child->id, 'vaccine_id' => $vaccines->vaccine_id])}}">
                    <div class="intro-x relative flex items-center mb-3">
                        <div class="report-timeline__image">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img src="{{asset('images/vaccine_logo.png')}}">
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                            <div class="flex items-center">
                                <div class="font-medium">{{ $vaccines->vaccines_name}}</div>
                                @if($child_vaccines->where($strArrVar[$vaccines->has_dose - 1], true)->where('id', $vaccines->id)->isEmpty())
                                <label class="text-white text-center rounded-md bg-theme-27 p-1 ml-auto mt-1">Partial-Vaccinated</label>
                                @else
                                <label class="text-white text-center rounded-md bg-theme-9 p-1 ml-auto mt-1">Fully-Vaccinated</label>
                                @endif
                                <div class="text-xs text-gray-500 ml-auto">{{Carbon\Carbon::parse($ArrValDate[$i])->format('M d, Y')}} - {{Carbon\Carbon::parse($ArrValDate[$i])->format('H:m:s A')}}</div>
                            </div>
                            <div class="text-gray-600 mt-1">{{$i+1}} dose</div>
                            
                            <div class="{{($strArrVal[$i] == 1)? 'text-green-600' : 'text-red-600';}} mt-1"><i>{{($strArrVal[$i] == 1)? 'Injected' : 'Waiting';}}</i></div>
                        </div>
                    </div>
                    </a>
                    @else
                    <a href="{{route('child-vaccines.edit', ['child_id' => $child->id, 'vaccine_id' => $vaccines->vaccine_id])}}">
                    <div class="intro-x relative flex items-center mb-3">
                        <div class="report-timeline__image">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img src="{{asset('images/vaccine_logo.png')}}">
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                            <div class="flex items-center">
                                <div class="font-medium">{{ $vaccines->vaccines_name}}</div>
                                @if($child_vaccines->where($strArrVar[$vaccines->has_dose - 1], true)->where('id', $vaccines->id)->isEmpty())
                                <label class="text-white text-center rounded-md bg-theme-27 p-1 ml-auto mt-1">Partial-Vaccinated</label>
                                @else
                                <label class="text-white text-center rounded-md bg-theme-9 p-1 ml-auto mt-1">Fully-Vaccinated</label>
                                @endif
                                <div class="text-xs text-red-500 ml-auto">Please set the date!</div>
                            </div>
                            <div class="text-gray-600 mt-1">{{$i+1}} dose</div>
                            
                            <div class="{{($strArrVal[$i] == 1)? 'text-green-600' : 'text-red-600';}} mt-1"><i>{{($strArrVal[$i] == 1)? 'Injected' : 'Waiting';}}</i></div>
                        </div>
                    </div>
                    </a>    
                    @endif
                   
                @endfor
             
            @endforeach
            </div>
            
        </div>
        <!-- END: Recent Activities -->


        <!-- END: Form Layout -->
    </div>
</div>
@endsection