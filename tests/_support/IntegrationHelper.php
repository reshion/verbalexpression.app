<?php namespace Codeception\Module;

class IntegrationHelper extends \Codeception\Module {


    public function seeExceptionThrown($exception, $function)
    {
        try
        {
            $function();
            return false;
        }
        catch (\Exception $e)
        {
            if (get_class($e) == $exception)
            {
                return true;
            }
            return false;
        }
    }
}
