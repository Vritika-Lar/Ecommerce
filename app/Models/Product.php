<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
   protected $fillable = [
      'name',
      'price',
      'status',
      'slug',
      'category_id',
      'image',
      'is_featured',
      'description',

   ];

   protected $casts = [
      'status' => 'boolean',
      'is_featured' => 'boolean',
      'price' => 'decimal:2',
   ];


   protected static function boot()
   {
      parent::boot();

      static::creating(function ($product) {
         $slug = Str::slug($product->name);
         $count = static::where('slug', 'LIKE', "$slug%")->count();

         $product->slug = $count ? "{$slug}-{$count}" : $slug;
      });
   }

   

   public function category()
   {
      return $this->belongsTo(Category::class);


   }

   public function orderItems()
   {
      return $this->hasMany(OrderItem::class);
   }

}


