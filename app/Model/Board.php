<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id', 'board_name', 'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kanbans()
    {
        return $this->hasMany(Kanban::class, 'board_id');
    }
}
