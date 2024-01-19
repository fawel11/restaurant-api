<?php

namespace App\Http\Requests;

use App\Rules\ItemTypeRule;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'required|string',
            'amount' => 'required|numeric',
            'category_id' => [
                'required',
                'exists:categories,id',
                new ItemTypeRule(),
            ],

        ];
    }
}
