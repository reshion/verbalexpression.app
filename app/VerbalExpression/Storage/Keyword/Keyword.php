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
            'add' => ['key' => 'add', 'accepted' => 'string'],
            'startOfLine' => ['key' => 'startOfLine', 'accepted' => 'boolean'],
            'endOfLine' => ['key' => 'endOfLine', 'accepted' => 'boolean'],
            'startOfGroup' => ['key' => 'startOfGroup', 'accepted' => 'boolean'],
            'endOfGroup' => ['key' => 'endOfGroup', 'accepted' => 'boolean'],
            'then' => ['key' => 'then', 'accepted' => 'string'],
            'maybe' => ['key' => 'maybe', 'accepted' => 'string'],
            'anything' => ['key' => 'anything', 'accepted' => 'string'],
            'anythingBut' => ['key' => 'anythingBut', 'accepted' => 'string'],
            'anythingButDigit' => ['key' => 'anythingButDigit', 'accepted' => 'string'],
            'something' => ['key' => 'something', 'accepted' => 'string'],
            'somethingBut' => ['key' => 'somethingBut', 'accepted' => 'string'],
            'any' => ['key' => 'any', 'accepted' => 'string'],
            'anyOf' => ['key' => 'anyOf', 'accepted' => 'string'],
            'range' => ['key' => 'range', 'accepted' => 'array'],
            'times' => ['key' => 'times', 'accepted' => 'string'],
            'interval' => ['key' => 'interval', 'accepted' => 'array'],
            'atLeastOnce' => ['key' => 'atLeastOnce', 'accepted' => 'string'],
            'zeroOrOften' => ['key' => 'zeroOrOften', 'accepted' => 'string'],
            'digit' => ['key' => 'digit', 'accepted' => 'string'],
            'lineBreak' => ['key' => 'lineBreak', 'accepted' => 'string'],
            'tab' => ['key' => 'tab', 'accepted' => 'string'],
            'word' => ['key' => 'word', 'accepted' => 'string'],
            'addOr' => ['key' => 'addOr', 'accepted' => 'string'],
        ]);
    }


}