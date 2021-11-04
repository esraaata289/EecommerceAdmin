@extends('layouts.admin')

@section('styles')
    @section('title') Main Categories @endsection
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/Admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/Admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/Admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/Admin/dist/css/adminlte.min.css')}}">
@endsection


@section('content')
        @section('header')
            All Main Categories
        @endsection
        @section('all')
            All
        @endsection
        @section('other')
            <a href="{{asset('admin/mainCategories/create')}}">
            Add Category
            </a>
        @endsection

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.error')
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>language</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Others</th>
                                </tr>
                                </thead>
                                <tbody>
                             @isset($categories)
                                 @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->translation_lang}}</td>
                                    <td><img style="width : 100px ; height: 100px;" src="{{$category-> photo}}"></img></td>
                                    <td>{{$category->getActive()}}</td>
                                    <td>
                                        <div class="btn-group" role="group"
                                             aria-label="Basic example">
                                            <a href="{{ route('admin.mainCategories.edit',$category -> id) }}"
                                               class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>

                                            <a href="{{ route('admin.mainCategories.delete',$category -> id) }}"
                                               class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">Delete</a>

                                            <a href="{{route('admin.mainCategories.changeStatus',$category -> id)}}"
                                               class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                @if($category -> active == 0)
                                                    Change to active
                                                @else
                                                    Change to non active
                                                @endif
                                                 </a>
                                        </div>

                                    </td>
                                </tr>
                                 @endforeach
                             @endisset
                                </tbody>

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
    </section>


@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="{{asset('assets/Admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('assets/Admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/Admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/Admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/Admin/dist/js/demo.js')}}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
@endsection


