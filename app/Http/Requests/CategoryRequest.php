<?php

namespace App\Http\Requests;

use App\Rules\ChildrenTypeRule;
use App\Rules\MaxSubcategoriesRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                new ChildrenTypeRule, //check mixed children
                new MaxSubcategoriesRule, //limit the maximum level of subcategories
            ],
        ];
    }
}
