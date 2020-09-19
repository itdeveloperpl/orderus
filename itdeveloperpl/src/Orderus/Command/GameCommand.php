<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */
namespace itdeveloperpl\Orderus\Command;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use itdeveloperpl\Orderus\Model\Game\GameOrderusVsWildBeast;
use itdeveloperpl\Orderus\Interfaces\Game\ModeInterface;

class GameCommand extends Command
{
    protected static $defaultName = 'game:start';

    protected function configure()
    {
        $this->setDescription('Starts Game');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        (new GameOrderusVsWildBeast())
            ->setInputInterface($input)
            ->setOutputInterface($output)
            ->run();


        return 1;
    }
}