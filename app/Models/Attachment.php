<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Attachment
 * @package App\Models
 * @version September 15, 2022, 4:47 pm UTC
 *
 * @property integer $post_id
 * @property integer $application_id
 * @property integer $attachment_type_id
 * @property string $attachment
 * @property string $size
 */
class Attachment extends Model
{
    use SoftDeletes;

   // protected $guarded = [];


    public $table = 'attachments';
    

    protected $dates = ['deleted_at'];

    



    public $fillable = [
        'post_id',
        'application_id',
        'attachment_type_id',
        'attachment',
        'size'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'application_id' => 'integer',
        'attachment_type_id' => 'integer',
        'attachment' => 'string',
        'size' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
