<?php

/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */

namespace itdeveloperpl\Orderus\Abstracts;

use itdeveloperpl\Orderus\Interfaces\Player\Playerable;
use itdeveloperpl\Orderus\Interfaces\Turn\Turnable;
use itdeveloperpl\Orderus\Traits\PassGameTrait;

abstract class AbstractTurn implements Turnable
{

    use PassGameTrait;

    protected $striker;
    protected $defender;
    protected $damage;

    public function setPlayers(Playerable $striker, Playerable $defender)
    {
        $this->striker = $striker;
        $this->defender = $defender;
        return $this;
    }

    /**
     * @return \tdeveloperpl\Orderus\Interfaces\Player\Playerable
     */
    public function getDefender()
    {
        return $this->defender;
    }

    /**
     * @return \tdeveloperpl\Orderus\Interfaces\Player\Playerable
     */
    public function getStriker()
    {
        return $this->striker;
    }

    public function getDamage()
    {
        return $this->damage;
    }

    public function setDamage(int $damage)
    {
        $this->damage = $damage;
        return $this;
    }

    /**
     * @return @void
     */
    public function fight(Playerable $striker, Playerable $defender)
    {
        $this->setPlayers($striker, $defender);
        $turn = $this;

        // before strike of $striker
        $striker->skills()->transform(function($skill, $key) use ($striker, $defender, $turn) {
            return $skill->setTurn($turn)->beforeStrike($striker, $defender);
        });

        $this->strike($striker, $defender);

        // after strike of $striker
        $striker->skills()->transform(function($skill, $key) use ($striker, $defender, $turn) {
            return $skill->setTurn($turn)->afterStrike($striker, $defender);
        });

        $this->updateHealthParams($defender);
    }

    protected function updateHealthParams(Playerable $defender)
    {
        $health = $defender->properties()->getProperty('health');
        $newHealth = max(0, ($health->get() - $this->damage));
        if ($this->damage > 0) {
            $health->update($newHealth);
            $this->getGame()->notify(sprintf("<fg=red>%s got hit and looses %d of health</>", $defender->name(), $this->damage));
        }
    }

    /**
     * @return @void
     */
    protected function strike(Playerable $striker, Playerable $defender)
    {

        // check if $defender is lucky. If is then $striker misses hit if not then 
        // reduce $defender health
        $luck = $defender->properties()->getProperty('luck');
        if ($luck && $luck->isLucky()) {
            $this->getGame()->notify(sprintf("%s is lucky and %s misses hit", $defender->name(), $striker->name()));
            return;
        }

        $strength = $striker->properties()->getProperty('strength');
        $defence = $defender->properties()->getProperty('defence');
        $health = $defender->properties()->getProperty('health');

        if ($strength && $defence) {
            $this->damage = max(0, ( $strength->get() - $defence->get()));
        }
    }

}
