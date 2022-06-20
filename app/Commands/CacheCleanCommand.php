<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Classe de comando de cache para excluir todos os arquivos e diretórios da pasta cache.
 */
class CacheCleanCommand extends Command
{
    /**
     * Nome do comando.
     *
     * @var string
     */
    protected static $defaultName = 'cache:clear';

    /**
     * Descrição do comando.
     *
     * @var string
     */
    protected static $defaultDescription = 'Limpar o cache da aplicação.';

    /**
     * Execução do comando.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->removeRecursiveFiles(PATH['cache']);
        $output->writeln('Excluímos o cache da aplicação com sucesso!');
        return Command::SUCCESS;
    }

    /**
     * Remove todos os arquivos e diretórios.
     * 
     * @param string $path
     * @return void
     */
    private function removeRecursiveFiles(string $path)
    {
        $iterator = new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS);

        while ($iterator->valid()) {
            if ($iterator->isDir()) {
                $this->removeRecursiveFiles($iterator->getPathname());
                rmdir($iterator->getPathname());
            } else if ($iterator->isFile()) {
                if ($iterator->getFilename() === '.gitkeep') {
                    $iterator->next();
                    continue;
                }

                unlink($iterator->getPathname());
            }
            $iterator->next();
        }
    }
}
