<?php
declare(strict_types=1);

namespace Author\Example\Model\ResourceModel;

use Author\Example\Api\Data\GroupInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Group extends AbstractDb
{
    const TABLE_NAME = 'example_group';

    /**
     * @inheritdoc
     */
    public function _construct()
    {
        $this->_init(self::TABLE_NAME, GroupInterface::GROUP_ID);
    }
}
