<!DOCTYPE html>

<html>
    <head>
	<title>Laravel 8 basic fortygoals CRUD Application/title></title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet" />
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
    </body>
</html>
