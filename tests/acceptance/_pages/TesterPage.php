<?php

class TesterPage {
    public static $URL = '/';

    public static $inputMatchValue = ['id' => 'match_value'];
    public static $buttonTest = ['id' => 'btn-test-expression'];
    public static $divMessagePositive = ['css' => '.tester-message .alert-success'];
    public static $divMessageNegative = ['css' => '.tester-message .alert-warning'];

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
     * @return TesterPage
     */
    public static function of(AcceptanceTester $I)
    {
        return new static($I);
    }

}