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

class WildBeastPlayer extends AbstractPlayer implements Playerable
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
            new Health(rand(60, 90)), new Strength(rand(60, 90)),
            new Defence(rand(40, 60)), new Speed(rand(40, 60)),
            new Luck(rand(25, 40)),
        );

        return $this;
    }
}