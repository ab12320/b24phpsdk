<?php

/**
 * This file is part of the bitrix24-php-sdk package.
 *
 * © Maksim Mesilov <mesilov.maxim@gmail.com>
 *
 * For the full copyright and license information, please view the MIT-LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bitrix24\SDK\Application\Requests\Events;


use Bitrix24\SDK\Application\Requests\Events\OnApplicationInstall\OnApplicationInstall;
use Bitrix24\SDK\Application\Requests\Events\OnApplicationUninstall\OnApplicationUninstall;
use Bitrix24\SDK\Core\Exceptions\InvalidArgumentException;

use Symfony\Component\HttpFoundation\Request;

readonly class ApplicationLifeCycleEventsFabric
{
    /**
     * @throws InvalidArgumentException
     */
    public function create(Request $request): ?EventInterface
    {
        $eventPayload = $request->request->all();
        if (!array_key_exists('event', $eventPayload)) {
            throw new InvalidArgumentException('«event» key not found in event payload');
        }

        return match ($eventPayload['event']) {
            OnApplicationInstall::CODE => new OnApplicationInstall($request),
            OnApplicationUninstall::CODE => new OnApplicationUninstall($request),
            default => null,
        };
    }
}