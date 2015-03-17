<?php
use \AcceptanceTester;

class TesterCest {

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(TesterPage::$URL);

        GeneratorPage::of($I)
            ->fillPair(1, 'then', 'foo')
            ->clickGenerateAndWait();
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function showSuccessfulMessageOnMatch(AcceptanceTester $I)
    {
        $I->fillField(TesterPage::$inputMatchValue, 'foo');

        $I->click(TesterPage::$buttonTest);
        $I->waitForElement(TesterPage::$divMessagePositive, 10);

        $I->see('true', TesterPage::$divMessagePositive);
    }

    public function showFalseMessageOnNotMatch(AcceptanceTester $I)
    {
        $I->fillField(TesterPage::$inputMatchValue, 'bar');

        $I->click(TesterPage::$buttonTest);
        $I->waitForElement(TesterPage::$divMessageNegative, 10);

        $I->seeElement(TesterPage::$divMessageNegative);
        $I->see('false', TesterPage::$divMessageNegative);
    }

}