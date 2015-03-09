<?php namespace App\Http\Validations\Tester;

use App\Http\Validations\Validation;

class MatchValidation extends Validation{

    /**
     * @var array
     */
    public static $rules = [
        'expression' => 'required',
        'value' => 'present'
    ];

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input, self::$rules);
    }

}