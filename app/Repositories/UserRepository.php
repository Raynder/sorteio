<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\AbstractCrudRepository;

class UserRepository extends AbstractCrudRepository
{
    protected $modelClass = User::class;

    public function all($params)
    {
        $qry = $this->newQuery();

        if (isset($params['filter_id'])) {
            $qry = $qry->where('id', '=', $params['filter_id']);
        }
        if (isset($params['filter_name'])) {
            $qry = $qry->where(function ($qry) use ($params) {
                $qry = $qry->where('name', 'ilike', "%{$params['filter_name']}%");
                $qry = $qry->orWhere('email', 'ilike', "%{$params['filter_name']}%");
            });
        }

        if (isset($params['filter_deleted']) && $params['filter_deleted'] == 'S') {
            $qry = $qry->withTrashed();
        }
        if (isset($params['filter_sort'])) {
            $qry = $qry->orderBy($params['filter_sort'], $params['filter_order']);
        }

        if(!isset($params['filter_take'])){
            $params['filter_take'] = 10;
        }

        return $this->doQuery($qry, $params['filter_take'], true);
    }

    public function findToSelect2js($q)
    {
        $q = strtoupper($q);
        $qry = $this->newQuery();
        $qry = $qry->whereRaw("UPPER(name) ilike '%$q%' ");
        $objetos = $qry->get();
        return $objetos->map(function ($item, $key) {
            return ['id' => $item->id, 'text' => "{$item->name}"];
        });
    }
}
