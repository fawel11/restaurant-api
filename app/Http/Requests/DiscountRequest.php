<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'name' => 'nullable|string',
            'type' => 'required|in:all_menu,category,item',
            'value' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'item_id' => 'nullable|exists:items,id',
        ];
    }
}
