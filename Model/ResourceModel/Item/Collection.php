<?php
declare(strict_types=1);

namespace Author\Example\Model\ResourceModel\Item;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(
            \Author\Example\Model\Item::class,
            \Author\Example\Model\ResourceModel\Item::class
        );
    }
}
