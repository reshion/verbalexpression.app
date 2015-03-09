<?php

use App\VerbalExpression\Tester;
use Codeception\TestCase\Test;

class TesterUnitCest {

    public function matchIsTrueWithMatchingValueAndExpression(UnitTester $I)
    {
        $I->amGoingTo('pass url expression and url to match');
        $I->expect('true');

        $tester = new Tester();

        // url expression
        $expression = '/^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$/m';

        $I->assertTrue($tester->match($expression, "http://www.foobar.com"));
        $I->assertTrue($tester->match($expression, "http://foobar.com"));
        $I->assertTrue($tester->match($expression, "https://www.foobar.com"));
        $I->assertTrue($tester->match($expression, "https://foobar.com"));
    }

    public function matchIsFalseWithNonMatchingValueAndExpression(UnitTester $I)
    {
        $I->amGoingTo('pass url expression and non-url to match');
        $I->expect('false');

        $tester = new Tester();

        // url expression
        $expression = '/^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$/m';

        $I->assertFalse($tester->match($expression, "http:/www.foobar.com"));
        $I->assertFalse($tester->match($expression, "www.foobar.com"));
        $I->assertFalse($tester->match($expression, "http://www.foo bar.com"));
        $I->assertFalse($tester->match($expression, "https://foo bar.com"));
        $I->assertFalse($tester->match($expression, ""));
        $I->assertFalse($tester->match($expression, null));
    }

    public function matchThrowsExceptionWhenExpressionEmpty(UnitTester $I)
    {
        $I->amGoingTo('pass empty expression');
        $I->expectTo('see exception');

        $tester = new Tester();

        $I->seeExceptionThrown('App\VerbalExpression\Exception\RegexException', function () use ($I, $tester)
        {
            $tester->match("", "foo");
        });
    }

    public function matchThrowsExceptionWhenExpressionEqualsNull(UnitTester $I)
    {
        $I->amGoingTo('pass null expression');
        $I->expectTo('see exception');

        $tester = new Tester();

        $I->seeExceptionThrown('App\VerbalExpression\Exception\RegexException', function () use ($I, $tester)
        {
            $tester->match(null, "foo");
        });
    }

    public function matchThrowsExceptionWhenInvalidExpression(UnitTester $I)
    {
        $I->amGoingTo('pass invalid expression');
        $I->expectTo('see exception');

        $tester = new Tester();

        $I->seeExceptionThrown('App\VerbalExpression\Exception\RegexException', function () use ($I, $tester)
        {
            $tester->match("/^", "bar");
        });
    }
}