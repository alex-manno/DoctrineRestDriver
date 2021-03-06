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

namespace Manno\DoctrineRestDriver\Enums;

use Manno\DoctrineRestDriver\Exceptions\Exceptions;
use Manno\DoctrineRestDriver\Exceptions\InvalidSqlOperationException;

/**
 * Contains all available http methods of the driver
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 */
class HttpMethods
{
    const POST   = 'post';
    const PUT    = 'put';
    const DELETE = 'delete';
    const GET    = 'get';

    /**
     * returns the sql operators equal http method
     *
     * @param  string $operation
     * @return string
     * @throws InvalidSqlOperationException
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public static function ofSqlOperation($operation)
    {
        if ($operation === SqlOperations::INSERT) {
            return HttpMethods::POST;
        }
        if ($operation === SqlOperations::SELECT) {
            return HttpMethods::GET;
        }
        if ($operation === SqlOperations::UPDATE) {
            return HttpMethods::PUT;
        }
        if ($operation === SqlOperations::DELETE) {
            return HttpMethods::DELETE;
        }

        return Exceptions::InvalidSqlOperationException($operation);
    }
}
