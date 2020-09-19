<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Interfaces\Player;

interface Playerable
{

    /**
     * @return \itdeveloperpl\Orderus\Collection\PropertyCollection;
     */
    public function properties();

    /**
     * @return \itdeveloperpl\Orderus\Collection\SkillCollection;
     */
    public function skills();
    
    /**
     * @return boolean
     */
    public function alive();
}
