<?php namespace App\VerbalExpression\Contracts;

use App\VerbalExpression\Storage\Keyword\KeywordInterface;
use App\VerbalExpression\VerbalExpression;

interface CreatorInterface {

    /**
     * @param VerbalExpression $regex
     * @param KeywordInterface  $keyStorage
     */
    public function __construct(VerbalExpression $regex, KeywordInterface $keyStorage);

    /**
     * @param string $key
     * @param string $value
     *
     * @return CreatorInterface
     */
    public function add($key, $value);

    /**
     * @param array $pairs
     *
     * @return CreatorInterface
     */
    public function addArray($pairs);

    /**
     * @return array
     */
    public function create();

}