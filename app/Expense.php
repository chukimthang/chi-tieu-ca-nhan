<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;

class Expense extends Model
{
    protected $table = 'expenses';

    protected $fillable = ['name', 'price', 'description', 'category_id', 
        'user_id'];

    public function scopelistExpense($query, $userId)
    {
        return $query->where('user_id', $userId)->orderBy('id', 'desc');
    }

    public function scopeFilterByCategory($query, $categoryId, $userId)
    {
        return $categoryId != 0 ? $query->where('category_id', $categoryId)
            ->where('user_id', $userId) : 
            $query->where('user_id', $userId)->orderBy('id', 'desc');
    }

    public function scopeFilterCategoryDate($query, $categoryId, 
        $start, $finish, $userId)
    {
        if ($categoryId != 0) {

            return $query->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $finish)
                ->where('category_id', $categoryId)
                ->where('user_id', $userId);
        }

        return $query->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $finish)
            ->where('user_id', $userId);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
