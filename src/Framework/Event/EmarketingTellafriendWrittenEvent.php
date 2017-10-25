<?php declare(strict_types=1);

namespace Shopware\Framework\Event;

use Shopware\Framework\Write\EntityWrittenEvent;

class EmarketingTellafriendWrittenEvent extends EntityWrittenEvent
{
    const NAME = 's_emarketing_tellafriend.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getEntityName(): string
    {
        return 's_emarketing_tellafriend';
    }
}
