<div class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		@include('includes.nav.pieces.project-name')
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				@include('includes.nav.pieces.catalog')
				@include('includes.nav.pieces.sistem')
				@include('includes.nav.pieces.statistici')
			</ul>
			<ul class="nav navbar-nav navbar-right">
				@include('includes.nav.pieces.profile')
				@include('includes.nav.pieces.log_out')
			</ul>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</div>