@extends('layout.main')
@section('content')
	
	<div>
		@foreach ($posts as $post )
			<div> <a href="{{ route('post.show', $post->id) }}">{{ $post->id }} . {{ $post->title }}</a></div>
		@endforeach
	</div>
	<div>
		<a href="{{ route('post.create') }}" class="btn btn-primary">Create new post</a>
	</div>
@endsection


