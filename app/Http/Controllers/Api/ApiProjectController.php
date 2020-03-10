<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\Project\ProjectDeleteRequest;
use App\Http\Requests\Project\ProjectStoreRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Http\Resources\Project\ProjectMiniResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use App\Repository\Dto\ProjectDto;
use App\Repository\ProjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ApiProjectController
 * @package App\Http\Controllers\Api
 */
class ApiProjectController
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
        if ($request->has('mini')) {
            return ProjectMiniResource::collection($this->project->all($request->all()));
        }

        return ProjectResource::collection($this->project->all($request->all()));
    }


    /**
     * @param ProjectStoreRequest $request
     * @return ProjectResource
     */
    public function store(ProjectStoreRequest $request): ProjectResource
    {
        return new ProjectResource($this->project->store(new ProjectDto($request->all())));
    }


    /**
     * @param $id
     * @param ProjectUpdateRequest $request
     * @return JsonResponse
     */
    public function update($id, ProjectUpdateRequest $request): JsonResponse
    {
        $result = $this->project->update($id, new ProjectDto($request->all()));

        return response()->json(['success' => (bool)$result], $result ? 200 : 400);
    }


    /**
     * @param $id
     * @param ProjectDeleteRequest $request
     * @return JsonResponse
     */
    public function destroy($id, ProjectDeleteRequest $request): JsonResponse
    {
        $result = $this->project->destroy($id);

        return response()->json(['success' => (bool)$result], $result ? 200 : 400);
    }
}
