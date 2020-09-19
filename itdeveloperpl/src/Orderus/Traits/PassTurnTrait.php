<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Traits;

use itdeveloperpl\Orderus\Interfaces\Turn\Turnable;

trait PassTurnTrait
{

    protected $turn;

    public function setTurn(Turnable $turn)
    {
        $this->turn = $turn;
        return $this;
    }
    
    /**
     * @return itdeveloperpl\Orderus\Interfaces\Turn\Turnable;
     */
    public function getTurn()
    {
        return $this->turn;
    }

}
