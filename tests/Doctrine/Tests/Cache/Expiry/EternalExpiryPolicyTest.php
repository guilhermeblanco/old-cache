<?php

namespace Doctrine\Tests\Cache\Expiry;

use Doctrine\Cache\Expiry\EternalExpiryPolicy;
use Doctrine\Cache\Expiry\Duration;

class EternalExpiryPolicyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideDataForCreation
     */
    public function testGetExpiryForCreation($expected)
    {
        $expiry = new EternalExpiryPolicy();

        $this->assertEquals($expected, $expiry->getExpiryForCreation());
    }

    public function provideDataForCreation()
    {
        return array(
            array(
                new Duration(Duration::ETERNAL),
            )
        );
    }

    /**
     * @dataProvider provideDataForUpdate
     */
    public function testGetExpiryForUpdate($expected)
    {
        $expiry = new EternalExpiryPolicy();

        $this->assertEquals($expected, $expiry->getExpiryForUpdate());
    }

    public function provideDataForUpdate()
    {
        return array(
            array(
                new Duration(Duration::ETERNAL),
            ),
        );
    }
}
