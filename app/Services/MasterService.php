<?php


namespace App\Services;


use App\Models\Swagger\v1\Master;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class MasterService
 * @package App\Services
 */
class MasterService
{

    /**
     * @param Request $request
     * @return array
     */
    public static function createDataFromRequest(Request $request): array
    {
        $masterData = $request->only(['name', 'email', 'password', 'description']);
        $masterData['image'] = MasterService::storeImageFromRequest($request);
        $masterData['client_id'] = auth()->guard('clients')->user()->id;

        return $masterData;
    }

    /**
     * @param Request $request
     * @return \stdClass
     */
    public static function getItemsList(Request $request): \stdClass
    {
        $requestParams = $request->only(['limit', 'offset', 'client_id']);
        $returnData = new \stdClass();
        $returnData->statusCode = 422;
        $returnData->jsonContent = json_decode("{'message':'Error'}");


        if ($requestParams) {
            $masterQuery = Master::query();
            $masterQuery->where('client_id', $request->client_id);
            $masterQuery->limit($request->limit ?? 25);
            $masterQuery->skip($request->offset ?? 0);

            $master = $masterQuery->get();
            if (auth()->guard('clients')->user()) {
                $master->makeVisible(['email']);
            }

            $returnData->jsonContent = $master->toJson();
            $returnData->statusCode = 200;
        }
        return $returnData;
    }

    /**
     * @param Model $master
     * @return \stdClass
     */
    public static function getItem(Model $master): \stdClass
    {
        $returnData = new \stdClass();

        if (auth()->guard('clients')->user()) {
            $master->makeVisible(['email']);
        }

        $returnData->jsonContent = $master->toJson();
        $returnData->statusCode = 200;
        return $returnData;
    }

    /**
     * @param Request $request
     * @return string
     */
    private static function storeImageFromRequest(Request $request): string
    {
        $path = "";
        if ($request->hasFile('image_upload')) {
            $image = $request->file('image_upload');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(
                240,
                240,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            );

            $img->stream();

            $path = 'images/master/' . auth()->user()->id . '/smalls/' . $fileName;
            foreach (Storage::allFiles('public/images/master/' . auth()->user()->id . '/smalls/') as $photo) {
                Storage::delete($photo);
            }
            Storage::disk('local')->put("public/" . $path, $img, 'public');
        }
        return config('app.url') . Storage::url($path);
    }


}
