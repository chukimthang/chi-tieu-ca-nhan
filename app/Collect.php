<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Collect extends Model
{
    protected $table = 'collects';

    protected $fillable = ['price', 'description', 'user_id'];

    public function scopeFilterDate($query, $start, $finish)
    {
        return $query->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $finish);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
