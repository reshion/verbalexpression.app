<?php namespace App\VerbalExpression;

use VerbalExpressions\PHPVerbalExpressions\VerbalExpressions;

class VerbalExpression extends VerbalExpressions {

    /**
     * Expects a digit
     *
     * @return VerbalExpression
     */
    public function digit()
    {
        return $this->add('\d');
    }

    /**
     * Expects anything except digits
     *
     * @return VerbalExpression
     */
    public function anythingButDigit()
    {
        return $this->add('\D');
    }

    /**
     * Adds an | to the current expression
     * @return VerbalExpression
     */
    public function addOr()
    {
        return $this->add('|');
    }

    /**
     * Starts a new group
     *
     * Wraps with '('
     *
     * @return VerbalExpression
     */
    public function startOfGroup()
    {
        return $this->add('(');
    }

    /**
     * Ends a group
     *
     * Wraps with ')'
     *
     * @return VerbalExpressions
     */
    public function endOfGroup()
    {
        return $this->add(')');
    }

    /**
     * Expects the statement before to show exactly n times
     *
     * @param $value
     *
     * @return VerbalExpressions
     */
    public function times($value)
    {
        return $this->limit($value);
    }

    /**
     * Expects the statement before to show exactly between $min and $max
     *
     * @param $min
     * @param $max
     *
     * @return VerbalExpressions
     */
    public function interval($min, $max)
    {
        return $this->limit($min, $max);
    }

    /**
     * Expects statement before shown at least once
     *
     * @return VerbalExpressions
     */
    public function atLeastOnce()
    {
        return $this->add("+");
    }

    /**
     * Expects statement before shown often or not
     *
     * @return VerbalExpressions
     */
    public function zeroOrOften()
    {
        return $this->add("*");
    }

    public function addWithCount($keyword, $value, $count)
    {
        call_user_func_array(array($this, $keyword), array($value));

        if ($count === "*" || $count == "+")
        {
            return $this->add($value);
        }

        return $this->times($count);
        // TODO, min max ebenfalls möglich...

    }

}