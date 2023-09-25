<?php
declare(strict_types=1);

namespace Author\Example\Console\Command;

use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LoggerInterface;
use Author\Example\Model\AddExampleData;

class Deploy extends Command
{
    /**
     * @var AddExampleData
     */
    protected $addExampleData;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param AddExampleData $addExampleData
     * @param LoggerInterface $logger
     */
    public function __construct(
        AddExampleData $addExampleData,
        LoggerInterface $logger
    ) {
        $this->addExampleData = $addExampleData;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('authorexample:deploy');
        $this->setDescription('Add testing data for Author Example');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->addExampleData->execute();
            $output->writeln('<info>Example data deployed.</info>');
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $output->writeln('<info>Error deploying example data.</info>');
            $output->writeln("<error>{$e->getMessage()}</error>");
            return Cli::RETURN_FAILURE;
        }

        return Cli::RETURN_SUCCESS;
    }
}
