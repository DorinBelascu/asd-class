@extends('layout')

@section('content')

<div class="panel panel-primary">
  <div class="panel-heading">Selecteaza o materie</div>
  <div class="panel-body">
  	<div class="row">

  	@foreach($materii as $i => $materie)

<div class="col-md-3 col-xs-6">
<div style="text-align:center; margin:4px auto">
	<div class="dropdown" style="position:relative">
	   	<a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">{{ $materie->denumirea}} <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li>
		    	{{ HTML::link(URL::route('catalog-note',[
		    	'denumirea'  => $materie->denumirea, 
		    	'id_elev'    => $id,
		    	'id_materie' => $materie->id]), 'Note ...') }}
			</li>
		    <li>
		    	{{ HTML::link(URL::route('catalog-absente',[
		    	'denumirea'  => $materie->denumirea, 
		    	'id_elev'    => $id,
		    	'id_materie' => $materie->id]), 'Absente ...') }}
		    </li>
			<li>
				<a class="trigger right-caret">Media</a>
				<ul class="dropdown-menu sub-menu">
					<li><a href="#">Media pe semestrul 1 : {{$media1}}</a></li>
					<li><a href="#">Media pe semestrul 2 : {{$media2}}</a></li>
					<li><a href="#">Media pe ambele semestre : {{$mediatot}}</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
</div>

<!-- 	  	<div class="col-md-3 col-xs-6">
		        <div style="text-align:center; margin:4px auto">
	          		<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					    {{ $materie->denumirea}} <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					    <li>
					    	{{ HTML::link(URL::route('catalog-note',[
					    	'denumirea'  => $materie->denumirea, 
					    	'id_elev'    => $id,
					    	'id_materie' => $materie->id]), 'Note ...') }}
					    </li>
					    <li class="divider"></li>
					    <li>
					    	{{ HTML::link(URL::route('catalog-absente',[
					    	'denumirea'  => $materie->denumirea, 
					    	'id_elev'    => $id,
					    	'id_materie' => $materie->id]), 'Absente ...') }}
					    </li>

					    <li class="divider"></li>
						<li>
						</li>
					  </ul>
					</div>
		        </div>
		</div> -->
	@endforeach
	</div>
  </div>
</div>






@stop

@section('js')
<script>
$(function(){
	$(".dropdown-menu > li > a.trigger").on("click",function(e){
		var current=$(this).next();
		var grandparent=$(this).parent().parent();
		if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
			$(this).toggleClass('right-caret left-caret');
		grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
		grandparent.find(".sub-menu:visible").not(current).hide();
		current.toggle();
		e.stopPropagation();
	});
	$(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
		var root=$(this).closest('.dropdown');
		root.find('.left-caret').toggleClass('right-caret left-caret');
		root.find('.sub-menu:visible').hide();
	});
});
</script>
@stop
