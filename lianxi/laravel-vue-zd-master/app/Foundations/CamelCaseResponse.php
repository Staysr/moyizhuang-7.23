<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/24
 * Time: 13:50
 */

namespace App\Foundations;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Routing\ResponseFactory as BaseResponseFactory;
use Illuminate\Support\Facades\Log;

/**
 * Convert response JSON key to camelCase
 */
class CamelCaseResponse extends BaseResponseFactory
{
    public function __construct($arg1, $arg2)
    {
        parent::__construct($arg1, $arg2);
    }

    public function json($data = array(), $status = 200, array $headers = array(), $options = 0)
    {
        $json = $this->encodeJson($data);
        return parent::json($json, $status, $headers, $options);
    }

    /**
     * Encode a value to camelCase JSON
     */
    public function encodeJson($value)
    {
        if ($value instanceof Arrayable) {
            return $this->encodeArrayable($value);
        } else {
            if (is_array($value)) {
                return $this->encodeArray($value);
            } else {
                if (is_object($value)) {
                    return $this->encodeArray((array)$value);
                } else {
                    return $value;
                }
            }
        }
    }

    /**
     * Encode a arrayable
     */
    public function encodeArrayable($arrayable)
    {
        $array = $arrayable->toArray();

        return $this->encodeJson($array);
    }

    /**
     * Encode an array
     */
    public function encodeArray($array)
    {
        $newArray = [];
        foreach ($array as $key => $val) {
            if($val !== null){
                $newArray[\camel_case($key)] = $this->encodeJson($val);
            }
        }

        return $newArray;
    }
}