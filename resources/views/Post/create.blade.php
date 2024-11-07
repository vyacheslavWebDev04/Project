@extends('layout.main')
@section('content')
    {{--    Отправляем данные в роут post.store, который вызовет метод store() из контроллера--}}
    <form action="{{ route('post.store') }}" method="post">
        @csrf
        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">Title </label>
            <input
                {{--                Данный метод old позволяет сохранять значения, которые были переданы по имени через инпут--}}
                value="{{ old('title') }}"
                type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
{{--            Директива @error('Name') позволяет выводить нужные нам сообщения об ошибках на экран для пользователя--}}
            @error('title')
            <p class="text-danger">{{ $message }}</p>
            @enderror

        </div>

        <div class="mb-3">

            <label for="exampleInputPassword1" class="form-label">Content</label>
            <input
                value="{{ old('content') }}"
                type="text" name="content" class="form-control" id="exampleInputPassword1">
            @error('content')
            <p class="text-danger">{{ $message }}</p>
            @enderror

        </div>

        <label for="category">Category</label>
        <select name="category_id" class="form-select" aria-label="Default select example" id="category">
            {{--            Здесь мы перебираем переменную $categories, которую получили из контроллера:метода create()--}}
            @foreach($categories as $category)
                <option
                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                    value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

        <p></p>

        <label for="form-select">Tags</label>
        {{--        Name tags[] позволяет нам передавать массив значений--}}
        <select name="tags[]" class="form-select" multiple aria-label="Multiple select example">
            {{--            Здесь так же перебор переменной $tags, которая содержит в себе массив записей из таблцы tags--}}
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
            @endforeach
        </select>

        <p></p>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
