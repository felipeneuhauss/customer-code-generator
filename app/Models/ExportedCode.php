<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidModel;

class ExportedCode extends Model
{
    use UuidModel;
    
    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = ['name'];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    /**
     * Get the code that owns the comment.
     */
    public function code()
    {
        return $this->belongsTo('App\Models\Code');
    }
    
}
