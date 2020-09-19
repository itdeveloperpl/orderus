<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Model\Property;

use itdeveloperpl\Orderus\Abstracts\AbstractProperty;
use itdeveloperpl\Orderus\Interfaces\Property\Propertable;

class Luck extends AbstractProperty implements Propertable
{
    public function isLucky()
    {
        $val = rand(1,100);
        return $val<=$this->get();
    }
}