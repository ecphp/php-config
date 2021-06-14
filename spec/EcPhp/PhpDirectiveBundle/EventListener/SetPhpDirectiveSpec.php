<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\PhpDirectiveBundle\EventListener;

use InvalidArgumentException;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use function dirname;

final class SetPhpDirectiveSpec extends ObjectBehavior
{
    public function it_set_php_directives(ParameterBagInterface $parameterBag, LoggerInterface $logger, KernelInterface $kernel, RequestEvent $event): void
    {
        $kernel
            ->getProjectDir()
            ->willReturn(dirname(__DIR__, 4) . '/fixtures');

        $parameterBag
            ->get('php_directive')
            ->willReturn(
                [
                    'user_ini_file' => 'user-memory-limit.ini',
                ]
            );

        $this->beConstructedWith($parameterBag, $logger, $kernel);

        $memoryLimit = ini_get('memory_limit');

        $this
            ->__invoke($event);

        if ('1234M' !== $size = ini_get('memory_limit')) {
            throw new FailureException('Invalid size: ' . $size);
        }

        ini_set('memory_limit', $memoryLimit);
    }

    public function it_throws_an_exception_is_the_ini_file_is_not_found_or_readable(ParameterBagInterface $parameterBag, LoggerInterface $logger, KernelInterface $kernel, RequestEvent $event): void
    {
        $kernel
            ->getProjectDir()
            ->willReturn(dirname(__DIR__, 4) . '/fixtures/not-existing-path');

        $parameterBag
            ->get('php_directive')
            ->willReturn(
                [
                    'user_ini_file' => 'user.ini',
                ]
            );

        $this->beConstructedWith($parameterBag, $logger, $kernel);

        $this
            ->shouldThrow(InvalidArgumentException::class)
            ->during('__invoke', [$event]);
    }

    public function it_throws_an_exception_is_the_ini_file_is_not_parseable(): void
    {
        throw new SkippingException(
            'Unable to find a test where parse_ini_file() returns false.'
        );
    }

    public function it_throws_an_exception_is_the_ini_file_is_valid(ParameterBagInterface $parameterBag, LoggerInterface $logger, KernelInterface $kernel, RequestEvent $event): void
    {
        $kernel
            ->getProjectDir()
            ->willReturn(dirname(__DIR__, 4) . '/fixtures');

        $parameterBag
            ->get('php_directive')
            ->willReturn(
                [
                    'user_ini_file' => 'user-invalid.ini',
                ]
            );

        $this->beConstructedWith($parameterBag, $logger, $kernel);

        $this
            ->shouldThrow(InvalidArgumentException::class)
            ->during('__invoke', [$event]);
    }
}
