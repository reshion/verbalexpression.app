<?php namespace App\Http\Controllers\VerbalExpression\Api\One;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Validations\Tester\MatchValidation;
use App\VerbalExpression\Contracts\TesterInterface;
use App\VerbalExpression\Exception\InvalidArgumentException;
use Illuminate\Http\Request;

class TesterController extends Controller {

    /**
     * @var TesterInterface
     */
    protected $tester;

    /**
     * @param TesterInterface $tester
     */
    public function __construct(TesterInterface $tester)
    {
        $this->tester = $tester;
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws InvalidArgumentException
     */
    public function match(Request $request)
    {
        (new MatchValidation($request->json()->all()))->validate();

        $result = $this->tester->match($request->json('expression'), $request->json('value'));

        return response()->json($result);
    }

}
