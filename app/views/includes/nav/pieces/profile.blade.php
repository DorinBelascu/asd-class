@if(Sentry::check())
<li>{{ HTML::image('images/roles/' . ($role = User::find(Sentry::getUser()->id)->groupName()) . '.png', $role,['style' => 'width:48px', 'title'=> $role])}}</li>
<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Sentry::getUser()->email }} <span class="caret"></span></a>
	<ul class="dropdown-menu" role="menu">
		<li><a href="{{ URL::route('user-profile')}}">Setari</a></li>
	</ul>
</li>
@endif