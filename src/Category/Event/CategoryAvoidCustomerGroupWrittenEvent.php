<?php declare(strict_types=1);

namespace Shopware\Category\Event;

use Shopware\Framework\Write\EntityWrittenEvent;

class CategoryAvoidCustomerGroupWrittenEvent extends EntityWrittenEvent
{
    const NAME = 'category_avoid_customer_group.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getEntityName(): string
    {
        return 'category_avoid_customer_group';
    }
}
