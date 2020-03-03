<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Journal;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JournalRepository
 * @package App\Repository
 */
final class JournalRepository
{
    /**
     * @var Journal
     */
    private Journal $journal;


    /**
     * JournalRepository constructor.
     * @param Journal $journal
     */
    public function __construct(Journal $journal)
    {
        $this->journal = $journal;
    }


    /**
     * @param array $data
     * @return Journal|Model
     */
    public function store(array $data)
    {
        return $this->journal::create($data);
    }
}
