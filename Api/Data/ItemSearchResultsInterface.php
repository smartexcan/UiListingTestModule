<?php
declare(strict_types=1);

namespace Author\Example\Api\Data;

/**
 * @api
 */
interface ItemSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return \Author\Example\Api\Data\ItemInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @param \Author\Example\Api\Data\ItemInterface[] $items
     * @return \Author\Example\Api\Data\ItemSearchResultsInterface
     */
    public function setItems(array $items);

}
