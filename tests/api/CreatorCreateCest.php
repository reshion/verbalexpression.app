<?php

class CreatorCreateCest
{
    private $endpoint = '/api/v1/creator/create';

    public function _before(ApiTester $I)
    {
        $session = $I->grabService('session');
        $session->put('_token', 'testing');
        $I->haveHttpHeader('X-CSRF-TOKEN', csrf_token());
    }

    public function createsUrlPattern(ApiTester $I)
    {
        $parameters = [
            'pairs' => [
                ['keyword' => 'startOfLine', 'value' => ''],
                ['keyword' => 'then', 'value' => 'http'],
                ['keyword' => 'maybe', 'value' => 's'],
                ['keyword' => 'then', 'value' => '://'],
                ['keyword' => 'maybe', 'value' => 'www.'],
                ['keyword' => 'anythingBut', 'value' => ' '],
                ['keyword' => 'endOfLine', 'value' => 'true']
            ]
        ];

        $expected = [
            'combined' => '/^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$/m',
            'expression' => '^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$',
            'modifiers' => 'm'
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));

        $I->canSeeResponseCodeIs(200);
        $I->canSeeResponseIsJson();
        $I->canSeeResponseContainsJson($expected);
    }

    public function createsRangePattern(ApiTester $I)
    {
        $parameters = [
            'pairs' => [
                ['keyword' => 'startOfLine', 'value' => ''],
                ['keyword' => 'range', 'value' => 'a;z;0;9'],
                ['keyword' => 'endOfLine', 'value' => '']
            ]
        ];

        $expected = ['combined' => '/^[a-z0-9]$/m'];

        $I->sendPOST($this->endpoint, json_encode($parameters));

        $I->canSeeResponseCodeIs(200);
        $I->canSeeResponseIsJson();
        $I->canSeeResponseContainsJson($expected);
    }

    public function returnsExceptionWhenKeywordEmpty(ApiTester $I)
    {
        $parameters = [
            'pairs' => [
                ['keyword' => '', 'value' => 'foo']
            ]
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));
        $I->canSeeResponseCodeIs(500);

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];

        $I->assertEquals("ValidationException", $actual['exception']);
        $I->assertContains('The pairs.0.keyword field is required', $actual['message_internal']['pairs.0.keyword'][0]);

    }

    public function returnsExceptionWhenKeywordNotFound(ApiTester $I)
    {
        $parameters = [
            'pairs' => [
                ['keyword' => 'foobar', 'value' => 'foo']
            ]
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));
        $I->canSeeResponseCodeIs(500);

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];
        $I->assertEquals("KeywordNotFoundException", $actual['exception']);
    }

    public function returnsExceptionWhenKeywordNotGiven(ApiTester $I)
    {
        $parameters = [
            'pairs' => [
                ['foo' => 'startOfLine', 'value' => 'bar']
            ]
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));
        $I->canSeeResponseCodeIs(500);

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];
        $I->assertEquals("ValidationException", $actual['exception']);
        $I->assertEquals("The validation for provided input failed.", $actual['message']);
        $I->assertContains('The pairs.0.keyword field is required', $actual['message_internal']['pairs.0.keyword'][0]);
    }

    public function returnsExceptionWhenValueNotGiven(ApiTester $I)
    {
        $parameters = [
            'pairs' => [
                ['keyword' => 'startOfLine', 'foo' => '']
            ]
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));
        $I->canSeeResponseCodeIs(500);

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];
        $I->assertEquals("ValidationException", $actual['exception']);
        $I->assertEquals("The validation for provided input failed.", $actual['message']);
        $I->assertContains('The pairs.0.value field must be present', $actual['message_internal']['pairs.0.value'][0]);
    }

    public function returnsExceptionWhenRangeArgumentInvalid(ApiTester $I)
    {
        // Range expect
        $parameters = [
            'pairs' => [
                ['keyword' => 'range', 'value' => 'a']
            ]
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));
        $I->canSeeResponseCodeIs(500);

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];
        $I->assertEquals("InvalidArgumentException", $actual['exception']);
        $I->assertContains("Arguments for keyword range are invalid: Number of args must be even", $actual['message']);
    }

    public function returnsExceptionWhenArrayArgumentInvalid(ApiTester $I)
    {
        $parameters = [
            'pairs' => [
                ['keyword' => 'interval', 'value' => '5']
            ]
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));
        $I->canSeeResponseCodeIs(500);

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];
        $I->assertEquals("InvalidArgumentException", $actual['exception']);
        $I->assertEquals("Arguments for keyword interval are invalid", $actual['message']);
        $I->assertContains("Missing argument 2", $actual['message_internal']);

    }

    public function returnsExceptionWhenNoArrayGiven(ApiTester $I)
    {
        $parameters = [
            'pairs' => 'foo'
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));
        $I->canSeeResponseCodeIs(500);

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];
        $I->assertEquals("ValidationException", $actual['exception']);
        $I->assertContains('The validation for provided input failed.', $actual['message']);
        $I->assertContains('The pairs must be an array', $actual['message_internal']['pairs'][0]);
    }

    public function returnsExceptionWhenPairsEmpty(ApiTester $I)
    {
        $parameters = [
            'pairs' => ''
        ];

        $I->sendPOST($this->endpoint, json_encode($parameters));
        $I->canSeeResponseCodeIs(500);

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];
        $I->assertEquals("ValidationException", $actual['exception']);
        $I->assertContains('The validation for provided input failed.', $actual['message']);
        $I->assertContains('The pairs field is required', $actual['message_internal']['pairs'][0]);
    }

    public function returnsExceptionWhenArgumentPairsMissing(ApiTester $I)
    {

        $I->sendPOST($this->endpoint, []);
        $I->canSeeResponseCodeIs(500);

        $actual = $I->grabDataFromResponseByJsonPath('$')[0];

        $I->assertEquals('danger', $actual['type']);
        $I->assertEquals(0, $actual['code']);
        $I->assertEquals('ValidationException', $actual['exception']);
        $I->assertContains('The validation for provided input failed.', $actual['message']);
        $I->assertContains('The pairs field is required', $actual['message_internal']['pairs'][0]);
    }



}