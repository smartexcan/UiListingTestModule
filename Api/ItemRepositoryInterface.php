<?php
declare(strict_types=1);

namespace Author\Example\Api;

/**
 * @api
 */
interface ItemRepositoryInterface
{
    /**
     * @param \Author\Example\Api\Data\ItemInterface $item
     * @return \Author\Example\Api\Data\ItemInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(
        \Author\Example\Api\Data\ItemInterface $item
    ): \Author\Example\Api\Data\ItemInterface;

    /**
     * @param int $itemId
     * @return \Author\Example\Api\Data\ItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($itemId): \Author\Example\Api\Data\ItemInterface;

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Author\Example\Api\Data\ItemSearchResultsInterface
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    ): \Author\Example\Api\Data\ItemSearchResultsInterface;

    /**
     * @param \Author\Example\Api\Data\ItemInterface $item
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Author\Example\Api\Data\ItemInterface $item): bool;

    /**
     * @param int $itemId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($itemId): bool;
}
