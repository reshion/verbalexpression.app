<?php namespace App\Http\Controllers\VerbalExpression\Api\One;

use App\Http\Controllers\Controller;
use App\Http\Validations\Creator\CreateValidation;
use App\Http\Validations\Creator\RawValidation;
use App\VerbalExpression\Contracts\CreatorInterface;
use Illuminate\Http\Request;

class CreatorController extends Controller {

    /**
     * @var CreatorInterface
     */
    protected $creator;

    /**
     * @param CreatorInterface $creator
     */
    public function __construct(CreatorInterface $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \App\VerbalExpression\Exception\ValidationException
     */
    public function create(Request $request)
    {
        // Validation
        (new CreateValidation($request->json()->all()))->validate();

        // Handling data
        $this->creator->addArray($request->json('pairs'));

        // Response
        return response()->json($this->creator->create());
    }

}