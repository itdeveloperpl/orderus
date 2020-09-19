<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Abstracts;

use itdeveloperpl\Orderus\Interfaces\Game\ModeInterface;
use itdeveloperpl\Orderus\Interfaces\Player\Playerable;
use Illuminate\Support\Collection;

abstract class AbstractGame implements ModeInterface
{

    private $player1;
    private $player2;
    private $turns;
    private $turnClass;
    private $turnTotal;

    public function __construct()
    {
        $this->turns = new Collection();
    }

    public function setPlayer1(Playerable $player)
    {
        $this->player1 = $player;
        return $this;
    }

    public function setPlayer2(Playerable $player)
    {
        $this->player2 = $player;
        return $this;
    }

    public function setTurnClass($class)
    {
        $this->turnClass = $class;
        return $this;
    }

    public function setTurnTotal(int $total)
    {
        $this->turnTotal = $total;
        return $this;
    }

    /**
     * @return string
     */
    public function getTurnClass()
    {
        return $this->turnClass;
    }

    /**
     * @return int
     */
    public function getTurnTotal()
    {
        return $this->turnTotal;
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return [$this->player1, $this->player2];
    }

    /**
     * @return \itdeveloperpl\Orderus\Interfaces\Player\Playerable
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * @return \itdeveloperpl\Orderus\Interfaces\Player\Playerable
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function turns()
    {
        return $this->turns;
    }

    /**
     * @return array
     */
    public function getTurnAttackOrder()
    {
        $order = [];
        if ($this->turns()->count() === 0) {
            $order = $this->getTurn1AttackOrder();
        } else {
            $lastTurn = $this->turns()->last();
            return [
                $lastTurn->getDefender(),
                $lastTurn->getStriker()
            ];
        }
        return $order;
    }

    /**
     * Returns owner of first turn
     * @return array
     */
    protected function getTurn1AttackOrder()
    {
        $order = [];
        $speedComparise = $this->getPlayer1()->properties()->getProperty('speed') <=> $this->getPlayer2()->properties()->getProperty('speed');

        switch ($speedComparise) {
            /**
             * If both players have same speed then compare luck
             */
            case 0:
                $luckComparise = $this->getPlayer1()->properties()->getProperty('luck') <=> $this->getPlayer2()->properties()->getProperty('luck');
                $order = $luckComparise >= 0 ? [$this->getPlayer1(), $this->getPlayer2()] : [$this->getPlayer2(), $this->getPlayer1()];
                break;
            /**
             * If Player2 is fastest
             */
            case -1:
                $order = [$this->getPlayer2(), $this->getPlayer1()];
                break;
            /**
             * If Player1 is fastest
             */
            case 1:
                $order = [$this->getPlayer1(), $this->getPlayer2()];
        }
        return $order;
    }

    /**
     * @return void
     */
    public function run()
    {
        $turnClass = $this->getTurnClass();


        for ($i = $this->turns()->count(); $i < $this->getTurnTotal(); $i++) {

            $players = $this->getTurnAttackOrder();
            /* @var $turn \itdeveloperpl\Orderus\Abstracts\AbstractTurn */
            $turn = (new $turnClass)->setGame($this);
            $this->notify(sprintf("%s properties: %s",
                            $players[0]->name(),
                            $players[0]->properties()->map(function($item) {
                                return (string) $item;
                            })->implode(', ')
            ));
            $this->notify(sprintf("%s properties: %s",
                            $players[1]->name(),
                            $players[1]->properties()->map(function($item) {
                                return (string) $item;
                            })->implode(', ')
            ));
            $this->notify(sprintf("<fg=green>Turn %d. Strikes: %s</>", $i + 1,
                            $players[0]->name()));

            $turn->fight($players[0], $players[1]);

            // if one of player died in this turn then brak loop
            if (false === $players[0]->alive() || false === $players[1]->alive()) {
                break;
            }




            $this->turns()->push($turn);
        }

        $this->endGame();
    }

    /**
     * @return void
     */
    protected function endGameByDie(Playerable $player)
    {
        $this->notify(sprintf("%s dies on turn : %d",
                        $player->name(),
                        $this->turns()->count()
        ));
    }

    /**
     * @return void
     */
    protected function endGameWithNoDeath()
    {
        $this->notify("Game finishes without died players");
    }

    /**
     * @return void
     */
    protected function endGame()
    {
        $players = $this->getPlayers();
        if (false === $players[0]->alive()) {
            $this->endGameByDie($players[0]);
        } elseif (false === $players[1]->alive()) {
            $this->endGameByDie($players[1]);
        } else {
            $this->endGameWithNoDeath();
        }
    }

}
