<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kanban extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class, 'kanban_id');
    }
}
