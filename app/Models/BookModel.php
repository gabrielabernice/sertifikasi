<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BookModel extends Model
{
    protected $table = 'books';

    // make relarion to category
    public function category(): BelongsToMany{
        return $this->belongsToMany(CategoryModel::class, 'book_category', 'book_id', 'category_id');
    }

    // make relation with member
    public function member(): BelongsTo{
        return $this->belongsTo(MemberModel::class);
    }
}
