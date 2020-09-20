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

        $damage = $this->getTurn()->getDamage();
        if (rand(1, 5) === 1 && $damage) {
            $this->getTurn()->setDamage($damage / 2);
            $this->getTurn()->getGame()->notify(
                    sprintf("%s uses skill \"%s\" and gets half of damage (%d instead of %d)",
                            $player2->name(),
                            $this->name(),
                            ($damage / 2),
                            $damage));
        }
        return $this;
    }

}
