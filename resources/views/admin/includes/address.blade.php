
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@yield('header')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">
                            @yield('all')
                    </li>
                    <li class="breadcrumb-item active">
                        @yield('other')
                    </li>
                </ol>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>

