<?php namespace App\Http\Validations;

use App\VerbalExpression\Exception\ValidationException;
use Illuminate\Validation\Validator;

abstract class Validation {

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @param array $input
     * @param array $rules
     */
    public function __construct(array $input, array $rules)
    {
        $this->validator = \Validator::make($input, $rules);
    }

    /**
     * @return bool
     * @throws ValidationException
     */
    public function validate()
    {
        if ($this->validator->fails())
        {
            throw new ValidationException(null, $this->validator->errors());
        }

        return true;
    }
}