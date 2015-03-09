<?php namespace App\Http\Validations\Creator;

use App\Http\Validations\Validation;

class CreateValidation extends Validation {

    /**
     * @var array
     */
    public static $rules = [
        'pairs' => 'required|array'
    ];

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input, self::$rules);
        $this->validator->each('pairs', [
            'keyword' => 'required',
            'value' => 'present'
        ]);
    }

}