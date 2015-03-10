<?php
use App\VerbalExpression\Creator;
use App\VerbalExpression\Storage\Keyword\Keyword;
use App\VerbalExpression\VerbalExpression;

class CreatorIntegrationCest {
    public function createsValidUrlPattern(IntegrationTester $I)
    {
        $I->amGoingTo('create a valid url pattern');

        $creator = new Creator(new VerbalExpression(), new Keyword());

        $actual = $creator
            ->add("startOfLine", "")
            ->add("then", "http")
            ->add("maybe", "s")
            ->add("then", "://")
            ->add("maybe", "www.")
            ->add("anythingBut", " ")
            ->add("endOfLine", "")->create();

        $I->assertEquals('/^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$/m', $actual['combined']);
        $I->assertEquals('^(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)$', $actual['expression']);
        $I->assertEquals('m', $actual['modifiers']);
    }

    public function createsUrlPatternWithoutStartAndEnd(IntegrationTester $I)
    {
        $I->amGoingTo('create a valid url pattern without providing start and endOfLine Tags');

        $creator = new Creator(new VerbalExpression(), new Keyword());

        $actual = $creator
            ->add("startOfLine", "false")
            ->add("then", "http")
            ->add("maybe", "s")
            ->add("then", "://")
            ->add("maybe", "www.")
            ->add("anythingBut", " ")
            ->add("endOfLine", "false")->create();

        $I->assertEquals('/(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)/m', $actual['combined']);
        $I->assertEquals('(?:http)(?:s)?(?:\:\/\/)(?:www\.)?(?:[^ ]*)', $actual['expression']);
        $I->assertEquals('m', $actual['modifiers']);
    }

    public function createsValidRangePattern(IntegrationTester $I)
    {
        $I->amGoingTo('create a valid range pattern');

        $creator = new Creator(new VerbalExpression(), new Keyword());

        $actual = $creator
            ->add("startOfLine", "")
            ->add("range", "a;z;0;9")
            ->add("endOfLine", "")->create();

        $I->assertEquals('/^[a-z0-9]$/m', $actual['combined']);
        $I->assertEquals('^[a-z0-9]$', $actual['expression']);
        $I->assertEquals('m', $actual['modifiers']);
    }

    public function createsValidPhonePattern(IntegrationTester $I)
    {
        $I->amGoingTo("create a valid phone pattern and check it");

        $creator = new Creator(new VerbalExpression(), new Keyword());

        $actual = $creator
            ->add('startOfLine', "")
            ->add('maybe', '+')
            ->add('startOfGroup', "")
            ->add('maybe', " ")
            ->add('range', '0;9')
            ->add('atLeastOnce', "")
            ->add('endOfGroup', "")
            ->add('atLeastOnce', "")
            ->add('endOfLine', "")
            ->create();

        $I->assertEquals('/^(?:\+)?((?: )?[0-9]+)+$/m', $actual['combined']);
    }

    /**
     * @expectedException App\VerbalExpression\Exception\InvalidArgumentException
     */
    public function throwsExceptionWhenInvalidRangeArguments(IntegrationTester $I)
    {
        $creator = new Creator(new VerbalExpression(), new Keyword());

        $I->seeExceptionThrown('App\VerbalExpression\Exception\InvalidArgumentException', function () use ($I, $creator)
        {
            $creator->add("range", "");
        });
    }
}