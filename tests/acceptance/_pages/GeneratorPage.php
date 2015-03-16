<?php

class GeneratorPage {

    /**
     * @var string
     */
    public static $URL = '/';

    /**
     * Button Reset
     *
     * @var array
     */
    public static $buttonReset = ['id' => 'btn-reset'];

    /**
     * Button Generate
     *
     * @var array
     */
    public static $buttonGenerate = ['id' => 'btn-generate'];

    /**
     * Buttons Add Pair
     *
     * @var string
     */
    public static $buttonAddPair = "(//button[contains(@class, 'btn-add-pair')])";

    /**
     * Buttons Remove Pair
     *
     * @var string
     */
    public static $buttonRemovePair = "(//button[contains(@class, 'btn-remove-pair')])";

    /**
     * Selects Keyword
     * @var string
     */
    public static $selectKeyword = "(//select[contains(@class, 'select-key')])";

    /**
     * Inputs Value
     *
     * @var string
     */
    public static $inputValue = "(//input[contains(@class, 'input-value')])";

    /**
     * Input Expression
     *
     * @var array
     */
    public static $inputExpression = ['id' => 'regex'];

    /**
     * Error Pane
     *
     * @var array
     */
    public static $divCreatorError = ['css' => '.creator-error .alert-danger'];

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL . $param;
    }

    /**
     * @var AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

    /**
     * @return GeneratorPage
     */
    public static function of(AcceptanceTester $I)
    {
        return new static($I);
    }

    /**
     * Fills pair
     *
     * @param $index
     * @param $keyword
     * @param $value
     *
     * @return $this
     */
    public function fillPair($index, $keyword, $value)
    {
        $I = $this->acceptanceTester;
        $I->selectOption(GeneratorPage::selectKeyword($index), $keyword);
        $I->fillField(GeneratorPage::inputValue($index), $value);
        return $this;
    }

    /**
     * Get select keyword selector
     *
     * @param $index
     *
     * @return string
     */
    public static function selectKeyword($index)
    {
        return GeneratorPage::$selectKeyword . '[' . $index . ']';
    }

    /**
     * Get input-value selector
     *
     * @param $index
     *
     * @return string
     */
    public static function inputValue($index)
    {
        return GeneratorPage::$inputValue . '[' . $index . ']';
    }

    /**
     * Button Add pair selector
     *
     * @param $index
     *
     * @return string
     */
    public static function buttonAddPair($index)
    {
        return GeneratorPage::$buttonAddPair . '[' . $index . ']';
    }

    /**
     * Button Remove pair selector
     *
     * @param $index
     *
     * @return string
     */
    public static function buttonRemovePair($index)
    {
        return GeneratorPage::$buttonRemovePair . '[' . $index . ']';
    }
}