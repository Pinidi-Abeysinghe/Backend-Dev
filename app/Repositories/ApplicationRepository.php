<?php

namespace App\Repositories;

use App\Models\Application;
use App\Repositories\BaseRepository;

/**
 * Class ApplicationRepository
 * @package App\Repositories
 * @version October 9, 2022, 8:47 am UTC
*/

class ApplicationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'created_by',
        'updated_by'
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
        return Application::class;
    }

    public function getAll() {
        return $this->model->with('applicationAttachments:id,post_id,application_id,attachment,size','createdBy:id,name','updatedBy:id,name')
        ->select('id','name','description','created_by','updated_by')
        ->get();
    }
}
