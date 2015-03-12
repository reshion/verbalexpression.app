<?php

class NavigationCest {

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/');
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function validateNavigationShown(FunctionalTester $I)
    {
        $I->see('Credits', 'a');
        $I->see('Documentation', 'a');
        $I->see('GitHub', 'a');
    }

    public function openCredits(FunctionalTester $I)
    {
        $I->click('Credits');

        $I->canSee('Credits', 'h2');
        $I->canSee('Contribute', 'h2');
    }

    public function openDocumentation(FunctionalTester $I)
    {
        $I->click('Documentation');

        $I->canSee('Why', 'h2');
    }

    public function openHome(FunctionalTester $I)
    {
        $I->amOnPage('/credits');

        $I->click('Verbal Expression');

        $I->canSee('Verbalise expression', 'h2');
        $I->canSee('Generated expression', 'h2');

        $I->canSeeElement("input[value='Generate']");
        $I->canSeeElement("input[value='Reset']");
        $I->canSeeElement("input[value='Test']");

        $I->canSeeElement("input#regex");
        $I->canSeeElement("input#match_value");
    }
}