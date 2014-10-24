<?php

namespace Doctrine\Tests\Cache\Expiry;

use Doctrine\Cache\Expiry\AccessedExpiryPolicy;
use Doctrine\Cache\Expiry\Duration;
use Doctrine\Tests\DoctrineTestCase;

class AccessedExpiryPolicyTest extends DoctrineTestCase
{
    /**
     * @dataProvider provideDataForCreation
     */
    public function testGetExpiryForCreation($expected, Duration $duration)
    {
        $expiry = new AccessedExpiryPolicy($duration);

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
     * @dataProvider provideDataForAccess
     */
    public function testGetExpiryForAccess($expected, Duration $duration)
    {
        $expiry = new AccessedExpiryPolicy($duration);

        $this->assertEquals($expected, $expiry->getExpiryForAccess());
    }

    public function provideDataForAccess()
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
        $expiry = new AccessedExpiryPolicy($duration);

        $this->assertEquals($expected, $expiry->getExpiryForUpdate());
    }

    public function provideDataForUpdate()
    {
        return array(
            array(
                null,
                new Duration(Duration::ETERNAL),
            ),
            array(
                null,
                new Duration(Duration::DAYS, 1),
            )
        );
    }
}
 