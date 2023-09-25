<?php
declare(strict_types=1);

namespace Author\Example\Model\Item;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Author\Example\Api\ItemRepositoryInterface;
use Author\Example\Api\Data\ItemInterface;
use Author\Example\Api\Data\ItemInterfaceFactory;
use Author\Example\Api\Data\ItemSearchResultsInterface;
use Author\Example\Api\Data\ItemSearchResultsInterfaceFactory;
use Author\Example\Model\ResourceModel\Item as Resource;
use Author\Example\Model\ResourceModel\Item\CollectionFactory;

/**
 * @api
 */
class Repository implements ItemRepositoryInterface
{
    /**
     * @var Resource
     */
    protected $resource;

    /**
     * @var ItemInterfaceFactory
     */
    protected $itemFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ItemSearchResultsInterfaceFactory
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
     * @param ItemInterfaceFactory $itemFactory
     * @param CollectionFactory $collectionFactory
     * @param ItemSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct(
        Resource $resource,
        ItemInterfaceFactory $itemFactory,
        CollectionFactory $collectionFactory,
        ItemSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->resource = $resource;
        $this->itemFactory = $itemFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save(ItemInterface $item): ItemInterface
    {
        try {
            $this->resource->save($item);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the item'), $exception);
        }
        return $item;
    }

    /**
     * @inheritdoc
     */
    public function get($itemId): ItemInterface
    {
        $item = $this->itemFactory->create();
        $this->resource->load($item, $itemId);
        if (!$item->getId()) {
            throw new NoSuchEntityException(__('Item with id "%1" does not exist', $itemId));
        }
        return $item;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ItemSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            ItemInterface::class
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
    public function delete(ItemInterface $item): bool
    {
        try {
            $this->resource->delete($item);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('Could not delete the item'), $exception);
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($itemId): bool
    {
        return $this->delete($this->get($itemId));
    }
}
