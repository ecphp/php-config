<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace spec\EcPhp\PhpDirectiveBundle\DependencyInjection;

use EcPhp\PhpDirectiveBundle\DependencyInjection\PhpDirectiveExtension;
use EcPhp\PhpDirectiveBundle\EventListener\SetPhpDirective;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class PhpDirectiveExtensionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PhpDirectiveExtension::class);
    }

    public function it_load_the_Symfony_extension(ContainerBuilder $containerBuilder)
    {
        $containerBuilder
            ->setParameter(
                'php_directive',
                ['user_ini_file' => '%env(resolve:USER_INI_FILE)%']
            )
            ->shouldBeCalled();

        $containerBuilder
            ->setDefinition(
                SetPhpDirective::class,
                Argument::type(Definition::class)
            )
            ->shouldBeCalled();

        $containerBuilder
            ->removeBindings(
                SetPhpDirective::class
            )
            ->shouldBeCalled();

        $containerBuilder
            ->fileExists(Argument::any())
            ->willReturn(true);

        $this
            ->load([], $containerBuilder);
    }
}
