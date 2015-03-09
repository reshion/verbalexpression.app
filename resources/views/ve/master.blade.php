<!DOCTYPE html>
<html lang="en" data-ng-app="veApp">
<head>
    @include('ve.components.head')
</head>
<body>

<div id="wrapper">

    @include('ve.navigation.top')

    <div class="container-fluid">

        @yield('content')

    </div>
</div>

@include('ve.components.footer')

@section('scripts_after')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
@show
</body>
</html>
