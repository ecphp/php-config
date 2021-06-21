<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\PhpDirectiveBundle\Tests\Fixtures\App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @internal
 * @coversNothing
 */
final class Test
{
    /**
     * @Route("/{directive}")
     */
    public function __invoke(string $directive): Response
    {
        return new Response(
            sprintf(
                '%s: %s',
                $directive,
                ini_get($directive)
            )
        );
    }
}
