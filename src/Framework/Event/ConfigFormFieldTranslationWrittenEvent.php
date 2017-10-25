<?php declare(strict_types=1);

namespace Shopware\Framework\Event;

use Shopware\Framework\Write\EntityWrittenEvent;

class ConfigFormFieldTranslationWrittenEvent extends EntityWrittenEvent
{
    const NAME = 'config_form_field_translation.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getEntityName(): string
    {
        return 'config_form_field_translation';
    }
}
