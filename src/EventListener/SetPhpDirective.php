<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\PhpDirectiveBundle\EventListener;

use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Throwable;

use const DIRECTORY_SEPARATOR;

final class SetPhpDirective
{
    private KernelInterface $kernel;

    private LoggerInterface $logger;

    private ParameterBagInterface $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag, LoggerInterface $logger, KernelInterface $kernel)
    {
        $this->parameterBag = $parameterBag;
        $this->logger = $logger;
        $this->kernel = $kernel;
    }

    public function __invoke(RequestEvent $event): void
    {
        $iniFile = $this->kernel->getProjectDir() .
        DIRECTORY_SEPARATOR .
        $this->parameterBag->get('php_directive')['user_ini_file'];

        $realIniFile = realpath($iniFile);

        if (false === $realIniFile) {
            throw new InvalidArgumentException('Unable to find ini file: ' . $iniFile);
        }

        try {
            $parsedIniFile = parse_ini_file($realIniFile);
        } catch (Throwable $e) {
            throw new InvalidArgumentException(
                sprintf(
                    'Unable to parse ini file at %s.',
                    $realIniFile
                )
            );
        }

        var_dump($parsedIniFile);

        if (false === $parsedIniFile) {
            throw new InvalidArgumentException(
                sprintf(
                    'Unable to parse ini file at %s.',
                    $realIniFile
                )
            );
        }

        foreach ($parsedIniFile as $key => $value) {
            $return = ini_set($key, $value);

            if (false === $return) {
                $this
                    ->logger
                    ->error(
                        sprintf(
                            'Unable to update PHP property "%s", skipping.',
                            $key
                        )
                    );

                continue;
            }

            $this
                ->logger
                ->debug(
                    sprintf(
                        'PHP property %s updated from %s to %s.',
                        $key,
                        $return,
                        $value
                    )
                );
        }
    }
}
