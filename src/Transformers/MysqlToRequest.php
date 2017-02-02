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

namespace Manno\DoctrineRestDriver\Transformers;

use Manno\DoctrineRestDriver\Annotations\RoutingTable;
use Manno\DoctrineRestDriver\Enums\HttpMethods;
use Manno\DoctrineRestDriver\Factory\RequestFactory;
use Manno\DoctrineRestDriver\Types\Annotation;
use Manno\DoctrineRestDriver\Types\Id;
use Manno\DoctrineRestDriver\Types\Request;
use Manno\DoctrineRestDriver\Types\SqlOperation;
use Manno\DoctrineRestDriver\Types\SqlQuery;
use Manno\DoctrineRestDriver\Types\Table;
use Manno\DoctrineRestDriver\Types\Url;
use Manno\DoctrineRestDriver\Validation\Assertions;
use PHPSQLParser\PHPSQLParser;

/**
 * Transforms a given sql query to a corresponding request
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 */
class MysqlToRequest
{

    /**
     * @var PHPSQLParser
     */
    private $parser;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var array
     */
    private $options;

    /**
     * @var RoutingTable
     */
    private $routings;

    /**
     * MysqlToRequest constructor
     *
     * @param array        $options
     * @param RoutingTable $routings
     */
    public function __construct(array $options, RoutingTable $routings)
    {
        $this->options        = $options;
        $this->parser         = new PHPSQLParser();
        $this->requestFactory = new RequestFactory();
        $this->routings       = $routings;
    }

    /**
     * Transforms the given query into a request object
     *
     * @param  string $query
     * @return Request
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function transform($query)
    {
        $tokens     = $this->parser->parse($query);
        $method     = HttpMethods::ofSqlOperation(SqlOperation::create($tokens));
        $annotation = Annotation::get($this->routings, Table::create($tokens), $method);

        return $this->requestFactory->createOne($method, $tokens, $this->options, $annotation);
    }
}
