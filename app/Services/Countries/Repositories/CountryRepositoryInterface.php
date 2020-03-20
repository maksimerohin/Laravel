<?php
/**
 * Description of CountryRepositoryInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Models\Country;

interface CountryRepositoryInterface
{
    public function find(int $id);

    public function getList(int $limit, int $offset);

    public function search(array $filters = [], array $with = []);

    public function createFromArray(array $data): Country;

    public function updateFromArray(Country $country, array $data);
}
