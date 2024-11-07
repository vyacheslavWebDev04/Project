@extends('layout.main')
@section('content')
	
	<div>
			<div> {{ $post->id }} . {{ $post->title }}</div>
			<div> {{ $post->content }} </div>
	</div>
	<div>
		<p></p>
	</div>
	<div>
		<a href="{{ route('post.edit', $post->id)}}" class="btn btn-primary">Edit</a>
	</div>
	<div>
		<p></p>
	</div>
	<form action="{{ route('post.destroy', $post->id)}}" method="post">
		@csrf
		@method('delete')
		<input type="submit" value="Delete" class="btn btn-primary">
	</form>
	<div>
		<p></p>
	</div>
	<div>
		<a href="{{ route('post.index') }}" class="btn btn-primary">Back</a>
	</div>
@endsection


