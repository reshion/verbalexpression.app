<?php namespace App\VerbalExpression;

use App\VerbalExpression\Contracts\TesterInterface;
use App\VerbalExpression\Exception\RegexException;

final class Tester implements TesterInterface {

    /**
     * @param $expression   string
     * @param $value        string
     *
     * @return bool
     * @throws RegexException
     *
     */
    public function match($expression, $value)
    {
        try
        {
            $result = (bool)preg_match($expression, $value);
        }
        catch (\Exception $e)
        {
            throw new RegexException("The regular expression is invalid.", $e->getMessage());
        }

        return $result;
    }
}