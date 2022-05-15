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
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Generate Vaccines Report</h3>
            <form methods="GET">
                <button type="submit" class="button w-24 bg-theme-1 float-right text-white mt-2 ml-2">Filter</button>
                <input name="to" class="datepicker float-right input w-40 border mt-2" data-single-mode="true"> 
                <label class="float-right mt-3 mr-2 ml-2"> Date To: </label>
                <input name="from" class="datepicker float-right input w-40 border mt-2" data-single-mode="true"> 
                <label class="float-right mt-3 mr-2"> Date From: </label>
            </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vaccine Name</th>
                        <th>Dose</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th>3rd Dose</th>
                    </tr>
                </thead>
               
                <tbody>
                @foreach($vaccines as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->vaccines_name}}</td>
                        <td>{{$data->has_dose}}</td>
                        <td>{{$child_vax->where('vaccine_id',$data->id)->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_1st_dose', true)
                            ->count()}}</td>

                        <td>{{$child_vax->where('vaccine_id',$data->id)->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_2nd_dose', true)
                            ->count()}}</td>


                        <td>{{$child_vax->where('vaccine_id',$data->id)->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_3rd_dose', true)
                            ->count()}}</td>

                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Vaccine Name</th>
                        <th>Dose</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th>3rd Dose</th>
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
