<?php declare(strict_types=1);

namespace Shopware\Framework\Event;

use Shopware\Framework\Write\EntityWrittenEvent;

class CoreSessionsBackendWrittenEvent extends EntityWrittenEvent
{
    const NAME = 's_core_sessions_backend.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getEntityName(): string
    {
        return 's_core_sessions_backend';
    }
}
