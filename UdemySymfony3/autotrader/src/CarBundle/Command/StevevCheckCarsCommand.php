<?php

namespace CarBundle\Command;

//use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Command\Command;
use CarBundle\Service\DataChecker;
use Doctrine\ORM\EntityManager; 

//Use to extends ContainerAwareCommand
class StevevCheckCarsCommand extends Command
{
    /** @var DataChecker */
    protected $carChecker;
    /** @var EntityManager */
    protected $manager;

    public function __construct(DataChecker $carChecker, EntityManager $manager){
        $this->carChecker = $carChecker;
        $this->manager = $manager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('stevev:check-cars')
            ->setDescription('First PHP Symfony Console Command Program by Steve Velcev')
            ->addArgument('format', InputArgument::OPTIONAL, 'Progress bar format')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$argument = $input->getArgument('argument');

        if ($input->getOption('option')) {
            // ...
        }

        $output->writeln('Command result.');
        $output->writeln('Something Happened.');
        $output->writeln('Hello World.');

        //$manager = $this->getContainer()->get('doctrine.orm.entity_manager');
        //$dataChecker = $this->getContainer()->get('car.data_checker');
        $carRepository = $this->manager->getRepository('CarBundle:Car');
        $cars = $carRepository->findAll();

        $argument = $input->getArgument('format');

        $bar = new ProgressBar($output, count($cars));
        $bar->setFormat($argument);
        $bar->start();
        foreach ($cars as $car) {
            $output->writeln($car->getId());
            $this->carChecker->checkCar($car);
            sleep(1);
            $bar->advance();
        }
        $bar->finish();
    }

}
