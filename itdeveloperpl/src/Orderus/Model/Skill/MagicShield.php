<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 *
 * Defensive skill. Takes only half of the usual damage when an enemy attacks; there’s a 20%
change he’ll use this skill every time he defends.
 */

namespace itdeveloperpl\Orderus\Model\Skill;

use itdeveloperpl\Orderus\Interfaces\Skill\Skillable;
use itdeveloperpl\Orderus\Abstracts\AbstractSkill;
use itdeveloperpl\Orderus\Interfaces\Player\Playerable;

class MagicShield extends AbstractSkill implements Skillable
{

    public function beforeStrike(Playerable $firstStrikePlayer, Playerable $player2)
    {

      
        return $this;
    }

    public function afterStrike(Playerable $firstStrikePlayer, Playerable $player2)
    {
       
        return $this;
    }

}
