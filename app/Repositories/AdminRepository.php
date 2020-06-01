<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Admin;

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
}