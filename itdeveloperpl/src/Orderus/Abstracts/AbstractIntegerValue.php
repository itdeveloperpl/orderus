<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Abstracts;

abstract class AbstractIntegerValue
{
    protected $value;

    public function __construct(int $value, $valueKeyName = 'value')
    {
        $this->{$valueKeyName} = $value;
    }
    
}