<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('assets/Admin/login/css/style.css')}}">

</head>
<body class="img js-fullheight" style="background-image: url({{asset('assets/Admin/login/images/bg.jpg')}});">
@yield('content')

<script src="assets/Admin/login/js/jquery.min.js"></script>
<script src="assets/Admin/login/js/popper.js"></script>
<script src="assets/Admin/login/js/bootstrap.min.js"></script>
<script src="assets/Admin/login/js/main.js"></script>

</body>
</html>

