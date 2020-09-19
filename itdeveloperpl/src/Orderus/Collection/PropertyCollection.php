<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Collection;

use Illuminate\Support\Collection;
use Exception;

class PropertyCollection extends Collection
{

    public function push(...$values)
    {
        foreach ($values as $value) {

            if (false === $value instanceof \itdeveloperpl\Orderus\Interfaces\Property\Propertable) {
                throw new Exception(get_class($value)." is not instance of ".\itdeveloperpl\Orderus\Interfaces\Property\Propertable::class);
            }

            /**
             * @todo verify if already exists in collection property of this class (example Health)
             * If exists then replace or throw exception
             */
            $this->items[] = $value;
        }
        return $this;
    }

    /**
     * @param string $property
     * @return \itdeveloperpl\Orderus\Abstracts\AbstractProperty
     */
    public function getProperty($property)
    {
        $className = 'itdeveloperpl\Orderus\Model\Property\\'.ucfirst($property);

        foreach ($this->items as $item) {
            if (get_class($item) == $className) {
                return $item;
            }
        }
    }

}