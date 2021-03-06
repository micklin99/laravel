<!-- Navigation Bar -->

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
	<li class="nav-item">
	    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
		<i class="fas fa-bars"></i>
	    </a>
	</li>

	<li class="nav-item d-none d-sm-inline-block">
	    <a class="nav-link"><?php echo "Dummy Club" ?></a>
	</li>

    </ul>

    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">
	<!-- Messages Dropdown Menu -->

	<li class="nav-item dropdown">
	    <a class="nav-link"
	       href="#";
		<i class="fas fa-cog"></i>
	    </a>
	</li>

	<form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                {{ __('Log out') }}
            </x-dropdown-link>
        </form>


    </ul>
</nav>



