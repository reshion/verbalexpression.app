<?php

class TesterMatchCest {

    private $endpoint = '/tester/match';

    public function returnsTrueWhenValid(ApiTester $I)
    {
        $parameters = [
            'expression' => '/^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$/m',
            'value' => 'http://www.foobar.com'
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));

        $I->canSeeResponseCodeIs(200);
        $I->canSeeResponseIsJson();
        $I->assertTrue(json_decode($I->grabResponse()));
    }

    public function returnsFalseWhenInvalid(ApiTester $I)
    {
        $parameters = [
            'expression' => '/^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$/m',
            'value' => 'http:/www.foobar.com'
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));

        $I->canSeeResponseCodeIs(200);
        $I->canSeeResponseIsJson();
        $I->assertFalse(json_decode($I->grabResponse()));
    }

    public function returnsExceptionWhenExpressionInvalid(ApiTester $I)
    {
        $parameters = [
            'expression' => '/^',
            'value' => 'http://www.foobar.com'
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));

        $I->canSeeResponseCodeIs(500);
        $I->canSeeResponseIsJson();

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];

        $I->assertEquals('danger', $actual['type']);
        $I->assertEquals(0, $actual['code']);
        $I->assertEquals('RegexException', $actual['exception']);
        $I->assertEquals('The regular expression is invalid.', $actual['message']);
        $I->assertContains('No ending delimiter', $actual['message_internal']);
    }

    public function returnsExceptionWhenExpressionMissing(ApiTester $I)
    {
        $parameters = [
            'value' => 'http://www.foobar.com'
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));

        $I->canSeeResponseCodeIs(500);
        $I->canSeeResponseIsJson();

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];

        $I->assertContains('The validation for provided input failed.', $actual['message']);
        $I->assertContains('The expression field is required', $actual['message_internal']['expression'][0]);
    }

    public function returnsExceptionWhenValueMissing(ApiTester $I)
    {
        $parameters = [
            'expression' => '/^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$/m',
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));

        $I->canSeeResponseCodeIs(500);
        $I->canSeeResponseIsJson();

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];

        $I->assertEquals('ValidationException', $actual['exception']);
        $I->assertContains('The validation for provided input failed.', $actual['message']);
        $I->assertContains('The value field must be present', $actual['message_internal']['value'][0]);
    }

    public function returnsExceptionWhenAllMissing(ApiTester $I)
    {
        $parameters = [];

        $I->sendPOST($this->endpoint, json_encode($parameters));

        $I->canSeeResponseCodeIs(500);
        $I->canSeeResponseIsJson();

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];

        $I->assertEquals('danger', $actual['type']);
        $I->assertEquals(0, $actual['code']);
        $I->assertEquals('ValidationException', $actual['exception']);
        $I->assertContains('The validation for provided input failed.', $actual['message']);
        $I->assertContains('The expression field is required', $actual['message_internal']['expression'][0]);
        $I->assertContains('The value field must be present', $actual['message_internal']['value'][0]);
    }
}