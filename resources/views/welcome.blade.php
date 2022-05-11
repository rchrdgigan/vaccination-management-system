@extends('layouts.app')
@section('title')
Dashboard
@endsection
@section('content')
<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            General Report
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user report-box__icon text-theme-9"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                    <div class="text-3xl font-bold leading-8 mt-6">0</div>
                    <div class="text-base text-gray-600 mt-1">Total of Registered Child</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user report-box__icon text-theme-9"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                    <div class="text-3xl font-bold leading-8 mt-6">0</div>
                    <div class="text-base text-gray-600 mt-1">Total of Partial Vaccinated</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user report-box__icon text-theme-9"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                    <div class="text-3xl font-bold leading-8 mt-6">0</div>
                    <div class="text-base text-gray-600 mt-1">Total of Fully Vaccinated</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user report-box__icon text-theme-9"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                    <div class="text-3xl font-bold leading-8 mt-6">0</div>
                    <div class="text-base text-gray-600 mt-1">Total of Registered Midwife</div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-span-12 lg:col-span-6 mt-8">
    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            Vaccinated Statistic
        </h2>
    </div>
    <div class="intro-y box p-5 mt-12 sm:mt-5">
        <div class="flex flex-col xl:flex-row xl:items-center">
            <div class="flex">
                <div>
                    <div class="text-theme-20 dark:text-gray-300 text-lg xl:text-xl font-bold">0</div>
                    <div class="text-gray-600 dark:text-gray-600">Vaccinated This Month</div>
                </div>
            </div>
        </div>
        <div id="chart" style="height: 300px;"></div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('vax_chart')",
            hooks: new ChartisanHooks()
                .legend({position: 'bottom'})
        });
    </script>
@endpush
