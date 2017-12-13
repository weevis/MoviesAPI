<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Entity\User;

class AppCreateUserCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'app:create-user';

    protected function configure()
    {
        $this
            ->setDescription('Create A User')
            ->addArgument('username', InputArgument::REQUIRED, 'User Username')
						->addArgument('email', InputArgument::REQUIRED, 'User Email')
						->addArgument('password', InputArgument::REQUIRED, 'User Password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
				$email = $input->getArgument('email');
				$password = password_hash($input->getArgument('password'), PASSWORD_DEFAULT);
				$api_token = bin2hex(random_bytes(15));
				$doctrine = $this->getContainer()->get('doctrine');
				$em = $doctrine->getEntityManager();
				$user = new User();
				$user->setName($username);
				$user->setEmail($email);
				$user->setPassword($password);
				$user->setAPIToken($api_token);
				$em->persist($user);
				$em->flush();
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
