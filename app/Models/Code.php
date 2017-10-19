<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidModel;

class Code extends Model
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
        'code', 'picture'
    ];
    
    /**
     * Get the comments for the blog post.
     */
    public function exportedCodes()
    {
        return $this->hasMany('App\Modes\ExportedCode');
    }

}
