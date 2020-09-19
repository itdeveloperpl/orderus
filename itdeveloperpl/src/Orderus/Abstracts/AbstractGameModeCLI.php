<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 *
 * This abstract class was created to run game in command line
 */

namespace itdeveloperpl\Orderus\Abstracts;

use itdeveloperpl\Orderus\Abstracts\AbstractGame;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractGameModeCLI extends AbstractGame
{
    protected $input;
    protected $output;

    public function setInputInterface(InputInterface $input)
    {
        $this->input = $input;
        return $this;
    }

    public function setOutputInterface(OutputInterface $output)
    {
        $this->output = $output;
        return $this;
    }
    /**
     * @return void
     */
    public function notify($message)
    {
        $this->output->writeln($message);
    }
}