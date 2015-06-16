@exnteds('layouts.master')

@section('breadcrumbs')
	{!! Breadcrumbs::render('home') !!}
@stop

@section('content')

@stop

@section('sidebar')
	@include('includes.sidebar')
@stop