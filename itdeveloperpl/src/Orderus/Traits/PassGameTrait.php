<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Traits;

use itdeveloperpl\Orderus\Interfaces\Game\Gameable;

trait PassGameTrait
{

    protected $game;

    public function setGame(Gameable $game)
    {
        $this->game = $game;
        return $this;
    }
    
    /**
     * @return \itdeveloperpl\Orderus\Interfaces\Game\Gameable
     */
    public function getGame()
    {
        return $this->game;
    }

}
