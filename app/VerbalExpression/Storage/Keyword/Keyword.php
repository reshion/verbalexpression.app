<?php namespace App\VerbalExpression\Storage\Keyword;

use App\VerbalExpression\Exception\KeywordNotFoundException;
use Illuminate\Support\Collection;

class Keyword implements KeywordInterface {

    /**
     * @var Collection
     */
    protected $storage;

    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->create();
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        $collection = [];
        foreach ($this->storage as $word)
        {
            $collection[] = $word;
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function find($word)
    {
        if ($this->exists($word))
        {
            return $this->storage->get($word);
        }

        throw new KeywordNotFoundException("The given Keyword doesn't exist!");
    }

    /**
     * {@inheritDoc}
     */
    public function exists($word)
    {
        return $this->storage->has($word);
    }

    /**
     * Initialize
     */
    private function create()
    {
        $this->storage = collect([
            'add' => ['key' => 'add', 'accepted' => 'string', 'info' => 'Adds the given char sequence to the expression. Useful for commands that are not available trough the interface. Any string-input allowed.'],
            'startOfLine' => ['key' => 'startOfLine', 'accepted' => 'boolean', 'info' => 'Values: true,false - Default: true'],
            'endOfLine' => ['key' => 'endOfLine', 'accepted' => 'boolean', 'info' => 'Values: true,false - Default: true'],
            'startOfGroup' => ['key' => 'startOfGroup', 'accepted' => 'boolean', 'info' => 'Values: true,false - Default: true'],
            'endOfGroup' => ['key' => 'endOfGroup', 'accepted' => 'boolean', 'info' => 'Values: true,false - Default: true'],
            'then' => ['key' => 'then', 'accepted' => 'string', 'info' => 'Any string-input allowed.'],
            'maybe' => ['key' => 'maybe', 'accepted' => 'string', 'info' => 'Any string-input allowed.'],
            'anything' => ['key' => 'anything', 'accepted' => 'none', 'info' => 'No value needed. Please provide an empty value'],
            'anythingBut' => ['key' => 'anythingBut', 'accepted' => 'string', 'info' => 'Any string-input allowed.'],
            'anythingButDigit' => ['key' => 'anythingButDigit', 'accepted' => 'none', 'info' => 'No value needed. Please provide an empty value.'],
            'something' => ['key' => 'something', 'accepted' => 'none', 'info' => 'No value needed. Please provide an empty value.'],
            'somethingBut' => ['key' => 'somethingBut', 'accepted' => 'string', 'info' => 'Any string-input allowed.'],
            'any' => ['key' => 'any', 'accepted' => 'string', 'info' => 'Any string-input allowed.'],
            'anyOf' => ['key' => 'anyOf', 'accepted' => 'string', 'info' => 'Any string-input allowed.'],
            'range' => ['key' => 'range', 'accepted' => 'array', 'info' => 'Please provide a syntax like a;z;0;9;a;Z'],
            'times' => ['key' => 'times', 'accepted' => 'string', 'info' => 'Any string-input allowed.'],
            'interval' => ['key' => 'interval', 'accepted' => 'array', 'info' => 'Please provide input like 0;3 or 3;5'],
            'atLeastOnce' => ['key' => 'atLeastOnce', 'accepted' => 'none', 'info' => 'No value needed. Please provide an empty value.'],
            'zeroOrOften' => ['key' => 'zeroOrOften', 'accepted' => 'none', 'info' => 'No value needed. Please provide an empty value.'],
            'digit' => ['key' => 'digit', 'accepted' => 'none', 'info' => 'No value needed. Please provide an empty value.'],
            'lineBreak' => ['key' => 'lineBreak', 'accepted' => 'none', 'info' => 'No value needed. Please provide an empty value.'],
            'tab' => ['key' => 'tab', 'accepted' => 'none', 'info' => 'No value needed. Please provide an empty value.'],
            'word' => ['key' => 'word', 'accepted' => 'none', 'info' => 'No value needed. Please provide an empty value.'],
            'addOr' => ['key' => 'addOr', 'accepted' => 'none', 'info' => 'Adds an pipe (|) to current expression. No value needed. Please provide an empty value.'],
        ]);
    }


}