<?php namespace App\VerbalExpression\Exception;

class ValidationException extends VerbalExpressionException {

    /**
     * @param string $message
     * @param string $errors
     */
    public function __construct($message = '', $errors = '')
    {
        if (is_null($message) || $message == '')
        {
            $message = 'The validation for provided input failed.';
        }

        $this->messageInternal = $errors;
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