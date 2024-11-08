<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
    public function store($data)
    {
        //Далее обращаемся к элементу ассоциативного массива tags и удаляем его посредством unset()
        $tags = $data['tags'];
        unset($data['tags']);

        // Создаем пост на основе $data
        $post = Post::create($data);

        //Вызываем метод tags() из модели Post(посредством связей), учитываем время создания поста и с помощью attach привязываем теги
        //Чтобы tags воспринимался, как запрос в базу, а не массив данных надо ОБЯЗАТЕЛЬНО поставить ()
        $post->tags()->withTimeStamps()->attach($tags);
    }

    public function update($post, $data)
    {
        $tags = $data['tags'];
        unset($data['tags']);

        //Обновляем записи поста
        $post->update($data);
        // Далее методом sync отправляем данные в промежуточную таблицу
        $post->tags()->sync($tags);
    }
}
