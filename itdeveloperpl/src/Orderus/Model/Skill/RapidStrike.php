<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 *
 * Offensive skill. Strike twice while it’s his turn to attack; there’s a 10% chance he’ll use this skill
  every time he attacks
 */

namespace itdeveloperpl\Orderus\Model\Skill;

use itdeveloperpl\Orderus\Interfaces\Skill\Skillable;
use itdeveloperpl\Orderus\Abstracts\AbstractSkill;
use itdeveloperpl\Orderus\Interfaces\Player\Playerable;

class RapidStrike extends AbstractSkill implements Skillable
{
    
    protected $previousStrengthValue;
    protected $strength;

    public function beforeStrike(Playerable $firstStrikePlayer, Playerable $player2)
    {

        $this->strength = $firstStrikePlayer->properties()->getProperty('strength');

        if (rand(1, 10) === 1 && $this->strength) {
            
            $this->getTurn()->getGame()->notify(sprintf("%s uses skill \"%s\"",$firstStrikePlayer->name(),$this->name()));
            $this->previousStrengthValue = $this->strength->get();
            $this->strength->update($this->previousStrengthValue * 2);
            // In task I had to make strike twice for this skill but for fastest development I decided to double strength
            // instead of maing double strike. There is posibility of doing that
            // by calling from here $this->getTurn()->strike() extra
        }
        return $this;
    }

    public function afterStrike(Playerable $firstStrikePlayer, Playerable $player2)
    {
        // return strength to previous value
        if($this->previousStrengthValue){
            $this->strength->update($this->previousStrengthValue);
            unset($this->previousStrengthValue);
        }
        return $this;
    }

}
