<?php namespace App\VerbalExpression\Exception;

class InvalidArgumentException extends VerbalExpressionException {

    /**
     * @param string $message
     * @param string $message_internal
     */
    public function __construct($message, $message_internal = '')
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