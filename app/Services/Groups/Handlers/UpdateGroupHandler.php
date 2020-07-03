<?php

namespace App\Services\Groups\Handlers;

use App\DTOs\GroupDTO;
use App\Models\Group;

class UpdateGroupHandler extends BaseHandler
{
    /**
     * @param GroupDTO $DTO
     * @param Group $group
     * @return Group
     */
    public function handle(GroupDTO $DTO, Group $group): Group
    {
        return $this->repository->update($DTO, $group);
    }
}
