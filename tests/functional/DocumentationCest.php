<?php

class DocumentationCest
{
    private $endpoint = '/documentation';

    public function documentationHasHeadlineAndNavigation(FunctionalTester $I)
    {
        $I->amOnPage($this->endpoint);
        $I->seeResponseCodeIs(200);

        $I->click('Documentation');
        $I->see('Why?', 'h2');
        $I->see('Why?', 'a');
        $I->see('Exceptions', 'a');
    }

    public function Show404WhenDocumentationNotExists(FunctionalTester $I)
    {
        $I->amOnPage($this->endpoint.'/foo');

        $I->seePageNotFound();
        $I->see("The page your are looking for, doesn't exist.", "h2");
    }
}