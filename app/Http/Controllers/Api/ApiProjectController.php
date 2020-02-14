<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Project\ProjectResource;
use App\Repository\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ApiProjectController
 * @package App\Http\Controllers\Api
 */
final class ApiProjectController
{
    /**
     * @var ProjectRepository
     */
    private ProjectRepository $project;


    /**
     * ApiProjectController constructor.
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->project = $projectRepository;
    }


    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return ProjectResource::collection($this->project->all($request->all()));
    }
}