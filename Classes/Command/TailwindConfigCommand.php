<?php

declare(strict_types=1);

namespace Jramke\TailwindStyledContent\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Package\PackageManager;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

class TailwindConfigCommand extends Command
{
    protected const DEFAULT_CONFIG_FILE_PATH = './tailwind.config.js';

    protected PackageManager $packageManager;

    public function injectPackageManager(PackageManager $packageManager)
    {
        $this->packageManager = $packageManager;
    }

    protected function configure(): void
    {
        $this
            ->setHelp('Generates a boilerplate tailwind config file')
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Write file even if it already exists')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $configFile = self::DEFAULT_CONFIG_FILE_PATH;

        $configFile = $this->partialRealpath($this->getAbsoluteInputPath($configFile));

        if (!GeneralUtility::isAllowedAbsPath($configFile)) {
            $output->write('Output file is outside of TYPO3 project directory.', true);
            return Command::FAILURE;
        }

        if (file_exists($configFile) && !$input->getOption('force')) {
            $output->write(sprintf('Output file %s already exists. Use --force if you want to overwrite the existing file.', $configFile), true);
            return Command::FAILURE;
        }

        $tailwindConfig = $this->getTemplate();

        $this->writeConfigFile($configFile, $tailwindConfig);
        $output->write(sprintf('Tailwind config has been written to %s.', $configFile), true);

        return Command::SUCCESS;
    }

    protected function prepareEntrypoints(array $entrypoints, string $rootPath): array
    {
        return array_map(function($entrypoint) use ($rootPath) {
            $entrypoint = $this->partialRealpath($this->getAbsoluteInputPath($entrypoint));
            $entrypointRelativeToRoot = PathUtility::getRelativePath($rootPath, PathUtility::dirname($entrypoint));
            return $entrypointRelativeToRoot . PathUtility::basename($entrypoint);
        }, $entrypoints);
    }

    protected function getTemplate(): string
    {
        return file_get_contents(ExtensionManagementUtility::extPath(
            'tailwind_styled_content',
            'Resources/Private/Tailwind/template/defaultTailwindConfig.js'
        ));
    }

    protected function writeConfigFile(string $file, string $content): void
    {
        GeneralUtility::mkdir_deep(PathUtility::dirname($file));
        GeneralUtility::writeFile($file, $content);
    }

    protected function getAbsoluteInputPath(string $path): string
    {
        if (PathUtility::isAbsolutePath($path)) {
            return $path;
        }

        if (PathUtility::isExtensionPath($path)) {
            return $this->packageManager->resolvePackagePath($path);
        }

        return getcwd() . DIRECTORY_SEPARATOR . $path;
    }

    protected function partialRealpath(string $absolutePath): string
    {
        $staticPath = PathUtility::getCanonicalPath($absolutePath);
        $dynamicPath = [];

        do {
            $dynamicPath[] = PathUtility::basename($staticPath);
            $staticPath = PathUtility::dirname($staticPath);
            if ($staticPath === '') {
                return $absolutePath;
            }
        } while (realpath($staticPath) === false);

        $dynamicPath[] = realpath($staticPath);
        return implode(DIRECTORY_SEPARATOR, array_reverse($dynamicPath));
    }
}