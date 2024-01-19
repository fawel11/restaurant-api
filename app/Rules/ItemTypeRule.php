<?php

namespace App\Rules;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ItemTypeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $category = Category::find($value);

        // check if  any subcategories associated with the category
        return $category->children->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A category or subcategory must not have mixed children.';
    }
}
