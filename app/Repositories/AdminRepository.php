<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Admin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class AdminRepository
 * @package App\Repositories
 */
class AdminRepository
{
    /**
     * @param array $data
     * @return Admin
     */
    public function createNew(array $data): Admin
    {
        return Admin::query()->create($data);
    }

    /**
     * @param int|null $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(?int $perPage = null, array $columns = ['*']): LengthAwarePaginator
    {
        return Admin::query()->paginate($perPage, $columns);
    }
}