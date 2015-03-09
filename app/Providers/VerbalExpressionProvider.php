<?php namespace App\Providers;

use App\VerbalExpression\Validation\CollectionValidator;
use App\VerbalExpression\Validation\VerbalExpressionValidator;
use App\VerbalExpression\VerbalExpression;
use Illuminate\Support\ServiceProvider;

class VerbalExpressionProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->extendValidator();

        $this->renderMeta();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Interface Mappings
         */
        $this->app->bind('App\VerbalExpression\Storage\Keyword\KeywordInterface', 'App\VerbalExpression\Storage\Keyword\Keyword');
        $this->app->bind('App\VerbalExpression\Storage\Documentation\DocumentationInterface', 'App\VerbalExpression\Storage\Documentation\Documentation');
        $this->app->bind('App\VerbalExpression\Contracts\CreatorInterface', 'App\VerbalExpression\Creator');
        $this->app->bind('App\VerbalExpression\Contracts\TesterInterface', 'App\VerbalExpression\Tester');

        /*
         * Instance Bindings
         */
        $this->app->bind('App\VerbalExpression\Contracts\VerbalExpressionInterface', function ()
        {
            return new VerbalExpression();
        });
    }

    private function extendValidator()
    {
        \Validator::resolver(function ($translator, $data, $rules, $messages)
        {
            return new VerbalExpressionValidator($translator, $data, $rules, $messages);
        });
    }

    private function renderMeta()
    {
        view()->composer('ve.components.head', function ($view)
        {
            $view->with('meta', [
                'title' => 'Verbal Expression - Regex made easy',
                'author' => 'Eric Kubenka',
                'keywords' => 'verbal, expression, regular expression, regular, regex, regex tester, php, live regex, builder, creator',
                'description' => 'Verbal Expression is a simple way to create complex regular expression patterns with a simple user interface.'
            ]);
        });
    }
}