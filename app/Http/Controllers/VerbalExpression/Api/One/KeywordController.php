<?php namespace App\Http\Controllers\VerbalExpression\Api\One;

use App\Http\Controllers\Controller;
use App\VerbalExpression\Storage\Keyword\KeywordInterface;

class KeywordController extends Controller {

    /**
     * @var KeywordInterface
     */
    protected $keyStorage;

    /**
     * @param KeywordInterface $keyStorage
     */
    public function __construct(KeywordInterface $keyStorage)
    {
        $this->keyStorage = $keyStorage;
    }

    /**
     * Get all keywords
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return response($this->keyStorage->all());
    }

}