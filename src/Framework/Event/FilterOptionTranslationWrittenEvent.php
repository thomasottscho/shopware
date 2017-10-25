<?php declare(strict_types=1);

namespace Shopware\Framework\Event;

use Shopware\Framework\Write\EntityWrittenEvent;

class FilterOptionTranslationWrittenEvent extends EntityWrittenEvent
{
    const NAME = 'filter_option_translation.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getEntityName(): string
    {
        return 'filter_option_translation';
    }
}
