<?php

namespace App\Command;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TicketTerminatedPurgeContactCommand extends Command
{
    const DEFAULT_DELAY = 30;

    protected static $defaultName = 'ailad:ticket:contact-purge';

    /**
     * @var ServiceEntityRepositoryInterface
     */
    private $serviceEntityRepository;

    /**
     * TicketTerminatedPurgeContactCommand constructor.
     * @param ServiceEntityRepositoryInterface $serviceEntityRepository
     */
    public function __construct(ServiceEntityRepositoryInterface $serviceEntityRepository)
    {
        parent::__construct();
        $this->serviceEntityRepository = $serviceEntityRepository;
    }

    protected function configure()
    {
       $this
           ->setDescription('Purge terminated ticket contact after delay')
           ->addOption('delay', null, InputOption::VALUE_REQUIRED, 'delay in days', self::DEFAULT_DELAY);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $delay = (int) $input->getOption('delay');

        $bulk = $this->serviceEntityRepository->bulkUpdateContactTicketCloseAfterDelay($delay);

        if ($bulk > 0){
            $date = date('Y-m-d');
            $output->write(sprintf('[%s] %d ticket\'s contact(s) reinitialized after %d days', $date, $bulk, $delay));
        }

        return $bulk;
    }
}