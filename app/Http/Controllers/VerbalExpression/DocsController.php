<?php namespace App\Http\Controllers\VerbalExpression;

use App\Http\Controllers\Controller;
use App\VerbalExpression\Storage\Documentation\DocumentationInterface;

class DocsController extends Controller {

    private $docs;

    /**
     * @param DocumentationInterface $docs
     */
    public function __construct(DocumentationInterface $docs)
    {
        $this->docs = $docs;
    }

    /**
     * @param string $page
     *
     * @return \Illuminate\View\View
     */
    public function show($page = null)
    {
        $content = $this->docs->content($page ?: 'why');

        if (is_null($content))
        {
            abort(404);
        }

        return view('ve.pages.documentation', [
            'navigation' => $this->docs->navigation(),
            'content' => $content,
//            'currentVersion' => $version,
//            'versions' => $this->getDocVersions(),
        ]);
    }

}