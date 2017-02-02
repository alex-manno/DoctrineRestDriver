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

namespace Manno\DoctrineRestDriver\Tests\Types;

use Manno\DoctrineRestDriver\Types\Authentication;

/**
 * Tests the authentication type
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 *
 * @coversDefaultClass Manno\DoctrineRestDriver\Types\Authentication
 */
class AuthenticationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @group  unit
     * @covers ::create
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function create()
    {
        $this->assertInstanceOf('Manno\DoctrineRestDriver\Security\AuthStrategy', Authentication::create([]));
    }

    /**
     * @test
     * @group  unit
     * @covers ::create
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function createWithOptions()
    {
        $this->assertInstanceOf('Manno\DoctrineRestDriver\Security\HttpAuthentication', Authentication::create(['driverOptions' => ['authenticator_class' => 'HttpAuthentication']]));
    }

    /**
     * @test
     * @group  unit
     * @covers ::assert
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function assert()
    {
        $authStrategy = $this->getMockBuilder('Manno\DoctrineRestDriver\Security\HttpAuthentication')->disableOriginalConstructor()->getMock();
        $this->assertSame($authStrategy, Authentication::assert($authStrategy));
    }
}
