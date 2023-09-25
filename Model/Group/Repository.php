<?php
declare(strict_types=1);

namespace Author\Example\Model\Group;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Author\Example\Api\GroupRepositoryInterface;
use Author\Example\Api\Data\GroupInterface;
use Author\Example\Api\Data\GroupInterfaceFactory;
use Author\Example\Api\Data\GroupSearchResultsInterface;
use Author\Example\Api\Data\GroupSearchResultsInterfaceFactory;
use Author\Example\Model\ResourceModel\Group as Resource;
use Author\Example\Model\ResourceModel\Group\CollectionFactory;

/**
 * @api
 */
class Repository implements GroupRepositoryInterface
{
    /**
     * @var Resource
     */
    protected $resource;

    /**
     * @var GroupInterfaceFactory
     */
    protected $groupFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var GroupSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @param Resource $resource
     * @param GroupInterfaceFactory $groupFactory
     * @param CollectionFactory $collectionFactory
     * @param GroupSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct(
        Resource $resource,
        GroupInterfaceFactory $groupFactory,
        CollectionFactory $collectionFactory,
        GroupSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->resource = $resource;
        $this->groupFactory = $groupFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save(GroupInterface $group): GroupInterface
    {
        try {
            $this->resource->save($group);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the group'), $exception);
        }
        return $group;
    }

    /**
     * @inheritdoc
     */
    public function get($groupId): GroupInterface
    {
        $group = $this->groupFactory->create();
        $this->resource->load($group, $groupId);
        if (!$group->getId()) {
            throw new NoSuchEntityException(__('Group with id "%1" does not exist', $groupId));
        }
        return $group;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): GroupSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            GroupInterface::class
        );

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritdoc
     */
    public function delete(GroupInterface $group): bool
    {
        try {
            $this->resource->delete($group);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('Could not delete the group'), $exception);
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($groupId): bool
    {
        return $this->delete($this->get($groupId));
    }
}
