<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'slug',
        'description',
        'status',
        'category_id',
        'department_id',
        'created_by',
        'updated_by'
    ];

    public function department () : BelongsTo{
        return $this->belongsTo(Department::class);
    }
    public function category () : BelongsTo {
        return $this->belongsTo(Category::class);
    }

}
