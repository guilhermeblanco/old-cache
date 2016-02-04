<?php

namespace Doctrine\Tests\Cache\Expiry;

use Doctrine\Cache\Expiry\Duration;

class DurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideDataForConstructor
     */
    public function testConstructor($timeUnit, $durationAmount, $expectedAmount)
    {
        $duration = new Duration($timeUnit, $durationAmount);

        $this->assertEquals($timeUnit, $duration->getTimeUnit());
        $this->assertEquals($expectedAmount, $duration->getDurationAmount());
    }

    public function provideDataForConstructor()
    {
        return array(
            array(Duration::ZERO, 0.0, 0.0),
            array(Duration::ETERNAL, 0.0, 0.0),
            array(Duration::SECONDS, 0.0, 0.0),
            array(Duration::MINUTES, 0.0, 0.0),
            array(Duration::HOURS, 0.0, 0.0),
            array(Duration::DAYS, 0.0, 0.0),
            array(Duration::ZERO, 1.0, 0.0),
            array(Duration::ETERNAL, 1.0, 0.0),
            array(Duration::SECONDS, 1.0, 1.0),
            array(Duration::MINUTES, 1.0, 1.0),
            array(Duration::HOURS, 1.0, 1.0),
            array(Duration::DAYS, 1.0, 1.0),
            array(Duration::ZERO, 25, 0.0),
            array(Duration::ETERNAL, 25, 0.0),
            array(Duration::SECONDS, 25, 25),
            array(Duration::MINUTES, 25, 25),
            array(Duration::HOURS, 25, 25),
            array(Duration::DAYS, 25, 25),
        );
    }

    /**
     * @dataProvider provideDataForConstructorWithNegativeAmount
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorWithNegativeAmount($timeUnit, $durationAmount)
    {
        new Duration($timeUnit, $durationAmount);
    }

    public function provideDataForConstructorWithNegativeAmount()
    {
        return array(
            array(Duration::ZERO, -1),
            array(Duration::ETERNAL, -1),
            array(Duration::SECONDS, -1),
            array(Duration::MINUTES, -1),
            array(Duration::HOURS, -1),
            array(Duration::DAYS, -1),
        );
    }

    /**
     * @dataProvider provideDataForIsZero
     */
    public function testIsZero(Duration $duration, $isZero)
    {
        $this->assertEquals($isZero, $duration->isZero());
    }

    public function provideDataForIsZero()
    {
        return array(
            array(new Duration(Duration::ZERO), true),
            array(new Duration(Duration::ETERNAL, 0.0), false),
            array(new Duration(Duration::SECONDS, 0.0), true),
            array(new Duration(Duration::MINUTES, 0.0), true),
            array(new Duration(Duration::HOURS, 0.0), true),
            array(new Duration(Duration::DAYS, 0.0), true),
            array(new Duration(Duration::SECONDS, 1.0), false),
            array(new Duration(Duration::MINUTES, 1.0), false),
            array(new Duration(Duration::HOURS, 1.0), false),
            array(new Duration(Duration::DAYS, 1.0), false),
            array(new Duration(Duration::SECONDS, 25), false),
            array(new Duration(Duration::MINUTES, 25), false),
            array(new Duration(Duration::HOURS, 25), false),
            array(new Duration(Duration::DAYS, 25), false),
        );
    }

    /**
     * @dataProvider provideDataForIsEternal
     */
    public function testIsEternal(Duration $duration, $isEternal)
    {
        $this->assertEquals($isEternal, $duration->isEternal());
    }

    public function provideDataForIsEternal()
    {
        return array(
            array(new Duration(Duration::ZERO), false),
            array(new Duration(Duration::ETERNAL, 0.0), true),
            array(new Duration(Duration::SECONDS, 0.0), false),
            array(new Duration(Duration::MINUTES, 0.0), false),
            array(new Duration(Duration::HOURS, 0.0), false),
            array(new Duration(Duration::DAYS, 0.0), false),
            array(new Duration(Duration::SECONDS, 1.0), false),
            array(new Duration(Duration::MINUTES, 1.0), false),
            array(new Duration(Duration::HOURS, 1.0), false),
            array(new Duration(Duration::DAYS, 1.0), false),
            array(new Duration(Duration::SECONDS, 25), false),
            array(new Duration(Duration::MINUTES, 25), false),
            array(new Duration(Duration::HOURS, 25), false),
            array(new Duration(Duration::DAYS, 25), false),
        );
    }
}