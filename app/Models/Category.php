<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
	protected $guarded = [];
	public $timestamps = false;

    public function posts()
	 {
		//функция, которая говорит нам, о отношении объекта $this к другому объекту
		return $this->hasMany(Post::class, 'category_id', 'id');
	 }
}
