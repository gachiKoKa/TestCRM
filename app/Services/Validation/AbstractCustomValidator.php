<?php

namespace App\Services\Validation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator as ValidatorObj;

abstract class AbstractCustomValidator
{
    /** @var Request */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     * @throws ValidationException
     */
    public function validate(): array
    {
        $data = $this->request->all();

        if (array_key_exists($data['_token'], $data)) {
            unset($data['_token']);
        }

        if (array_key_exists($data['_method'], $data)) {
            unset($data['_method']);
        }

        $rules = $this->getRules();
        /** @var ValidatorObj $validator */
        $validator = Validator::make($data, $rules);
        $validator->validate();

        return $data;
    }

    /**
     * @return array
     */
    abstract public function getRules(): array;
}
