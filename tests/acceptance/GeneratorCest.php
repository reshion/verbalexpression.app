<?php

class GeneratorCest {

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(GeneratorPage::$URL);
    }

    public function _after(AcceptanceTester $I)
    {
    }

    /**
     * @param AcceptanceTester $I
     */
    public function addPair(AcceptanceTester $I)
    {
        $I->click(GeneratorPage::buttonAddPair(1));

        $I->seeNumberOfElements(GeneratorPage::$selectKeyword, 2);
        $I->seeNumberOfElements(GeneratorPage::$inputValue, 2);
        $I->seeNumberOfElements(GeneratorPage::$buttonAddPair, 2);
        $I->seeNumberOfElements(GeneratorPage::$buttonRemovePair, 2);
    }

    public function removePairs(AcceptanceTester $I)
    {
        $I->click(GeneratorPage::buttonRemovePair(1));

        $I->seeNumberOfElements(GeneratorPage::$selectKeyword, 0);
        $I->seeNumberOfElements(GeneratorPage::$inputValue, 0);
        $I->seeNumberOfElements(GeneratorPage::$buttonAddPair, 0);
        $I->seeNumberOfElements(GeneratorPage::$buttonRemovePair, 0);
    }

    public function generateWithoutPair(AcceptanceTester $I)
    {
        $I->click(GeneratorPage::buttonRemovePair(1));
        $I->click(GeneratorPage::$buttonGenerate);

        $I->waitForElementVisible(GeneratorPage::$divCreatorError, 5);
        $I->see('The validation for provided input failed');
    }

    public function resetForm(AcceptanceTester $I)
    {
        $I->click(GeneratorPage::buttonAddPair(1));
        $I->fillField(GeneratorPage::inputValue(1), 'foo');
        GeneratorPage::of($I)->clickGenerateAndWait();
        $I->click(GeneratorPage::$buttonReset);

        $I->seeNumberOfElements(GeneratorPage::$selectKeyword, 1);
        $I->seeElement(GeneratorPage::inputValue(1), ['value' => '']);
        $I->seeElement(GeneratorPage::$inputExpression, ['value' => '']);
    }

    public function generateUrlRegex(AcceptanceTester $I)
    {
        for ($i = 1; $i <= 6; $i++)
        {
            $I->click(GeneratorPage::buttonAddPair($i));
        }

        $I->seeNumberOfElements(GeneratorPage::$selectKeyword, 7);
        $I->seeNumberOfElements(GeneratorPage::$inputValue, 7);

        GeneratorPage::of($I)
            ->fillPair(1, "startOfLine", "")
            ->fillPair(2, "then", "http")
            ->fillPair(3, "maybe", "s")
            ->fillPair(4, "then", "://")
            ->fillPair(5, "maybe", "www.")
            ->fillPair(6, "anythingBut", " ")
            ->fillPair(7, "endOfLine", "")
            ->clickGenerateAndWait();

        $actual = $I->grabValueFrom(GeneratorPage::$inputExpression);
        $I->assertEquals('/^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$/m', $actual);
    }

}