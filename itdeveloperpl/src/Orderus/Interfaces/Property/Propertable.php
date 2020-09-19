<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Interfaces\Property;

interface Propertable
{
    public function __construct(int $value);
    
    public function update(int $value);
}