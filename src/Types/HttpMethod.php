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

namespace Manno\DoctrineRestDriver\Types;

use Manno\DoctrineRestDriver\Annotations\DataSource;
use Manno\DoctrineRestDriver\Enums\HttpMethods;
use Manno\DoctrineRestDriver\Validation\Assertions;

/**
 * Type for HTTP method
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 */
class HttpMethod
{

    /**
     * Returns the right HTTP method
     *
     * @param  string     $method
     * @param  DataSource $annotation
     * @return string
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public static function create($method, DataSource $annotation = null)
    {
        Str::assert($method, 'method');
        return empty($annotation) || $annotation->getMethod() === null ? $method : $annotation->getMethod();
    }
}
