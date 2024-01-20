<?php

namespace App\Mutators;

class TypeMutator
{
    public function mutateType($discount)
    {

        if ($discount->category_id !== null) {
            return 'category';
        } elseif ($discount->item_id !== null) {
            return 'item';
        } else {
            return 'all_menu';
        }
    }
}
