<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Post
 * @package App\Models
 * @version October 9, 2022, 7:04 am UTC
 *
 * @property string $name
 * @property string $description
 * @property integer $created_by
 * @property integer $updated_by
 */
class Post extends Model
{
    use SoftDeletes;


    public $table = 'posts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function postAttachments() {
        return $this->hasMany(Attachment::class,'post_id','id');
    }

    public function createdBy() {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function updatedBy() {
        return $this->hasOne(User::class,'id','updated_by');
    }
    
}
