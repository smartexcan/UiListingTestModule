<?php
declare(strict_types=1);

namespace Author\Example\Model\ResourceModel;

use Author\Example\Api\Data\ItemInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Item extends AbstractDb
{
    const TABLE_NAME = 'example_item';

    /**
     * @inheritdoc
     */
    public function _construct()
    {
        $this->_init(self::TABLE_NAME, ItemInterface::ITEM_ID);
    }
}
