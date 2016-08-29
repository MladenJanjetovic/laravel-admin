@extends('admin::layouts.admin')

@section('admin-content')

	<div>
		<a href="pages/create" class="button right">Create page</a>
		<h1>Pages</h1>
		<span class="last-update"></span>
	</div>
	
	<ul>
		@foreach ($pages as &$page)
			<li><a href="pages/edit/{{$page->id}}"><b>{{$page->title}}</a></li>
		@endforeach
	</ul>

@stop