<?php
declare(strict_types=1);

namespace Author\Example\Api\Data;

/**
 * @api
 */
interface GroupInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const GROUP_ID = 'group_id';
    const NAME = 'name';

    /**
     * @return int
     */
    public function getGroupId();

    /**
     * @param int $groupId
     * @return \Author\Example\Api\Data\GroupInterface
     */
    public function setGroupId($groupId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param int $name
     * @return \Author\Example\Api\Data\ItemInterface
     */
    public function setName($name);

    /**
     * @return \Author\Example\Api\Data\GroupExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param \Author\Example\Api\Data\GroupExtensionInterface $extensionAttributes
     * @return \Author\Example\Api\Data\GroupInterface
     */
    public function setExtensionAttributes(
        \Author\Example\Api\Data\GroupExtensionInterface $extensionAttributes
    );
}
