<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VatType extends Model{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vat_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at'];

}
