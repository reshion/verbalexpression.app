<?php namespace App\VerbalExpression\Validation;

use Countable;
use Illuminate\Validation\Validator;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Translation\TranslatorInterface;

class VerbalExpressionValidator extends Validator {


    /**
     * @param TranslatorInterface $translator
     * @param array               $data
     * @param array               $rules
     * @param array               $messages
     * @param array               $customAttributes
     */
    public function __construct(TranslatorInterface $translator, array $data, array $rules, array $messages = array(), array $customAttributes = array())
    {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);
        $this->implicitRules[] = 'Present';
    }

    /**
     * Validate that a required attribute exists.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function validatePresent($attribute, $value, $parameters)
    {
        if (is_null($value))
        {
            return false;
        }
        elseif ((is_array($value) || $value instanceof Countable) && count($value) < 1)
        {
            return false;
        }
        elseif ($value instanceof File)
        {
            return (string)$value->getPath() != '';
        }

        return true;
    }


    /**
     * Define a set of rules that apply to each element in an array attribute.
     *
     * @param  string       $attribute
     * @param  string|array $rules
     *
     * @throws \InvalidArgumentException
     */
    public function each($attribute, $rules)
    {
        $data = array_get($this->data, $attribute);

        if ( ! is_array($data))
        {
            if ($this->hasRule($attribute, 'Array')) return;

            throw new InvalidArgumentException('Attribute for each() must be an array.');
        }

        foreach ($data as $dataKey => $dataValue)
        {
            foreach ($rules as $ruleKey => $ruleValue)
            {
                if ( ! is_string($ruleKey))
                {
                    $this->mergeRules("$attribute.$dataKey", $ruleValue);
                }
                else
                {
                    $this->mergeRules("$attribute.$dataKey.$ruleKey", $ruleValue);
                }
            }
        }
    }

}