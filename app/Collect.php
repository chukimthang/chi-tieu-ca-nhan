<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Collect extends Model
{
    protected $table = 'collects';

    protected $fillable = ['price', 'description', 'user_id'];

    public function scopelistCollect($query, $userId)
    {
        return $query->where('user_id', $userId)->orderBy('id', 'desc');
    }

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
