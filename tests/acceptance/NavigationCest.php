<?php
use \AcceptanceTester;

class NavigationCest {

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function validateNavigationShown(AcceptanceTester $I)
    {
        $I->see('Credits', 'a');
        $I->see('Documentation', 'a');
        $I->see('GitHub', 'a');
    }

    public function openCredits(AcceptanceTester $I)
    {
        $I->click('Credits');

        $I->canSee('Credits', 'h2');
        $I->canSee('Contribute', 'h2');
    }

    public function openDocumentation(AcceptanceTester $I)
    {
        $I->click('Documentation');

        $I->canSee('Why', 'h2');
    }
}