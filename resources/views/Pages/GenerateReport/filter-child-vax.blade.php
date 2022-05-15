@extends('layouts.app')
@section('title')
Vaccines | Report
@endsection
@section('breadcrumbs')
Generate Report > Vaccines Report
@endsection
@push('links')
<link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush
@section('content')
<x-warning/>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Generate Children Vaccines Report</h3>
            <!-- BEGIN:Filter -->
            <div class="intro-y float-right flex flex-col-reverse sm:flex-row items-center">
                <div class="w-full sm:w-auto relative mr-auto sm:mt-0">
                    <input type="button" class="button w-full box px-10 text-white bg-theme-3" value="Filter">
                    <div class="inbox-filter dropdown absolute inset-y-0 mr-3 right-0 flex items-center" data-placement="bottom-start">
                        <i class="dropdown-toggle w-4 h-4 cursor-pointer text-white dark:text-gray-300" data-feather="chevron-down"></i> 
                        <div class="inbox-filter__dropdown-box dropdown-box pt-2">
                            <div class="dropdown-box__content box p-5">
                                <form method="GET">
                                    <div class="grid grid-cols-12 gap-4 row-gap-3">
                                        <div class="col-span-6">
                                            <div class="text-xs">Date From</div>
                                            <input type="datetime-local" class="input w-full border mt-2 flex-1" name="from">
                                        </div>
                                        <div class="col-span-6">
                                            <div class="text-xs">Date To</div>
                                            <input type="datetime-local" class="input w-full border mt-2 flex-1" name="to">
                                        </div>
                                        <div class="col-span-6">
                                            <div class="text-xs">Vaccine Name</div>
                                            <input type="text" class="input w-full border mt-2 flex-1" required name="vaccines_name" placeholder="Vaccine">
                                        </div>
                                        <div class="col-span-6">
                                            <div class="text-xs">Dose</div>
                                                <select class="input w-full border mt-2 flex-1" required name="dose">
                                                    @for ($x = 1; $x <= 3; $x++)
                                                    <option {{($vaccine->has_dose == $x) ? 'selected' : ''}} value="{{$x}}">{{$x}} dose</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        <div class="col-span-12 flex items-center mt-3">
                                            <button class="button w-32 justify-center block bg-theme-1 text-white ml-2">Generate Vaccinated</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END:Filter -->
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Child Name</th>
                        <th>Vaccine Name</th>
                        <th>Dose</th>
                        <th>Date & Dose Injected</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($child_vaccines as $data)
                    <tr>
                        <td>{{$data->childs_name}}</td>
                        <td>{{ $data->vaccines_name}}</td>
                        <td>{{ $data->has_dose}}</td>
                        <td>
                            {{(isset( $data->inj_3rd_date)) ?
                            Carbon\Carbon::parse( $data->inj_3rd_date)->format('M d, Y') .' - '. ' 3rd Dose ' :
                            (isset( $data->inj_2nd_date) ? Carbon\Carbon::parse( $data->inj_2nd_date)->format('M d, Y') .' - '. ' 2nd Dose ':
                            (isset( $data->inj_1st_date) ? Carbon\Carbon::parse( $data->inj_1st_date)->format('M d, Y') .' - '. ' 1st Dose ' : 'N/A'))}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Child Name</th>
                        <th>Vaccine Name</th>
                        <th>Dose Injected</th>
                        <th>Date</th>
                    </tr>
                </tfoot>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@push('scripts')
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush
