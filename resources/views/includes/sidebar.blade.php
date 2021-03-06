
<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="#" class="brand-link">
	<img src="{{ url('/images/fortygoals_icon.png') }}"
		 alt="fortygoals logo" class="brand-image img-circle elevation-3" style="opacity: .8">
	<span class="brand-text font-weight-light">forty goals</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
	
	<!-- Sidebar user panel (optional) -->
	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
	    <div class="image">
		<img src="{{ url('/images/unknown_user.png') }}" class="img-circle elevation-2" alt="User Image">
	    </div>
	    <div class="info">
		<a href="/" class="d-block">
		   {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} 
		</a>
	    </div>
	</div>

	<!-- Sidebar Menu -->
	<nav class="mt-2">
	    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<!-- Add icons to the links using the .nav-icon class
		     with font-awesome or any other icon font library -->
		<li class="nav-item">
		    <a href="/" class="nav-link">
			<i class="nav-icon fas fa-copy"></i>
			<p>
			    Account Setup
			</p>
		    </a>
		</li>
		<li class="nav-item">
		    <a href="/" class="nav-link">
			<i class="nav-icon fas fa-tachometer-alt"></i>
			<p>
			    Register Player
			</p>
		    </a>
		</li>

		<li class="nav-item">
		    <a href="#" class="nav-link">
			<i class="nav-icon fas fa-th"></i>
			<p>
			    Payment Status
			</p>
		    </a>
		</li>


		<li class="nav-item">
		    <a href="/" class="nav-link">
			<i class="nav-icon fas fa-th"></i>
			<p>
			    Player Profile Setup
			</p>
		    </a>
		</li>
		<li class="nav-item">
		    <a href="/" class="nav-link">
			<i class="nav-icon fas fa-th"></i>
			<p>
			    Player Profile View
			</p>
		    </a>
		</li>
		<li class="nav-item">
		    <a href="/" class="nav-link">
			<i class="nav-icon fas fa-trophy"></i>
			<p>
			    Rankings
			</p>
		    </a>
		</li>
		

		<li class="nav-header">ADDITIONAL INFO</li>
		<li class="nav-item">
		    <a href="#" class="nav-link">
			<i class="nav-icon fas fa-copy"></i>
			<p>
			    Help
			</p>
		    </a>
		</li>
		<li class="nav-item">
		    <a href="#" class="nav-link">
			<i class="nav-icon far fa-circle text-danger"></i>
			<p class="text">Contact Us</p>
		    </a>
		</li>
	    </ul>
	</nav>
    </div>

</aside>
