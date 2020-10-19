<?php

namespace App\Http\Requests\Swagger\v1\Master;

use Illuminate\Foundation\Http\FormRequest;

class MasterPatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guard('masters')->user() || auth()->guard('clients')->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
