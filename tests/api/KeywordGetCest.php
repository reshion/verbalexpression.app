<?php

class KeywordGetCest
{
    private $endpoint = '/keywords';

    public function returnKeywords(ApiTester $I)
    {
        $I->sendGET($this->endpoint);

        $I->canSeeResponseCodeIs(200);
        $I->canSeeResponseIsJson();

        $I->canSeeResponseContainsJson(['key' => 'startOfLine', 'accepted' => 'boolean']);
        $actual = $I->grabDataFromResponseByJsonPath("$")[0];

        $I->assertEquals(24, sizeof($actual));
    }
}