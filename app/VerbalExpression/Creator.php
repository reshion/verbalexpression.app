<?php namespace App\VerbalExpression;

use App\VerbalExpression\Contracts\CreatorInterface;
use App\VerbalExpression\Exception\ValidationException;
use App\VerbalExpression\Storage\Keyword\KeywordInterface;
use InvalidArgumentException;

final class Creator implements CreatorInterface {

    /**
     * @var KeywordInterface
     */
    private $keyStorage;

    /**
     * @var VerbalExpression
     */
    private $regex;

    /**
     * @return string{@inheritDoc}
     */
    public function __construct(VerbalExpression $regex, KeywordInterface $keyStorage)
    {
        $this->keyStorage = $keyStorage;
        $this->regex = $regex;
    }

    /**
     * @return CreatorInterface{@inheritDoc}
     */
    public function add($key, $value)
    {
        $keyword = $this->keyStorage->find($key);
        $this->call($keyword['key'], $this->value($keyword, $value));

        return $this;
    }

    /**
     * @return string{@inheritDoc}
     */
    public function addArray($pairs)
    {

        if (!is_array($pairs))
        {
            throw new ValidationException("", ['pairs' => ["The pairs field must be type of array."]]);
        }

        foreach ($pairs as $pair)
        {

            if (!$this->hasNecessaryKeys($pair))
            {
                throw new ValidationException("All provided pairs values have to contain keys 'keyword' and 'value'!");
            }

            $this->add($pair['keyword'], $pair['value']);

        }

        return $this;
    }

    /**
     * @return array
     */
    public function create()
    {
        return [
            'combined' => $this->regex->getRegex(),
            'expression' => $this->regex->prefixes . $this->regex->source . $this->regex->suffixes,
            'modifiers' => $this->regex->modifiers
        ];
    }

    /**
     * Checks for Keys.
     *
     * @param array $pair
     *
     * @return bool
     */
    private function hasNecessaryKeys($pair)
    {
        return array_has($pair, "keyword") && array_has($pair, "value");
    }

    /**
     * @param array  $keyword
     * @param string $value
     *
     * @return array|bool|string
     */
    private function value($keyword, $value)
    {
        // Simple Strings accepted
        if ($keyword['accepted'] === "string")
        {
            return $value;
        }

        // Only booleans Accepted
        if ($keyword['accepted'] === "boolean")
        {
            if (strlen($value) === 0 || $value == "true")
            {
                return true;
            }

            return false;
        }

        // Array
        if ($keyword['accepted'] === "array")
        {
            return explode(";", $value);
        }

        return $value;
    }

    /**
     * Calls the given function with value
     *
     * @param $key string
     * @param $value string
     *
     * @throws Exception\InvalidArgumentException
     */
    private function call($key, $value)
    {
        try
        {
            if (is_array($value))
            {
                call_user_func_array(array($this->regex, $key), $value);
            }
            else
            {
                call_user_func_array(array($this->regex, $key), array($value));
            }
        } catch (InvalidArgumentException $e)
        {
            $message = sprintf("Arguments for keyword %s are invalid: %s", $key, $e->getMessage());
            throw new \App\VerbalExpression\Exception\InvalidArgumentException($message);
        }
        catch (\ErrorException $e)
        {
            $message = sprintf("Arguments for keyword %s are invalid", $key);
            throw new \App\VerbalExpression\Exception\InvalidArgumentException($message, $e->getMessage());
        }
    }
}