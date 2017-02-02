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

namespace Manno\DoctrineRestDriver\Tests\Transformers;

use Manno\DoctrineRestDriver\Transformers\MysqlToRequest;
use Manno\DoctrineRestDriver\Types\CurlOptions;
use Manno\DoctrineRestDriver\Types\Request;

/**
 * Tests the mysql to request transformer
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 *
 * @coversDefaultClass Manno\DoctrineRestDriver\Transformers\MysqlToRequest
 */
class MysqlToRequestTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var MysqlToRequest
     */
    private $mysqlToRequest;

    /**
     * @var string
     */
    private $apiUrl = 'http://www.test.de';

    /**
     * @var array
     */
    private $options = [
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_MAXREDIRS      => 25,
        CURLOPT_TIMEOUT        => 25,
        CURLOPT_CONNECTTIMEOUT => 25,
        CURLOPT_CRLF           => true,
        CURLOPT_SSLVERSION     => 3,
        CURLOPT_FOLLOWLOCATION => true,
    ];

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $routings = $this->getMockBuilder('Manno\DoctrineRestDriver\Annotations\RoutingTable')->disableOriginalConstructor()->getMock();
        $routings
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue(null));

        $this->mysqlToRequest = new MysqlToRequest([
            'host'          => 'http://www.test.de',
            'driverOptions' => [
                'CURLOPT_HTTPHEADER'     => 'Content-Type: application/json',
                'CURLOPT_MAXREDIRS'      => 25,
                'CURLOPT_TIMEOUT'        => 25,
                'CURLOPT_CONNECTTIMEOUT' => 25,
                'CURLOPT_CRLF'           => true,
                'CURLOPT_SSLVERSION'     => 3,
                'CURLOPT_FOLLOWLOCATION' => true,
            ]
        ], $routings);
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     */
    public function selectOne()
    {
        $query    = 'SELECT name FROM products WHERE id = 1';
        $expected = new Request([
            'method'      => 'get',
            'url'         => $this->apiUrl . '/products/1',
            'curlOptions' => $this->options
        ]);

        $this->assertEquals($expected, $this->mysqlToRequest->transform($query));
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     */
    public function selectOneBy()
    {
        $query    = 'SELECT name FROM products WHERE id=1 AND name=myName';
        $expected = new Request([
            'method'      => 'get',
            'url'         => $this->apiUrl . '/products/1',
            'curlOptions' => $this->options,
            'query'       => 'name=myName'
        ]);

        $this->assertEquals($expected, $this->mysqlToRequest->transform($query));
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     */
    public function selectBy()
    {
        $query    = 'SELECT name FROM products WHERE name=myName';
        $expected = new Request([
            'method'      => 'get',
            'url'         => $this->apiUrl . '/products',
            'curlOptions' => $this->options,
            'query'       => 'name=myName'
        ]);

        $this->assertEquals($expected, $this->mysqlToRequest->transform($query));
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     */
    public function selectAll()
    {
        $query    = 'SELECT name FROM products';
        $expected = new Request([
            'method'      => 'get',
            'url'         => $this->apiUrl . '/products',
            'curlOptions' => $this->options
        ]);

        $this->assertEquals($expected, $this->mysqlToRequest->transform($query));
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     */
    public function selectJoined()
    {
        $query    = 'SELECT p.name FROM products p JOIN product.categories c ON c.id = p.categories_id';
        $expected = new Request([
            'method'      => 'get',
            'url'         => $this->apiUrl . '/products',
            'curlOptions' => $this->options
        ]);

        $this->assertEquals($expected, $this->mysqlToRequest->transform($query));
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     */
    public function insert()
    {
        $query    = 'INSERT INTO products (name) VALUES ("myName")';
        $expected = new Request([
            'method'             => 'post',
            'url'                => $this->apiUrl . '/products',
            'curlOptions'        => $this->options,
            'payload'            => json_encode(['name' => 'myName']),
            'expectedStatusCode' => 201
        ]);

        $this->assertEquals($expected, $this->mysqlToRequest->transform($query));
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     */
    public function update()
    {
        $query    = 'UPDATE products SET name="myValue" WHERE id=1';
        $expected = new Request([
            'method'      => 'put',
            'url'         => $this->apiUrl . '/products/1',
            'curlOptions' => $this->options,
            'payload'     => json_encode(['name' => 'myValue'])
        ]);

        $this->assertEquals($expected, $this->mysqlToRequest->transform($query));
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     */
    public function updateAll()
    {
        $query    = 'UPDATE products SET name="myValue"';
        $expected = new Request([
            'method'      => 'put',
            'url'         => $this->apiUrl . '/products',
            'curlOptions' => $this->options,
            'payload'     => json_encode(['name' => 'myValue'])
        ]);

        $this->assertEquals($expected, $this->mysqlToRequest->transform($query));
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     */
    public function delete()
    {
        $query    = 'DELETE FROM products WHERE id=1';
        $expected = new Request([
            'method'              => 'delete',
            'url'                 => $this->apiUrl . '/products/1',
            'curlOptions'         => $this->options,
            'expectedStatusCode'  => 204
        ]);

        $this->assertEquals($expected, $this->mysqlToRequest->transform($query));
    }

    /**
     * @test
     * @group  unit
     * @covers ::__construct
     * @covers ::transform
     * @covers ::<private>
     * @expectedException \Exception
     */
    public function brokenQuery()
    {
        $query = 'SHIT products WHERE dirt=1';
        $this->mysqlToRequest->transform($query);
    }
}
