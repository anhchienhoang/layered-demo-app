<?php

namespace DemoApp\Infrastructure\Command;

use DemoApp\Core\Component\User\Model\User;
use DemoApp\Core\Component\User\Model\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    /** @inheritdoc */
    protected function configure()
    {
        $this->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
            ->addArgument('firstName', InputArgument::REQUIRED, 'First Name')
            ->addArgument('lastName', InputArgument::REQUIRED, 'Last Name')
            ->addArgument('email', InputArgument::REQUIRED, 'Email')
            ->addArgument('address', InputArgument::REQUIRED, 'Address')
        ;
    }

    /** @inheritdoc */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($input->getArgument('address'));

        $user = User::create(
            $input->getArgument('firstName'),
            $input->getArgument('lastName'),
            $input->getArgument('email'),
            $input->getArgument('address')
        );

        $id = $this->userRepository->add($user);

        $output->writeln(sprintf('User created successfully with id: %d', $id));
    }
}