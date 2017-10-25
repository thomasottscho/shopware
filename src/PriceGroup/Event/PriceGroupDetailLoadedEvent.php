<?php declare(strict_types=1);

namespace Shopware\PriceGroup\Event;

use Shopware\Context\Struct\TranslationContext;
use Shopware\Framework\Event\NestedEvent;
use Shopware\Framework\Event\NestedEventCollection;
use Shopware\PriceGroup\Struct\PriceGroupDetailCollection;
use Shopware\PriceGroupDiscount\Event\PriceGroupDiscountBasicLoadedEvent;

class PriceGroupDetailLoadedEvent extends NestedEvent
{
    const NAME = 'price_group.detail.loaded';

    /**
     * @var PriceGroupDetailCollection
     */
    protected $priceGroups;

    /**
     * @var TranslationContext
     */
    protected $context;

    public function __construct(PriceGroupDetailCollection $priceGroups, TranslationContext $context)
    {
        $this->priceGroups = $priceGroups;
        $this->context = $context;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getPriceGroups(): PriceGroupDetailCollection
    {
        return $this->priceGroups;
    }

    public function getContext(): TranslationContext
    {
        return $this->context;
    }

    public function getEvents(): ?NestedEventCollection
    {
        $events = [
            new PriceGroupBasicLoadedEvent($this->priceGroups, $this->context),
        ];

        if ($this->priceGroups->getDiscounts()->count() > 0) {
            $events[] = new PriceGroupDiscountBasicLoadedEvent($this->priceGroups->getDiscounts(), $this->context);
        }

        return new NestedEventCollection($events);
    }
}
