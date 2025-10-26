<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'priority',
        'is_completed',
        'due_date'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'due_date' => 'date'
    ];

    // Relationship: Task belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Task belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}