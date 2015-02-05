@if( ! Sentry::check() )
	@include('includes.nav.navigation-without-user')
@else
	@include('includes.nav.navigation-' . User::find(Sentry::getUser()->id)->groupName() )
@endif