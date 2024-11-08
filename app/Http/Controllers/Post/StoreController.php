<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        //Получение данных из представления create посредством реквеста с последующей валидацией
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('post.index');
    }
}
