<?php
declare(strict_types=1);

namespace Author\Example\Api\Data;

/**
 * @api
 */
interface ItemInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const ITEM_ID = 'item_id';
    const GROUP_ID = 'group_id';
    const NAME = 'name';
    const STATUS = 'status';

    /**
     * @return int
     */
    public function getItemId();

    /**
     * @param int $itemId
     * @return \Author\Example\Api\Data\ItemInterface
     */
    public function setItemId($itemId);

    /**
     * @return int
     */
    public function getGroupId();

    /**
     * @param int $groupId
     * @return \Author\Example\Api\Data\ItemInterface
     */
    public function setGroupId($groupId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return \Author\Example\Api\Data\ItemInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $status
     * @return \Author\Example\Api\Data\ItemInterface
     */
    public function setStatus($status);

    /**
     * @return \Author\Example\Api\Data\ItemExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param \Author\Example\Api\Data\ItemExtensionInterface $extensionAttributes
     * @return \Author\Example\Api\Data\ItemInterface
     */
    public function setExtensionAttributes(
        \Author\Example\Api\Data\ItemExtensionInterface $extensionAttributes
    );
}
