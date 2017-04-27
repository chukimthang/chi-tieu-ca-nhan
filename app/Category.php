<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Expense;
use App\User;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'user_id'];

    public function scopeListCategory($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
