<?php

namespace App\Services\Validation;

class UpdateCompanyValidator extends AbstractCustomValidator
{
    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'id' => 'required|int|exists:companies,id',
            'name' => 'string|max:255',
            'email' => 'string|email|unique:companies,email,' . $this->id . '|max:255',
            'web_site' => 'url|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:40960|dimensions:min_width=100,min_height=100'
        ];
    }
}
