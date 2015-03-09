<?php namespace App\VerbalExpression\Storage\Keyword;

interface KeywordInterface {

    /**
     *
     */
    public function __construct();

    /**
     * @return array
     */
    public function all();

    /**
     * @param $word
     *
     * @return array
     */
    public function find($word);

    /**
     * @param string $word
     *
     * @return boolean
     */
    public function exists($word);

}