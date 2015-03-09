<?php namespace App\VerbalExpression\Exception;

class RegexException extends VerbalExpressionException {

    /**
     * @param string $message
     * @param int    $message_internal
     */
    public function __construct($message, $message_internal)
    {
        $this->messageInternal = $message_internal;
        parent::__construct($message);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

}