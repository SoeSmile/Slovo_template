<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\Subject\SubjectStoreRequest;
use App\Http\Resources\Subject\SubjectResource;
use App\Repository\Dto\SubjectDto;
use App\Repository\SubjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ApiSubjectController
 * @package App\Http\Controllers\Api
 */
class ApiSubjectController
{
    /**
     * @var SubjectRepository
     */
    private SubjectRepository $subject;


    /**
     * ApiSubjectController constructor.
     * @param SubjectRepository $subjectRepository
     */
    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subject = $subjectRepository;
    }


    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return SubjectResource::collection($this->subject->all($request->all()));
    }


    /**
     * @param SubjectStoreRequest $request
     * @return SubjectResource
     */
    public function store(SubjectStoreRequest $request): SubjectResource
    {
        return new SubjectResource($this->subject->store(new SubjectDto($request->all())));
    }


    /**
     * @param $id
     * @param SubjectStoreRequest $request
     * @return JsonResponse
     */
    public function update($id, SubjectStoreRequest $request): JsonResponse
    {
        $result = $this->subject->update($id, new SubjectDto($request->all()));

        return response()->json(['success' => (bool)$result], $result ? 200 : 400);
    }


    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $result = $this->subject->destroy($id);

        return response()->json(['success' => (bool)$result], $result ? 200 : 400);
    }
}
