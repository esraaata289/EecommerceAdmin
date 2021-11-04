@extends('layouts.admin')

@section('styles')
@section('title')  Edit Main Category @endsection
<link rel="stylesheet" href="{{asset('assets/Admin/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('assets/Admin/dist/css/adminlte.min.css')}}">
@endsection


@section('content')
@section('header')
    Edit Main Category
@endsection

@section('all')
    <a href="{{route('admin.mainCategories')}}">
        ALL Main Categories
    </a>
@endsection
@section('other')
    Edit {{$mainCategory -> name}}
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
                    <form method="post" action="{{route('admin.mainCategories.update' , $mainCategory -> id)}}" enctype="multipart/form-data">
                        @csrf
                        <input name="id" value="{{$mainCategory -> id}}" type="hidden">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile"> Photo</label>
                                <div class="text-center">
                                <img src="{{$mainCategory -> photo}}" alt="Category Photo" class="rounded-circle " style="height: 100px; width: 100px;">
                                </div>
                            </div>
                                <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="photo" >
                                        <label class="custom-file-label" for="exampleInputFile">Choose Photo</label>
                                    </div>
                                    @error('photo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Category {{__('messages.'.$mainCategory -> translation_lang)}}</label>
                                                <input type="text" class="form-control" placeholder="" value="{{$mainCategory -> name}}" name="category[0][name]">
                                                @error('category.0.name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6" style="display: none;">
                                            <div class="form-group">
                                                <label>Language Abbreviation {{$mainCategory -> translation_lang}} </label>
                                                <input type="text" class="form-control" placeholder="" value="{{$mainCategory -> translation_lang}}" name="category[0][translation_lang]">
                                                @error('category.0.translation_lang')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1"  name="category[0][active]"
                                                       @if($mainCategory -> active == 1) checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Active {{__('messages.'.$mainCategory -> translation_lang)}}</label>
                                                @error('category.0.active')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                  @isset($mainCategory -> categories)
                                      @foreach($mainCategory -> categories as $index => $translations)
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings{{$index}}" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false" aria-selected="false">{{__('messages.'.$translations -> translation_lang)}}</a>
                                    </li>
                                        @endforeach
                                    @endisset
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-two-tabContent">
                                    @isset($mainCategory -> categories)
                                        @foreach($mainCategory -> categories as $index => $translations)
                                    <div class="tab-pane fade" id="custom-tabs-two-settings{{$index}}" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                                        <form method="post" action="{{route('admin.mainCategories.update' , $translations -> Id)}}" enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$translations -> Id}}" type="hidden">
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Category {{__('messages.'.$translations -> translation_lang)}}</label>
                                                            <input type="text" class="form-control" placeholder="" value="{{$translations -> name}}" name="category[0][name]">
                                                            @error('category.0.name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Language Abbreviation {{$translations -> translation_lang}} </label>
                                                            <input type="text" class="form-control" placeholder="" value="{{$translations -> translation_lang}}" name="category[0][translation_lang]">
                                                            @error('category.0.translation_lang')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="exampleCheck1"  name="category[0][active]" value="1"
                                                                   @if($translations -> active == 1) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Active {{__('messages.'.$translations -> translation_lang)}}</label>
                                                            @error('category.0.active')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                        @endforeach
                                        @endisset
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
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


