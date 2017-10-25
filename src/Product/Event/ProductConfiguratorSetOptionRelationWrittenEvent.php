<?php declare(strict_types=1);

namespace Shopware\Product\Event;

use Shopware\Framework\Write\EntityWrittenEvent;

class ProductConfiguratorSetOptionRelationWrittenEvent extends EntityWrittenEvent
{
    const NAME = 'product_configurator_set_option_relation.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getEntityName(): string
    {
        return 'product_configurator_set_option_relation';
    }
}
