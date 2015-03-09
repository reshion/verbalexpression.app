<?php namespace App\VerbalExpression\Contracts;

interface TesterInterface {

    /**
     * @param $expression   string
     * @param $value        string
     */
    public function match($expression, $value);

}