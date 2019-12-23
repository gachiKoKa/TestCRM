<?php

namespace App\Services\Validation;

class StoreCompanyValidator extends AbstractCustomValidator
{

    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        return [
          'name' => 'required|string|max:255',
          'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:40960|dimensions:min_width=100,min_height=100'
        ];
    }
}
