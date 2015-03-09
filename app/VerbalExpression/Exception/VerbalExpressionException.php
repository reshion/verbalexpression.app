<?php namespace App\VerbalExpression\Exception;

use Exception;

abstract class VerbalExpressionException extends \Exception {

    /**
     * @var string
     */
    public $messageInternal = '';

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @return string
     */
    public function getMessageInternal()
    {
        return $this->messageInternal;
    }

    /**
     * @return array Arrayfi the exception
     */
    public function json()
    {
        return [
            'type' => 'danger',
            'code' => $this->getCode(),
            'exception' => $this->getName(),
            'message' => $this->getMessage(),
            'message_internal' => $this->getMessageInternal(),
            'more_info' => ''
        ];
    }

}