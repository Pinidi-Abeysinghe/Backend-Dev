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
            $name = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileSize = number_format($fileSize / 1048576, 3);
            $folderName = $attachmentType == 1 ? "images" : "applications";
            $path = $file->move($folderName, $name);
            
            Attachment::create([
                'post_id' => $attachmentType == 1 ? $postApplicationId : null,
                'application_id' => $attachmentType == 2 ?  $postApplicationId : null,
                'attachment_type_id' => $attachmentType,
                'attachment' => $path,
                'size' => $fileSize . ' MB'
            ]);
        }
        
    }

    public function downloadApplications($applicationId) {
        $application = Attachment::where('attachment_type_id', 2)->select('id','attachment')
        ->where('application_id', $applicationId)
        ->latest()->first();

        if($application) {
            return response()->download(public_path($application->attachment), 'application.pdf');
        }
    }
}
