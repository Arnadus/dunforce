<?php

namespace App\Command;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListAuthorsCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'list-authors';

    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('List Authors')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $authors = $this->authorRepository->findAll();


        foreach($authors as $author){
            $io->writeln($author->getFirstname() . ' ' . $author->getLastName());
        }
        $io->success('Authors listed successfully.');
    }
}
