<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoryModel extends Model
{
    protected $table = 'categories';

    // make relation to book
    public function book(): BelongsToMany{
        return $this->belongsToMany(BookModel::class, 'book_category', 'book_id', 'category_id');
    }
}
