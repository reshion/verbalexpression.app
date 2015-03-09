<?php namespace App\Http\Controllers\VerbalExpression;

use App\Http\Controllers\Controller;

class PageController extends Controller {

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var \ParsedownExtra
     */
    protected $markdown;

    /**
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     * @param \ParsedownExtra                   $parsedownExtra
     */
    public function __construct(\Illuminate\Filesystem\Filesystem $filesystem, \ParsedownExtra $parsedownExtra)
    {
        $this->files = $filesystem;
        $this->markdown = $parsedownExtra;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('ve.pages.php');
    }

    /**
     * @return \Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function credits()
    {
        $path = base_path('resources/pages/credits.md');
        $view = $this->markdown->text($this->files->get($path));

        return view('ve.pages.credits')->with('content', $view);
    }
}