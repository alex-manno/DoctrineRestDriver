<?php
/**
 * This file is part of DoctrineRestDriver.
 *
 * DoctrineRestDriver is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DoctrineRestDriver is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DoctrineRestDriver.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Manno\DoctrineRestDriver\Tests\Formatters;

use Manno\DoctrineRestDriver\Formatters\Json;

/**
 * Tests the json formatter
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 *
 * @coversDefaultClass Manno\DoctrineRestDriver\Formatters\Json
 */
class JsonTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @group  unit
     * @covers ::encode
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function encode()
    {
        $json = new Json();
        $this->assertSame('{"test":"test"}', $json->encode(['test' => 'test']));
    }

    /**
     * @test
     * @group  unit
     * @covers ::decode
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function decode()
    {
        $json = new Json();
        $this->assertEquals(['test' => 'test'], $json->decode('{"test": "test"}'));
    }
}