<?php
declare(strict_types=1);

namespace App\Observers;

use App\Repository\JournalRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractObserver
 * @package App\Observers
 */
abstract class AbstractObserver
{
    /**
     * @var JournalRepository
     */
    private JournalRepository $journal;


    /**
     * AbstractObserver constructor.
     * @param JournalRepository $journalRepository
     */
    public function __construct(JournalRepository $journalRepository)
    {
        $this->journal = $journalRepository;
    }


    /**
     * @param Model $model
     * @param string|null $event
     */
    public function storeJournal(Model $model, string $event = null): void
    {
        $this->journal->store([
            'user_id' => auth()->id(),
            'event'   => $event,
            'data'    => [
                'model' => [
                    'id'    => $model->id,
                    'class' => substr(strrchr(get_class($model), '\\'), 1),
                ],
            ],
        ]);
    }
}
