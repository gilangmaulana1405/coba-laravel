<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {

        // pakai Null coalescing operator php 7
        $query->when($filters['search'] ?? false, function($query, $search){
             return $query->where('title', 'like', '%' . $search. '%')
                  ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category){
            // join table dengan whereHas
            return $query->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
        });

        // pakai arrow function php
        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
            )
        );
    }

    //relasikan model Post ke model Category
    //nama method sama dengan nama model yg dituju
    //belongsTo karena 1 post itu hanya punya satu category
    public function category()
    {
        return $this->belongsTo(Category::class); 
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

     public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
