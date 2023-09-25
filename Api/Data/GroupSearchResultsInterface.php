<?php
declare(strict_types=1);

namespace Author\Example\Api\Data;

/**
 * @api
 */
interface GroupSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return \Author\Example\Api\Data\GroupInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @param \Author\Example\Api\Data\GroupInterface[] $items
     * @return \Author\Example\Api\Data\GroupSearchResultsInterface
     */
    public function setItems(array $items);

}
