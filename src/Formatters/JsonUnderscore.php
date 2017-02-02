<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 02/02/17
 * Time: 11.34
 */

namespace Manno\DoctrineRestDriver\Formatters;

class JsonUnderscore extends Json
{
    public function encode(array $values)
    {
        $newValues = [];
        foreach ($values as $key => $value) {
            $newValues[$this->camelCaseToUnderscore($key)] = $value;
        }
        return parent::encode($newValues);
    }

    public function decode($json)
    {
        $values = parent::decode($json);

        $newValues = [];
        foreach ($values as $key => $value) {
            $newValues[$this->underscoreToCamelCase($key)] = $value;
        }
        return $newValues;
    }

    protected function camelCaseToUnderscore($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    protected function underscoreToCamelCase($input)
    {
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $input);
    }
}
