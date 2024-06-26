<?php

namespace Modules\Icommercepricelist\Repositories\Eloquent;

use Modules\Core\Icrud\Repositories\Eloquent\EloquentCrudRepository;
use Modules\Icommercepricelist\Repositories\PriceListRepository;

class EloquentPriceListRepository extends EloquentCrudRepository implements PriceListRepository
{
    /**
     * Filter names to replace
     *
     * @var array
     */
    protected $replaceFilters = [];

    /**
     * Relation names to replace
     *
     * @var array
     */
    protected $replaceSyncModelRelations = [];

    /**
     * Filter query
     *
     * @return mixed
     */
    public function filterQuery($query, $filter, $params)
    {
      /**
       * Note: Add filter name to replaceFilters attribute before replace it
       *
       * Example filter Query
       * if (isset($filter->status)) $query->where('status', $filter->status);
       */

      //add filter by search
      if (isset($filter->search)) {
        //get language translation
        $lang = \App::getLocale();
        //find search in columns
        $query->where(function ($query) use ($filter, $lang) {
          $query->whereHas('translations', function ($query) use ($filter, $lang) {
            $query->where('locale', $lang)
              ->where('name', 'like', '%' . $filter->search . '%');
          })->orWhere('id', 'like', '%' . $filter->search . '%');
        });
      }

      //Response
      return $query;
    }

    /**
     * Method to sync Model Relations
     *
     * @param $model ,$data
     * @return $model
     */
    public function syncModelRelations($model, $data)
    {
      //Get model relations data from attribute of model
      $modelRelationsData = ($model->modelRelations ?? []);

      /**
       * Note: Add relation name to replaceSyncModelRelations attribute before replace it
       *
       * Example to sync relations
       * if (array_key_exists(<relationName>, $data)){
       *    $model->setRelation(<relationName>, $model-><relationName>()->sync($data[<relationName>]));
       * }
       */

      //Response
      return $model;
    }
}
