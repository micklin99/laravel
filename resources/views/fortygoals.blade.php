<!DOCTYPE html>

<html>
    <head>
	<title>Laravel 8 basic fortygoals CRUD Application/title></title>

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/fontawesome-free/all.min.css') }}" />

	<!-- Bootstrap 4 -->	
	<link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap/bootstrap.min.css') }}" />

	<!-- AdminLTE -->		
	<link rel="stylesheet" type="text/css" href="{{ url('/css/adminlte.min.css') }}" />

    </head>

    <body class="hold-transition sidebar-mini layout-fixed">

	<div class="wrapper">

	    <!-- Main Navigation Header Container -->
            @include('includes/navigation_bar')

	    <!-- Main Sidebar Container -->
            @include('includes/sidebar')

	    <!-- Content Wrapper. Contains page content -->
	    <div class="content-wrapper fortygoals-background">
		
		<!-- Content Header (Page header) -->
	      	@include('includes/content_header')

		<div class="row justify-content-center">
		    @yield('content')
		</div>
	    </div>
	    

	    <!-- Site Footer -->
            @include('includes/footer')

	</div>

	<!-- jQuery -->
        <script src="{{ url('/js/jquery/jquery.min.js') }}" ></script>

	<!-- Bootstrap 4 -->
        <script src="{{ url('/js/bootstrap/bootstrap.bundle.min.js') }}" ></script>

	<!-- AdminLTE -->		
        <script src="{{ url('/js/adminlte.js') }}" ></script>
	
    </body>
</html>


        
