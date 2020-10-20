<?php


namespace App\Services;


use App\Models\Swagger\v1\Client;
use App\Models\Swagger\v1\Promotion;
use Illuminate\Http\Request;

class PromotionService
{

    public static function getItemsList(Request $request, Client $client)
    {
        $requestParams = $request->only(['limit','offset', "date_start", "date_end"]);

        $itemQuery = $client->promotions();
        $itemQuery->when(isset($requestParams['date_start']), function($q) use ($requestParams) {
            $q->where('date_start','>=', $requestParams['date_start']);
        });

        $itemQuery->when(isset($requestParams['date_end']), function($q) use ($requestParams) {
            $q->where('date_start','<=', $requestParams['date_end']);
        });

        //Если не указан диапазон дат, то забираем только текущие акции
        if(!isset($requestParams['date_end']) && !isset($requestParams['date_start'])){
            $now = date('Y:m:d H:i:s');
            $itemQuery->where('date_end', '>', $now);
            $itemQuery->where('date_start', '<', $now);
        }
        $itemQuery->limit($requestParams['limit'] ?? 25);
        $itemQuery->skip($requestParams['offset'] ?? 0);

        return $itemQuery->get()->makeHidden(['client_id']);
    }

    public static function createItem(Request $request)
    {
        $promotion = Promotion::create(
            $request->only(
                [
                    "title",
                    "text",
                    "image",
                    "url",
                    'client_id'
                ]
            )
        );

        return $promotion;
    }

    public static function updateItem(Request $request,Promotion $promotion)
    {
        $promotion->update(
            $request->only(
                [
                    "title",
                    "text",
                    "image",
                    "url",
                    'client_id'
                ]
            )
        );
    }

    public static function deleteItem(Promotion $promotion)
    {
        $promotion->delete();
    }
}
