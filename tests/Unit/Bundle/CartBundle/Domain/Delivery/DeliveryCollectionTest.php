<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Tests\Unit\Bundle\CartBundle\Domain\Delivery;

use Shopware\Bundle\CartBundle\Domain\Customer\Address;
use Shopware\Bundle\CartBundle\Domain\Delivery\Delivery;
use Shopware\Bundle\CartBundle\Domain\Delivery\DeliveryCollection;
use Shopware\Bundle\CartBundle\Domain\Delivery\DeliveryDate;
use Shopware\Bundle\CartBundle\Domain\Delivery\DeliveryPositionCollection;
use Shopware\Bundle\CartBundle\Domain\Delivery\DeliveryService;

class DeliveryCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testCollectionIsCountable()
    {
        $collection = new DeliveryCollection();
        static::assertCount(0, $collection);
        static::assertSame(0, $collection->count());
    }

    public function testAddFunctionAddsANewDelivery()
    {
        $collection = new DeliveryCollection();
        $collection->add(
            new Delivery(
                new DeliveryPositionCollection(),
                new DeliveryDate(
                    new \DateTime(),
                    new \DateTime()
                ),
                new DeliveryService(),
                new Address()
            )
        );
        static::assertCount(1, $collection);
    }

    public function testCollectionCanBeFilledByConstructor()
    {
        $collection = new DeliveryCollection([
            new Delivery(
                new DeliveryPositionCollection(),
                new DeliveryDate(
                    new \DateTime(),
                    new \DateTime()
                ),
                new DeliveryService(),
                new Address()
            ),
            new Delivery(
                new DeliveryPositionCollection(),
                new DeliveryDate(
                    new \DateTime(),
                    new \DateTime()
                ),
                new DeliveryService(),
                new Address()
            ),
        ]);
        static::assertCount(2, $collection);
    }

    public function testCollectionCanBeCleared()
    {
        $collection = new DeliveryCollection([
            new Delivery(
                new DeliveryPositionCollection(),
                new DeliveryDate(
                    new \DateTime(),
                    new \DateTime()
                ),
                new DeliveryService(),
                new Address()
            ),
            new Delivery(
                new DeliveryPositionCollection(),
                new DeliveryDate(
                    new \DateTime(),
                    new \DateTime()
                ),
                new DeliveryService(),
                new Address()
            ),
        ]);
        $collection->clear();
        static::assertCount(0, $collection);
    }
}
