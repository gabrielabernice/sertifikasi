<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MemberModel extends Model
{
    protected $table = 'members';

    // make relaiton with loan
    public function loan(): HasMany{
        return $this->hasMany(LoanModel::class);
    }
}
