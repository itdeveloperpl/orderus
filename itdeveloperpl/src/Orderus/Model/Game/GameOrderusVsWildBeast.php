<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Model\Game;

use Symfony\Component\Console\Style\SymfonyStyle;
use itdeveloperpl\Orderus\Interfaces\Game\Gameable;
use itdeveloperpl\Orderus\Abstracts\AbstractGameModeCLI;
use itdeveloperpl\Orderus\Model\{
    Player\OrderusPlayer,
    Player\WildBeastPlayer,
    Turn\DefaultTurn
};

class GameOrderusVsWildBeast extends AbstractGameModeCLI implements Gameable
{

    public function __construct()
    {
        parent::__construct();
        $this->setPlayer1(new OrderusPlayer())
                ->setPlayer2(new WildBeastPlayer())
                ->setTurnClass(DefaultTurn::class)
                ->setTurnTotal(20);
    }

    public function run()
    {
        $this->output->write(sprintf("\033\143"));
        $io = new SymfonyStyle($this->input, $this->output);

        $io->title('Welcome to evergreen forests of Emagia');

        $io->table(
                ['Property', $this->getPlayer1()->name(), $this->getPlayer2()->name()],
                [
                    ['Health', $this->getPlayer1()->properties()->getProperty('health')->get(), $this->getPlayer2()->properties()->getProperty('health')->get()],
                    ['Defence', $this->getPlayer1()->properties()->getProperty('defence')->get(), $this->getPlayer2()->properties()->getProperty('defence')->get()],
                    ['Speed', $this->getPlayer1()->properties()->getProperty('speed')->get(), $this->getPlayer2()->properties()->getProperty('speed')->get()],
                    ['Strength', $this->getPlayer1()->properties()->getProperty('strength')->get(), $this->getPlayer2()->properties()->getProperty('strength')->get()],
                    ['Luck', $this->getPlayer1()->properties()->getProperty('luck')->get(), $this->getPlayer2()->properties()->getProperty('luck')->get()],
                ]
        );
        $io->confirm('Are you ready?', true);
        parent::run();
    }

}
