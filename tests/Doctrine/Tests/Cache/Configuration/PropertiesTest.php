<?php

namespace Doctrine\Tests\Cache\Configuration;

use Doctrine\Cache\Configuration\Properties;
use Doctrine\Tests\DoctrineTestCase;

class PropertiesTest extends DoctrineTestCase
{
    /**
     * @dataProvider provideDataForAll
     */
    public function testAll($expected, Properties $properties)
    {
        $this->assertEquals($expected, $properties->all());
    }

    public function provideDataForAll()
    {
        $properties = new Properties();

        $properties->set('key', 'value');

        return array(
            array(
                array(),
                new Properties(),
            ),
            array(
                array('key' => 'value'),
                clone $properties,
            ),
        );
    }

    /**
     * @dataProvider provideDataForNames
     */
    public function testNames($expected, Properties $properties)
    {
        $this->assertEquals($expected, $properties->names());
    }

    public function provideDataForNames()
    {
        $properties = new Properties();

        $properties->set('key', 'value');

        return array(
            array(
                array(),
                new Properties(),
            ),
            array(
                array('key'),
                clone $properties,
            ),
        );
    }

    /**
     * @dataProvider provideDataForGet
     */
    public function testGet($expected, $key, Properties $properties)
    {
        $this->assertEquals($expected, $properties->get($key));
    }

    public function provideDataForGet()
    {
        $properties = new Properties();

        $properties->set('key', 'value');
        $properties->set('another_key', null);

        return array(
            array(
                null,
                'other_key',
                new Properties(),
            ),
            array(
                'value',
                'key',
                clone $properties,
            ),
            array(
                null,
                'another_key',
                clone $properties,
            ),
        );
    }

    /**
     * @dataProvider provideDataForHas
     */
    public function testHas($expected, $key, Properties $properties)
    {
        $this->assertEquals($expected, $properties->has($key));
    }

    public function provideDataForHas()
    {
        $properties = new Properties();

        $properties->set('key', 'value');
        $properties->set('another_key', null);

        return array(
            array(
                false,
                'other_key',
                new Properties(),
            ),
            array(
                true,
                'key',
                clone $properties,
            ),
            array(
                true,
                'another_key',
                clone $properties,
            ),
        );
    }

    /**
     * @dataProvider provideDataForRemove
     */
    public function testRemove($expected, $key, Properties $properties)
    {
        $properties->remove($key);

        $this->assertEquals($expected, $properties->all());
    }

    public function provideDataForRemove()
    {
        $properties = new Properties();

        $properties->set('key', 'value');
        $properties->set('another_key', null);

        return array(
            array(
                array(),
                'other_key',
                new Properties(),
            ),
            array(
                array('another_key' => null),
                'key',
                clone $properties,
            ),
            array(
                array('key' => 'value'),
                'another_key',
                clone $properties,
            ),
        );
    }

    public function testArrayAccess()
    {
        $properties = new Properties();

        $this->assertEquals(array(), $properties->all());

        // offsetSet
        $properties['key'] = 'value';
        $properties['another_key'] = null;

        $this->assertEquals(array(
            'key' => 'value',
            'another_key' => null,
        ), $properties->all());

        // offsetGet
        $this->assertEquals('value', $properties['key']);
        $this->assertEquals(null, $properties['another_key']);

        // offsetIsset
        $this->assertTrue(isset($properties['key']));
        $this->assertFalse(isset($properties['other_key']));

        // offsetUnset
        unset($properties['another_key']);

        $this->assertEquals(array(
            'key' => 'value',
        ), $properties->all());
    }
}
