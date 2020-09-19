<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Abstracts;

use itdeveloperpl\Orderus\Traits\PassTurnTrait;

abstract class AbstractSkill
{

    use PassTurnTrait;

    public function name()
    {
        return ltrim(substr(get_class($this), strrpos(get_class($this), '\\')),
                '\\');
    }

}
