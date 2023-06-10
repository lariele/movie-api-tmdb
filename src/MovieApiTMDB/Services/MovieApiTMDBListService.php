<?php

namespace App\SFD\Movie\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Lapierre\Order\Models\Order;
use LaravelIdea\Helper\Lapierre\Order\Models\_IH_Order_QB;
use App\SFD\Movie\Models\TMDBMovie;

class MovieApiTMDBListService
{

    public function getOrderListQuery($filter): _IH_Order_QB|Builder
    {
        $moviesQuery = TMDBMovie::query();

        if ($filter) {
            if (isset($filter['search']) && strlen($filter['search']) > 1) {
                $moviesQuery->where(function (Builder $qb) use ($filter) {
                    $qb->where('name', 'LIKE', '%' . $filter['search'] . '%')
                        ->orWhere('name', 'LIKE', '%' . $filter['search'] . '%');
                });
            }

            $status = [];
            if (isset($filter['is_active']) && $filter['is_active'] == 1) {
                array_push($status, 1, 2);
            }

            if (isset($filter['is_inactive']) && $filter['is_inactive'] == 1) {
                array_push($status, 0, 3);
            }

            if (!empty($status)) {
                $moviesQuery->whereIn('status', $status);
            }

            if (isset($filter['on_hbo']) && $filter['on_hbo'] == 1) {
                Log::debug('here', [$filter]);
                $moviesQuery->where('on_hbo', '=', 1);
            }

            if (isset($filter['on_netflix']) && $filter['on_netflix'] == 1) {
                $moviesQuery->where('on_netflix', '=', 1);
            }

            if (isset($filter['on_disney']) && $filter['on_disney'] == 1) {
                $moviesQuery->where('on_disney', '=', 1);
            }
        }

        $moviesQuery->orderBy('created_at', 'DESC');

        return $moviesQuery;
    }
}
