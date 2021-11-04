@extends('layouts.admin')

@section('styles')
@section('title')  Add Main Category @endsection
<link rel="stylesheet" href="{{asset('assets/Admin/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('assets/Admin/dist/css/adminlte.min.css')}}">
@endsection


@section('content')
@section('header')
    Add Main Category
@endsection

@section('all')
    <a href="{{route('admin.mainCategories')}}">
        ALL Main Categories
    </a>
@endsection
@section('other')
    Add
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
                        <h3 class="card-title">Add Form</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('admin.mainCategories.save')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile"> Photo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="photo">
                                        <label class="custom-file-label" for="exampleInputFile">Choose Photo</label>
                                    </div>
                                    @error('photo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            @if(getLanguage() -> count() >0)
                                @foreach( getLanguage() as $index => $lang)
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Category {{__('messages.'.$lang -> abbr)}}</label>
                                        <input type="text" class="form-control" placeholder="" name="category[{{$index}}][name]">
                                        @error('category.$index.name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6" style="display: none;">
                                    <div class="form-group">
                                        <label>Language Abbreviation {{$lang -> abbr}} </label>
                                        <input type="text" class="form-control" placeholder="" value="{{$lang -> abbr}}" name="category[{{$index}}][translation_lang]">
                                        @error('category.$index.translation_lang')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="category[{{$index}}][active]" value="1" checked>
                                        <label class="form-check-label" for="exampleCheck1">Active {{__('messages.'.$lang -> abbr)}}</label>
                                        @error('category.$index.active')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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


