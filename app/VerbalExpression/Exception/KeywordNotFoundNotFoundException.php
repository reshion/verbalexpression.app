<?php namespace App\VerbalExpression\Exception;


class KeywordNotFoundException extends VerbalExpressionException {

    /**
     * @return string
     */
    public function getName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

}