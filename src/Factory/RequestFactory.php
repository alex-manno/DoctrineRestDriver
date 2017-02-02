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

namespace Manno\DoctrineRestDriver\Factory;

use Manno\DoctrineRestDriver\Annotations\DataSource;
use Manno\DoctrineRestDriver\Types\HttpHeader;
use Manno\DoctrineRestDriver\Types\CurlOptions;
use Manno\DoctrineRestDriver\Types\HttpMethod;
use Manno\DoctrineRestDriver\Types\Payload;
use Manno\DoctrineRestDriver\Types\HttpQuery;
use Manno\DoctrineRestDriver\Types\Request;
use Manno\DoctrineRestDriver\Types\StatusCode;
use Manno\DoctrineRestDriver\Types\Url;

/**
 * Factory for requests
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 */
class RequestFactory
{

    /**
     * Creates a new Request with the given options
     *
     * @param  string     $method
     * @param  array      $tokens
     * @param  array      $options
     * @param  DataSource $annotation
     * @return Request
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function createOne($method, array $tokens, array $options, DataSource $annotation = null)
    {
        return new Request([
            'method'              => HttpMethod::create($method, $annotation),
            'url'                 => Url::createFromTokens($tokens, $options['host'], $annotation),
            'curlOptions'         => CurlOptions::create(array_merge($options['driverOptions'], HttpHeader::create($options['driverOptions'], $tokens))),
            'query'               => HttpQuery::create($tokens),
            'payload'             => Payload::create($tokens, $options),
            'expectedStatusCode'  => StatusCode::create($method, $annotation)
        ]);
    }
}
