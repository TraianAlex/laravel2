<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="/">Laravel 5</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li class="active"><a href="{{ URL::route('home') }}">Home</a></li>
			<li><a href="{{url('founds')}}">Get Founds</a></li>
			@if(Auth::check())
				<li><a href="{{ URL::route('account-sign-out') }}">Sign out</a></li>
				<li><a href="{{ URL::route('account-change-password') }}">Change password</a></li>
				<li><a href="{{ URL::route('profile-user', Auth::user()->username) }}">Profile</a></li>
			@else
				<li><a href="{{ URL::route('account-sign-in') }}">Sign in</a></li>
				<li><a href="{{ URL::route('account-create') }}">Create an account</a></li>
			@endif
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="#">Link</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li><a href="#">Separated link</a></li>
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>