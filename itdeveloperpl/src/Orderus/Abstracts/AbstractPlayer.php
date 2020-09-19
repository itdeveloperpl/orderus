<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Abstracts;

use itdeveloperpl\Orderus\Collection\{
    PropertyCollection,
    SkillCollection
};

abstract class AbstractPlayer
{

    private $properties;
    private $skills;

    public function __construct()
    {
        $this->properties = new PropertyCollection();
        $this->skills = new SkillCollection();
    }

    /**
     * @return \itdeveloperpl\Orderus\Collection\PropertyCollection;
     */
    public function properties()
    {
        return $this->properties;
    }

    /**
     * @return \itdeveloperpl\Orderus\Collection\SkillCollection;
     */
    public function skills()
    {
        return $this->skills;
    }

    public function name()
    {
        return ltrim(substr(get_class($this), strrpos(get_class($this), '\\')),
                '\\');
    }

    /**
     * @return boolean
     */
    public function alive()
    {
        $health = $this->properties()->getProperty('health');
        return $health && $health->get()>0 ? true : false;

    }

}
