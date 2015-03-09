<?php
use App\VerbalExpression\Creator;
use Mockery as m;

class CreatorUnitCest {

    public function addsSingleValue(UnitTester $I)
    {
        $I->amGoingTo('add a single valuepair to regular expression');
        $anythingBut = $this->mockAnythingBut();

        $regex = m::mock('App\VerbalExpression\VerbalExpression');
        $regex->shouldReceive('anythingBut')->with(false)->once();

        $keywordStorage = m::mock('App\VerbalExpression\Storage\Keyword\Keyword');
        $keywordStorage->shouldReceive('find')->with('anythingBut')->andReturn($anythingBut);

        $creator = new Creator($regex, $keywordStorage);
        $creator->add("anythingBut", "false");
    }

    public function addsArray(UnitTester $I)
    {
        $I->amGoingTo('add an array of valuepairs to regular expression');

        $pairs = [
            ['keyword' => 'anythingBut', 'value' => ''],
            ['keyword' => 'something', 'value' => '']
        ];

        $anythingBut = $this->mockAnythingBut();
        $something = $this->mockSomething();

        $regex = m::mock('App\VerbalExpression\VerbalExpression');
        $regex->shouldReceive('anythingBut')->with(true)->once();
        $regex->shouldReceive('something')->with('')->once();

        $keywordStorage = m::mock('App\VerbalExpression\Storage\Keyword\Keyword');
        $keywordStorage->shouldReceive('find')->with('anythingBut')->andReturn($anythingBut);
        $keywordStorage->shouldReceive('find')->with('something')->andReturn($something);

        $creator = new Creator($regex, $keywordStorage);
        $creator->addArray($pairs);
    }

    /**
     * @expectedException App\VerbalExpression\Exception\ValidationException
     */
    public function notAddsArrayWhenNoArrayGiven(UnitTester $I)
    {
        $I->amGoingTo('see Exception when passing a non array');

        $regex = m::mock('App\VerbalExpression\VerbalExpression');
        $keywordStorage = m::mock('App\VerbalExpression\Storage\Keyword\Keyword');

        $creator = new Creator($regex, $keywordStorage);

        $I->seeExceptionThrown('App\VerbalExpression\Exception\ValidationException', function () use ($I, $creator)
        {
            $creator->addArray("foobar");
        });
    }

    /**
     * @expectedException App\VerbalExpression\Exception\ValidationException
     */
    public function notAddsArrayWhenOneKeyNotPresent(UnitTester $I)
    {
        $I->amGoingTo('see Exception when at least one keyword-key missing');

        $pairs = [
            ['keyword' => 'anythingBut', 'value' => ''],
            ['foo' => 'something', 'value' => '']
        ];

        $anythingBut = $this->mockAnythingBut();
        $something = $this->mockSomething();

        $regex = m::mock('App\VerbalExpression\VerbalExpression');
        $regex->shouldReceive('anythingBut')->with(true)->once();
        $regex->shouldNotHaveReceived('something');

        $keywordStorage = m::mock('App\VerbalExpression\Storage\Keyword\Keyword');
        $keywordStorage->shouldReceive('find')->with('anythingBut')->andReturn($anythingBut);
        $keywordStorage->shouldReceive('find')->with('something')->andReturn($something);

        $creator = new Creator($regex, $keywordStorage);

        $I->seeExceptionThrown('App\VerbalExpression\Exception\ValidationException', function () use ($I, $creator, $pairs)
        {
            $creator->addArray($pairs);
        });
    }

    /**
     * @expectedException App\VerbalExpression\Exception\ValidationException
     */
    public function notAddsArrayWhenOneValueNotPresent(UnitTester $I)
    {
        $I->amGoingTo('see exception when at least on value-key is not present');

        $pairs = [
            ['keyword' => 'anythingBut', 'value' => ''],
            ['keyword' => 'something', 'bar' => '']
        ];

        $anythingBut = $this->mockAnythingBut();
        $something = $this->mockSomething();

        $regex = m::mock('App\VerbalExpression\VerbalExpression');
        $regex->shouldReceive('anythingBut')->with(true)->once();
        $regex->shouldNotHaveReceived('something');

        $keywordStorage = m::mock('App\VerbalExpression\Storage\Keyword\Keyword');
        $keywordStorage->shouldReceive('find')->with('anythingBut')->andReturn($anythingBut);
        $keywordStorage->shouldReceive('find')->with('something')->andReturn($something);

        $creator = new Creator($regex, $keywordStorage);

        $I->seeExceptionThrown('App\VerbalExpression\Exception\ValidationException', function () use ($I, $creator, $pairs)
        {
            $creator->addArray($pairs);
        });
    }

    public function createsValidPattern(UnitTester $I)
    {
        $I->amGoingTo('create valid pattern');

        $regex = m::mock('App\VerbalExpression\VerbalExpression');
        $regex->shouldReceive('getRegex')->once()->andReturn('//m');

        $keywordStorage = m::mock('App\VerbalExpression\Storage\Keyword\Keyword');
        $creator = new Creator($regex, $keywordStorage);

        $actual = $creator->create();
        $I->assertEquals('//m', $actual['combined']);
    }

    private function mockAnythingBut()
    {
        return [
            'key' => 'anythingBut',
            'accepted' => 'boolean'
        ];
    }

    private function mockSomething()
    {

        return [
            'key' => 'something',
            'accepted' => 'string'
        ];

    }

}