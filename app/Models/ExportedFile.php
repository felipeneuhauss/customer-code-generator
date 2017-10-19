<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidModel;

class ExportedFile extends Model
{
    use UuidModel;
    
    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'location'
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
