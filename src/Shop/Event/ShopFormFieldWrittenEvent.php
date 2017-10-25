<?php declare(strict_types=1);

namespace Shopware\Shop\Event;

use Shopware\Framework\Write\EntityWrittenEvent;

class ShopFormFieldWrittenEvent extends EntityWrittenEvent
{
    const NAME = 'shop_form_field.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getEntityName(): string
    {
        return 'shop_form_field';
    }
}
