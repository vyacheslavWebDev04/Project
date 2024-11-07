@extends('layout.main')
@section('content')
<form action="{{ route('post.update', $post->id) }}" method="post">
	@csrf
	@method('patch')
	<div class="mb-3">
	  <label for="exampleInputEmail1" class="form-label">Title </label>
	  <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $post->title }}">
	</div>
	<div class="mb-3">
	  <label for="exampleInputPassword1" class="form-label">Content</label>
	  <input type="text" name="content" class="form-control" id="exampleInputPassword1" value="{{ $post->content }}">
	</div>
    <label for="category">Category</label>
    <select name="category_id" class="form-select"  id="category">
        @foreach($categories as $category)
            <option
                {{$category->id == $post->category->id ? 'selected' : '' }}
                value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
    </select>
    <label for="tags">Tags</label>
    <select name="tags[]" class="form-select" multiple aria-label="Multiple select example" id="tags">
        @foreach($tags as $tag)
            <option
                @foreach($post->tags as $postTag)
                    {{ $tag->id == $postTag->id ? 'selected' : '' }}
                @endforeach
                value="{{ $tag->id }}">{{ $tag->title }}</option>
        @endforeach
    </select>
    <p></p>
	<button type="submit" class="btn btn-primary">Update</button>
 </form>
@endsection
