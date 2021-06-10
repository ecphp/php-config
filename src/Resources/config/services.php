<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use EcPhp\PhpDirectiveBundle\EventListener\SetPhpDirective;

return static function (ContainerConfigurator $container) {
    $container
        ->services()
        ->set(SetPhpDirective::class)
        ->autowire()
        ->autoconfigure()
        ->tag(
            'kernel.event_listener',
            [
                'event' => 'kernel.request',
                'priority' => 16384,
            ]
        );
};
