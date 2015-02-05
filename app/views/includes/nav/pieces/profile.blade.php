@if(Sentry::check())
<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Sentry::getUser()->email }} <span class="caret"></span></a>
	<ul class="dropdown-menu" role="menu">
		<li><a href="{{ URL::route('user-profile')}}">Profile</a></li>
	</ul>
</li>
@endif