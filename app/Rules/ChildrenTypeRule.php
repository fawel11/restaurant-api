<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ChildrenTypeRule implements Rule
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
    protected $isViolated = false;

    public function passes($attribute, $value)
    {
        $category = Category::find($value);

        if (!$category) {
            return false;
        }

        $this->checkChildrenTypes($category);

        return !$this->isViolated;
    }

    protected function checkChildrenTypes(Category $category)
    {
        $this->isViolated = false;
        if ($category->items()->exists()) {
            $this->isViolated = true;
        }
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
