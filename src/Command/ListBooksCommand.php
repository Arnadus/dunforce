<?php

namespace App\Command;

use App\Repository\BookRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListBooksCommand extends Command
{
    protected static $defaultName = 'list-books';

    /**
     * @var AuthorRepository
     */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('List Books')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $books = $this->bookRepository->findAll();

        foreach ($books as $book){
            $io->writeln($book->getTitle());
        }
        $io->success('Books listed successfully.');
    }
}
