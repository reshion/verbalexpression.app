<?php namespace App\VerbalExpression\Storage\Documentation;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Filesystem\Filesystem;
use ParsedownExtra;

class Documentation implements DocumentationInterface {

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @param Filesystem     $files
     * @param Cache          $cache
     * @param ParsedownExtra $markdown
     */
    public function __construct(FileSystem $files, Cache $cache, ParsedownExtra $markdown)
    {
        $this->files = $files;
        $this->cache = $cache;
        $this->markdown = $markdown;
    }

    /**
     * @return mixed
     */
    public function navigation()
    {
        return $this->content('index');
    }

    /**
     * @param string $page
     *
     * @return mixed
     */
    public function content($page)
    {
        return $this->cache->remember('docs.' . $page, 1, function () use ($page)
        {
            $path = base_path('resources/docs/' . $page . '.md');
            if ($this->files->exists($path))
            {
                return $this->markdown->text($this->files->get($path));
            }

            return null;
        });
    }

}