<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateApplicationAPIRequest;
use App\Http\Requests\API\UpdateApplicationAPIRequest;
use App\Models\Application;
use App\Repositories\ApplicationRepository;
use App\Repositories\AttachmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ApplicationController
 * @package App\Http\Controllers\API
 */

class ApplicationAPIController extends AppBaseController
{
    /** @var  ApplicationRepository */
    private $applicationRepository;
    private $attachmentRepository;

    public function __construct(ApplicationRepository $applicationRepo, AttachmentRepository $attachmentRepo)
    {
        $this->applicationRepository = $applicationRepo;
        $this->attachmentRepository = $attachmentRepo;
    }

    /**
     * Display a listing of the Application.
     * GET|HEAD /applications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $applications = $this->applicationRepository->getAll();

        return $this->sendResponse($applications, 'Applications retrieved successfully');
    }

    /**
     * Store a newly created Application in storage.
     * POST /applications
     *
     * @param CreateApplicationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateApplicationAPIRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = auth()->user()->id;
        $application = $this->applicationRepository->create($input);
        $files = $request->file('files'); 
        $applicationTypeId = 2; // 1=> post, 2 => application
        if (count($files) > 0) {
            $this->attachmentRepository->uploadAttachment($files, $applicationTypeId, $application->id);
            
        }

        return $this->sendResponse($application->toArray(), 'Application saved successfully');
    }

    /**
     * Display the specified Application.
     * GET|HEAD /applications/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        return $this->sendResponse($application->toArray(), 'Application retrieved successfully');
    }

    /**
     * Update the specified Application in storage.
     * PUT/PATCH /applications/{id}
     *
     * @param int $id
     * @param UpdateApplicationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApplicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $input['updated_by'] = auth()->user()->id;
        $application = $this->applicationRepository->update($input, $id);

        return $this->sendResponse($application->toArray(), 'Application updated successfully');
    }

    /**
     * Remove the specified Application from storage.
     * DELETE /applications/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $application->applicationAttachments()->delete();
        $application->delete();

        return $this->sendSuccess('Application deleted successfully');
    }
}
