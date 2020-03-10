<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Journal\JournalResource;
use App\Repository\JournalRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ApiJournalController
 * @package App\Http\Controllers\Api
 */
class ApiJournalController
{
    /**
     * @var JournalRepository
     */
    private JournalRepository $journal;


    /**
     * ApiJournalController constructor.
     * @param JournalRepository $journalRepository
     */
    public function __construct(JournalRepository $journalRepository)
    {
        $this->journal = $journalRepository;
    }


    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return JournalResource::collection($this->journal->all($request->all()))
            ->additional([
                'events' => trans('events'),
            ]);
    }
}
