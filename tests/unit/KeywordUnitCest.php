<?php

use App\VerbalExpression\Storage\Keyword\Keyword;

class KeywordUnitCest {

    public function allReturnsCollection(UnitTester $I)
    {
        $I->amGoingTo('call all and expect a collection');
        $keywordStorage = new Keyword();

        $collection = $keywordStorage->all();

        $I->assertEquals(sizeof($collection), 24);
        $I->assertIsArray($collection[0]);
    }


    public function existWorks(UnitTester $I)
    {
        $I->amGoingTo('test several keywords of existing');
        $keywordStorage = new Keyword();

        $I->expect('startOfLine exists');
        $I->assertTrue($keywordStorage->exists("startOfLine"));

        $I->expect('anythingBut exists');
        $I->assertTrue($keywordStorage->exists("anythingBut"));

        $I->expect('foo not exits');
        $I->assertFalse($keywordStorage->exists("foo"));

        $I->expect('bar not exits');
        $I->assertFalse($keywordStorage->exists("bar"));
    }

    public function findValidKeyword(UnitTester $I)
    {
        $I->amGoingTo('find valid keywords');
        $keywordStorage = new Keyword();

        $I->expect('to find startOfLine');
        $actual = $keywordStorage->find("startOfLine");
        $I->assertEquals($actual['key'], "startOfLine");
        $I->assertEquals($actual['accepted'], "boolean");

        $I->expect('to find then');
        $actual = $keywordStorage->find("then");
        $I->assertEquals($actual['key'], "then");
        $I->assertEquals($actual['accepted'], "string");

        $I->expect('to find range');
        $actual = $keywordStorage->find("range");
        $I->assertEquals($actual['key'], "range");
        $I->assertEquals($actual['accepted'], "array");
    }

    /**
     * @expectedException App\VerbalExpression\Exception\KeywordNotFoundException
     */
    public function notFindInvalidKeyword(UnitTester $I)
    {
        $I->amGoingTo('not find an invalid keyword');
        $keywordStorage = new Keyword();

        $I->seeExceptionThrown('App\VerbalExpression\Exception\KeywordNotFoundException', function () use ($I, $keywordStorage)
        {
            $keywordStorage->find("foo");
        });
    }
}
