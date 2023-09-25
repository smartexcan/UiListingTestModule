<?php
declare(strict_types=1);

namespace Author\Example\Api;

/**
 * @api
 */
interface GroupRepositoryInterface
{
    /**
     * @param \Author\Example\Api\Data\GroupInterface $group
     * @return \Author\Example\Api\Data\GroupInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(
        \Author\Example\Api\Data\GroupInterface $group
    ): \Author\Example\Api\Data\GroupInterface;

    /**
     * @param int $groupId
     * @return \Author\Example\Api\Data\GroupInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($groupId): \Author\Example\Api\Data\GroupInterface;

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Author\Example\Api\Data\GroupSearchResultsInterface
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    ): \Author\Example\Api\Data\GroupSearchResultsInterface;

    /**
     * @param \Author\Example\Api\Data\GroupInterface $group
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Author\Example\Api\Data\GroupInterface $group): bool;

    /**
     * @param int $groupId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($groupId): bool;
}
