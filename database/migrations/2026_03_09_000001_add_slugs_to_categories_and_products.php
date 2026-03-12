<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('name');
            }
        });

        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('name');
            }
        });

        $categories = DB::table('categories')->select('id', 'name')->get();
        foreach ($categories as $category) {
            $base = Str::slug($category->name) ?: 'category';
            $slug = $base;
            $count = 1;
            while (DB::table('categories')->where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $base . '-' . $count++;
            }
            DB::table('categories')->where('id', $category->id)->update(['slug' => $slug]);
        }

        $products = DB::table('products')->select('id', 'name')->get();
        foreach ($products as $product) {
            $base = Str::slug($product->name) ?: 'product';
            $slug = $base;
            $count = 1;
            while (DB::table('products')->where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $base . '-' . $count++;
            }
            DB::table('products')->where('id', $product->id)->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'slug')) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'slug')) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            }
        });
    }
};
