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

use Manno\DoctrineRestDriver\Annotations\Insert;

/**
 * Tests the insert annotation
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 *
 * @coversDefaultClass Manno\DoctrineRestDriver\Annotations\Insert
 */
class InsertTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::getRoute
     */
    public function getRoute()
    {
        $post = new Insert([
            'value' => 'http://www.mySite.com/post'
        ]);

        $this->assertSame('http://www.mySite.com/post', $post->getRoute());
    }
}
