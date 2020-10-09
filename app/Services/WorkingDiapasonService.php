<?php


namespace App\Services;

use App\Models\Swagger\v1\WorkingDiapason;
use Illuminate\Http\Request;

class WorkingDiapasonService
{
    const FREE_STATE = 0;
    const BOOKED_STATE = 1;
    const ORDERED_STATE = 2;


    public static function getList(Request $request)
    {
        $requestParams = $request->only(['limit', 'offset', 'master_id', 'only_free', 'date_start', 'date_end']);

        if ($requestParams) {
            $itemQuery = WorkingDiapason::query();
            $itemQuery->where('master_id', $requestParams['master_id']);
            $itemQuery->when(isset($requestParams['only_free']), function($q){
                $q->where('state', WorkingDiapasonService::FREE_STATE);
            });
            $itemQuery->when(isset($requestParams['date_start']), function($q) use ($requestParams) {
                $q->where('time_start','>=', $requestParams['date_start']);
            });
            $itemQuery->when(isset($requestParams['date_end']), function($q) use ($requestParams) {
                $q->where('time_start','<=', $requestParams['date_end']);
            });
            $itemQuery->limit(request()->limit ?? 25);
            $itemQuery->skip(request()->offset ?? 0);
            $workingDiapason = $itemQuery->get();
        } else {
            $workingDiapason = WorkingDiapason::limit(25)->get();
        }

        return $workingDiapason;
    }

    public static function changeState($working_diapason_start_id, $state)
    {
        $wd = WorkingDiapason::findOrFail($working_diapason_start_id);
        $wd->update(['state' => $state]);
    }

    public static function isStateFree($working_diapason_start_id): bool
    {
        return WorkingDiapason::findOrFail($working_diapason_start_id)->state === WorkingDiapasonService::FREE_STATE;
    }
}
