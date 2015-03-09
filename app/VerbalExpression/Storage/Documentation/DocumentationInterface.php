<?php namespace App\VerbalExpression\Storage\Documentation;

interface DocumentationInterface {

    /**
     * @return mixed
     */
    public function navigation();

    /**
     * @param string $page
     *
     * @return mixed
     */
    public function content($page);

}