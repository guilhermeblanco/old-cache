<?php

namespace Doctrine\Tests\Cache\Expiry;

use Doctrine\Cache\Expiry\ModifiedExpiryPolicy;
use Doctrine\Cache\Expiry\Duration;

class ModifiedExpiryPolicyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideDataForCreation
     */
    public function testGetExpiryForCreation($expected, Duration $duration)
    {
        $expiry = new ModifiedExpiryPolicy($duration);

        $this->assertEquals($expected, $expiry->getExpiryForCreation());
    }

    public function provideDataForCreation()
    {
        return array(
            array(
                new Duration(Duration::ETERNAL),
                new Duration(Duration::ETERNAL),
            ),
            array(
                new Duration(Duration::DAYS, 1),
                new Duration(Duration::DAYS, 1),
            )
        );
    }

    /**
     * @dataProvider provideDataForUpdate
     */
    public function testGetExpiryForUpdate($expected, Duration $duration)
    {
        $expiry = new ModifiedExpiryPolicy($duration);

        $this->assertEquals($expected, $expiry->getExpiryForUpdate());
    }

    public function provideDataForUpdate()
    {
        return array(
            array(
                new Duration(Duration::ETERNAL),
                new Duration(Duration::ETERNAL),
            ),
            array(
                new Duration(Duration::DAYS, 1),
                new Duration(Duration::DAYS, 1),
            )
        );
    }
}
 