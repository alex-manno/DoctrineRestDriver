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

namespace Manno\DoctrineRestDriver\Tests\Annotations;

use Manno\DoctrineRestDriver\Annotations\Delete;
use Manno\DoctrineRestDriver\Annotations\Select;
use Manno\DoctrineRestDriver\Annotations\Fetch;
use Manno\DoctrineRestDriver\Annotations\Insert;
use Manno\DoctrineRestDriver\Annotations\Update;
use Manno\DoctrineRestDriver\Annotations\Routing;

/**
 * Tests the routing bag
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 *
 * @coversDefaultClass Manno\DoctrineRestDriver\Annotations\Routing
 */
class RoutingTest extends \PHPUnit_Framework_TestCase
{

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->routing = new Routing('Manno\DoctrineRestDriver\Tests\Entity\AssociatedEntity');
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::post
     */
    public function post()
    {
        $this->assertSame(null, $this->routing->post());
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::put
     */
    public function put()
    {
        $this->assertSame(null, $this->routing->put());
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::get
     */
    public function get()
    {
        $this->assertSame(null, $this->routing->get());
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::delete
     */
    public function delete()
    {
        $this->assertSame(null, $this->routing->delete());
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::getAll
     */
    public function getAll()
    {
        $this->assertSame(null, $this->routing->getAll());
    }
}
