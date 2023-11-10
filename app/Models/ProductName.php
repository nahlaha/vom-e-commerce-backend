<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductName extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_names';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description', 'product_id', 'language_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }
}
