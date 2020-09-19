<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Collection;

use Illuminate\Support\Collection;
use Exception;

class SkillCollection extends Collection
{

    public function push(...$values)
    {
        foreach ($values as $value) {
            if (false === $value instanceof \itdeveloperpl\Orderus\Interfaces\Skill\Skillable) {
                throw new Exception(get_class($value) . " is not instance of " . \itdeveloperpl\Orderus\Interfaces\Skill\Skillable::class);
            }

            /**
             * @todo verify if already exists in collection property of this class (example RapidStrike)
             * If exists then replace or throw exception
             */
            $this->items[] = $value;
        }
        return $this;
    }

    /**
     * @param string $skill
     * @return \itdeveloperpl\Orderus\Interfaces\Skill\Skillable
     */
    public function getSkill($skill)
    {
        $className = 'itdeveloperpl\Orderus\Model\Skill\\' . ucfirst($skill);
        foreach ($this->items as $item) {
            if (get_class($item) == $className) {
                return $item;
            }
        }
    }

}
