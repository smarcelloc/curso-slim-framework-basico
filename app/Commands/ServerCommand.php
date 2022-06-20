<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Classe de comando de servidor para inicializar a aplicação localmente.
 */
class ServerCommand extends Command
{
    /**
     * Nome do comando.
     *
     * @var string
     */
    protected static $defaultName = 'server';

    /**
     * Descrição do comando.
     *
     * @var string
     */
    protected static $defaultDescription = 'Inicializar a aplicação localmente.';

    /**
     * Execução do comando.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $host = $input->getArgument('host') ?? 'localhost:8080';
        $output->writeln("Executando em ${host}");
        $output->writeln('Pressione Ctrl-C para sair...');
        exec("php -S ${host} -t " . PATH['public']);

        return Command::SUCCESS;
    }

    /**
     * Configuração do comando.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('host', InputArgument::OPTIONAL, 'Host do servidor');
        $this->addUsage('server localhost:8080');
        $this->addUsage('server 0.0.0.0:8080');
    }
}
