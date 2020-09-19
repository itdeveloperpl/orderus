<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Interfaces\Skill;

use itdeveloperpl\Orderus\Interfaces\Player\Playerable;

interface Skillable
{

    public function beforeStrike(Playerable $firstStrikePlayer, Playerable $player2);

    public function afterStrike(Playerable $firstStrikePlayer, Playerable $player2);
}
