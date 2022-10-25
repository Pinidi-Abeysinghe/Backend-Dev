<?php

namespace App\Repositories;

use App\Models\Attachment;
use App\Repositories\BaseRepository;

/**
 * Class AttachmentRepository
 * @package App\Repositories
 * @version September 15, 2022, 4:47 pm UTC
*/

class AttachmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_id',
        'application_id',
        'attachment_type_id',
        'attachment',
        'size'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Attachment::class;
    }

    public function uploadAttachment($files, $attachmentType, $postApplicationId) {
        foreach ($files as $file) {
            
            $path = $attachmentType == 1 ? $file->store('public/images') : $file->store('public/applications');
            $name = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileSize = number_format($fileSize / 1048576, 3);
            
            Attachment::create([
                'post_id' => $attachmentType == 1 ? $postApplicationId : null,
                'application_id' => $attachmentType == 2 ?  $postApplicationId : null,
                'attachment_type_id' => $attachmentType,
                'attachment' => $path,
                'size' => $fileSize . ' MB'
            ]);
        }
        
    }
}
