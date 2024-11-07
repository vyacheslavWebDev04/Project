<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        //Выборка через модель по id. Получаем все тэги у которых post_id = 1
//		$post = Post::find(1);
//		dd($post->tags);
        //Выборка через модель по id. Получаем все посты у которых tag_id = 1
//		$tag= Tag::find(1);
//		dd($tag->posts);

        // $posts = Post::where('category_id', $category->id)->get();
        // dd($posts);

        $posts = Post::all();
        return view('Post.index', compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('Post.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        //Получение данных из представления create посредством реквеста с последующей валидацией
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);

        //Далее обращаемся к элементу ассоциативного массива tags и удаляем его посредством unset()
        $tags = $data['tags'];
        unset($data['tags']);

        // Создаем пост на основе $data
        $post = Post::create($data);

        //Вызываем метод tags() из модели Post(посредством связей), учитываем время создания поста и с помощью attach привязываем теги
        //Чтобы tags воспринимался, как запрос в базу, а не массив данных надо ОБЯЗАТЕЛЬНО поставить ()
        $post->tags()->withTimeStamps()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('Post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('Post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        //Обновляем записи поста
        $post->update($data);
        // Далее методом sync отправляем данные в промежуточную таблицу
        $post->tags()->sync($tags);
        return redirect()->route('post.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index', compact('post'));
    }
}
