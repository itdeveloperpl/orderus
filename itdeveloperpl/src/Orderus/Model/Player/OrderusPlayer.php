<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Model\Player;

use itdeveloperpl\Orderus\Interfaces\Player\Playerable;
use itdeveloperpl\Orderus\Abstracts\AbstractPlayer;
use itdeveloperpl\Orderus\Model\Property\{
    Defence,
    Health,
    Luck,
    Speed,
    Strength
};
use itdeveloperpl\Orderus\Model\Skill\{
    RapidStrike,
    MagicShield
};

class OrderusPlayer extends AbstractPlayer implements Playerable
{

    public function __construct()
    {
        parent::__construct();
        $this->setup();
    }

    /**
     * @return $this
     */
    public function setup()
    {
        $this->properties()->push(
            new Health(rand(70, 100)), new Strength(rand(70, 80)),
            new Defence(rand(45, 55)), new Speed(rand(40, 50)),
            new Luck(rand(10, 30)),
        );
        $this->skills()->push(
            new RapidStrike, new MagicShield
        );


        return $this;
    }
}