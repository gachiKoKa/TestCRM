<?php

namespace App\Services\Validation;

class UpdateCompanyValidator extends AbstractCustomValidator
{
    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        return [
            'name' => 'string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:40960|dimensions:min_width=100,min_height=100'
        ];
    }
}
