<?php declare(strict_types=1);

namespace Shopware\Administration\Extension;

use Shopware\Framework\Read\ExtensionInterface;
use Shopware\Framework\Read\ExtensionRegistry;
use Shopware\Framework\Read\ExtensionRegistryInterface;

class AdministrationExtensionRegistry implements ExtensionRegistryInterface
{
    /**
     * @var array[]
     */
    private $extensions;

    /**
     * @var ExtensionRegistry
     */
    private $registry;

    public function __construct(array $extensions, ExtensionRegistry $registry)
    {
        $this->extensions = $extensions;
        $this->registry = $registry;
    }

    /**
     * @param string $bundle
     *
     * @return ExtensionInterface[]
     */
    public function getExtensions(string $bundle): array
    {
        $extensions = [];
        if (array_key_exists($bundle, $this->extensions)) {
            $extensions = $this->extensions[$bundle];
        }

        return array_merge($extensions, $this->registry->getExtensions($bundle));
    }
}
