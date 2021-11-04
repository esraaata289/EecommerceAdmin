@extends('layouts.admin')

@section('styles')
    @section('title')  Languages @endsection
<link rel="stylesheet" href="{{asset('assets/Admin/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('assets/Admin/dist/css/adminlte.min.css')}}">
@endsection


@section('content')
        @section('header')
           Edit Language
        @endsection

        @section('all')
            <a href="{{route('admin.languages')}}">
            ALL Language
            </a>
        @endsection
        @section('other')
                Edit
        @endsection
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                @include('admin.includes.alerts.success')
                @include('admin.includes.alerts.error')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Form</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('admin.languages.update',$language->Id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                             <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"  name="name" value="{{$language -> name}}">
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Abbreviation</label>
                                        <input type="text" class="form-control" value="{{$language -> abbr}}" name="abbr">
                                        @error('abbr')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Direction</label>
                                        <select name="direction" class="form-control">
                                           <optgroup label="please enter your direction">
                                               <option value="rtl" @if($language -> direction == 'rtl') selected @endif>Right To Left</option>
                                               <option value="ltr" @if($language -> direction == 'ltr') selected @endif>Left To Right</option>
                                           </optgroup>
                                        </select>
                                        @error('direction')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="active" value="1"
                                      @if($language -> active == 1) checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Active</label>
                                @error('active')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
                <!-- /.card -->




@endsection

@section('scripts')
    <script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection


