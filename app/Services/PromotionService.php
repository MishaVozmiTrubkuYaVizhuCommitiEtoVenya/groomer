<?php


namespace App\Services;


use App\Models\Swagger\v1\Promotion;
use Illuminate\Http\Request;

class PromotionService
{

    public static function getItemsList(Request $request)
    {
        $requestParams = $request->only(['limit','offset','client_id', "date_start", "date_end"]);

        $itemQuery = Promotion::query();
        $itemQuery->when(isset($requestParams['date_start']), function($q) use ($requestParams) {
            $q->where('date_start','>=', $requestParams['date_start']);
        });
        $itemQuery->when(isset($requestParams['date_end']), function($q) use ($requestParams) {
            $q->where('date_start','<=', $requestParams['date_end']);
        });
        $itemQuery->where('client_id', $requestParams['client_id']);
        $itemQuery->limit($requestParams['limit'] ?? 25);
        $itemQuery->skip($requestParams['offset'] ?? 0);

        return $itemQuery->get();
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
