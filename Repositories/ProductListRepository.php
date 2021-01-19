<?php

namespace Modules\Icommercepricelist\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ProductListRepository extends BaseRepository
{
  public function getItemsBy($params);

  public function getItem($criteria, $params);

  public function updateBy($criteria, $data, $params);

  public function deleteBy($criteria, $params);
}
