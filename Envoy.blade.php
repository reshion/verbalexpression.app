@servers(['web' => 'songoku@sculptor.uberspace.de'])

@task('deploy')
	cd domains/verbalexpression.app
    php artisan down
    git pull origin master
    php artisan clear-compiled
    php composer.phar update
    php artisan up
@endtask
