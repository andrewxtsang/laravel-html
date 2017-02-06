<?php

namespace Spatie\Html\Test\Html;

use Illuminate\Http\Request;
use Mockery;
use Spatie\Html\Html;
use Spatie\Html\Test\Concerns\AssertsHtmlStrings;

abstract class TestCase extends \Spatie\Html\Test\TestCase
{
    use AssertsHtmlStrings;

    /** @var \Mockery\MockInterface */
    protected $request;

    /** @var \Spatie\Html\Html $html */
    protected $html;

    public function setUp()
    {
        parent::setUp();

        $this->request = Mockery::mock(Request::class);

        $this->request
            ->shouldReceive('old')
            ->withAnyArgs()
            ->zeroOrMoreTimes()
            ->andReturnUsing(function ($key, $value = null) {
                return $value;
            });

        $this->html = new Html($this->request);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
