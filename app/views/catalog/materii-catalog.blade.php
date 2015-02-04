@extends('layout')

@section('content')

<div class="panel panel-primary">
  <div class="panel-heading">Selecteaza o materie a elevului {{$nume_elev}}</div>
  <div class="panel-body">
  	<div class="row">

  	@foreach($materii as $i => $materie)

<div class="col-md-3 col-xs-6">
<div style="text-align:center; margin:4px auto">
	<div class="dropdown" style="position:relative">
	   	<a href="#" class="btn btn-default dropdown-toggle" rel="tooltip" data-toggle="dropdown" title="{{ $materie->denumirea }}" >{{ HTML::image('images/photos/materii/' . str_replace('(-)', 'icon', $materie->photo), $materie->photo,['class' => 'img-responsive', 'style' => 'width:100%']) }} <span class="caret"></span></a>
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
				<ul class="dropdown-menu sub-menu medii">
					<li><a href="#">Media pe semestrul 1 : {{$medii[$materie->id]['medie1']}}</a></li>
					<li><a href="#">Media pe semestrul 2 : {{$medii[$materie->id]['medie2']}}</a></li>
					<li><a href="#">Media pe ambele semestre : {{$medii[$materie->id]['medietot']}}</a></li>
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
		var index=$(this).parent().parent().attr('id').replace('materia-','');
		console.log(index);
		console.log(current);
		var grandparent=$(this).parent().parent();
		if(index % 4 == 0)
		{
			if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
				$(this).toggleClass('right-caret left-caret');
			grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
			grandparent.find(".sub-menu:visible").not(current).hide();
			current.toggle();
			e.stopPropagation();
		}
		else
		{
			if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
				$(this).toggleClass('right-caret left-caret');
			grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
			grandparent.find(".sub-menu:visible").not(current).hide();
			current.toggle();
			e.stopPropagation();
		}
	});
	$(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
		var root=$(this).closest('.dropdown');
		console.log(2);
				console.log(root);
		root.find('.left-caret').toggleClass('right-caret left-caret');
		root.find('.sub-menu:visible').hide();
	});
});
$('a').tooltip();
</script>
@stop
