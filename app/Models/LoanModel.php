<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanModel extends Model
{
    protected $table = 'loans';

    // make relation to member
    public function member(): BelongsTo{
        return $this->belongsTo(MemberModel::class);
    }

    // make relation to book
    public function book(): BelongsTo{
        return $this->belongsTo(BookModel::class);
    }
}
