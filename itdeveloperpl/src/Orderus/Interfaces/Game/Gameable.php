<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Interfaces\Game;

interface Gameable
{

    public function run();

    public function getTurnAttackOrder();

}