<?php


namespace App\Common\Tools;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class Collection
 * @package App\Common\Tools
 */
class Collection
{
    /**
     * @param $collection
     * @param $keys
     * @return mixed
     */
    public static function collect($collection, $keys)
    {

        $data = $collection->map(function ($item) use ($keys) {
            $data = [];
            foreach ($keys as $key) {
                $data[$key] = $item[$key];
            }
            return $data;
        })->all();

        if ($collection instanceof LengthAwarePaginator) {
            return ['data' => $data, 'pagination' => self::constructPaginate($collection)];
        }

        return ['data' => $data];
    }

    /**
     * @param $collections
     * @return array
     */
    public static function constructPaginate($collections)
    {
        return [
            'total' => $collections->total(),
            'count' => $collections->count(),
            'per_page' => $collections->perPage(),
            'current_page' => $collections->currentPage(),
            'total_pages' => $collections->lastPage()
        ];
    }
}
