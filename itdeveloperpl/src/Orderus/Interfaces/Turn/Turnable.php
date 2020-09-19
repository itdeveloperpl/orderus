<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Interfaces\Turn;

use itdeveloperpl\Orderus\Interfaces\Player\Playerable;

interface Turnable
{

    public function setPlayers(Playerable $striker, Playerable $defender);

    public function getDefender();
    
    public function getStriker();

    /**
     * Method defines how fight in current tour looks like. Players are passed
     * in order of attack
     * @param Playerable $striker
     * @param Playerable $defender
     */
    public function fight(Playerable $striker, Playerable $defender);
}
