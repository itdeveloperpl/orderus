<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Abstracts;

abstract class AbstractProperty extends AbstractIntegerValue
{

    public function update(int $value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function get()
    {
        return $this->value;
    }

    public function __toString()
    {
        return sprintf("%s: %d", $this->name(), $this->value);
    }

    public function name()
    {
        return ltrim(substr(get_class($this), strrpos(get_class($this), '\\')),
                '\\');
    }

}
