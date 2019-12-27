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

    /** @var int */
    public $id = 0;

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
        $requestData = $this->request->all();

        if ($this->id > 0 && !array_key_exists('id', $requestData)) {
            $requestData['id'] = $this->id;
        }

        if (array_key_exists('_token', $requestData)) {
            unset($requestData['_token']);
        }

        if (array_key_exists('_method', $requestData)) {
            unset($requestData['_method']);
        }

        $rules = $this->getRules();
        /** @var ValidatorObj $validator */
        $validator = Validator::make($requestData, $rules);
        $validator->validate();

        return $requestData;
    }

    /**
     * @return array
     */
    abstract public function getRules(): array;
}
