<?php
declare(strict_types=1);

namespace Author\Example\Ui\Component\Form\Element\Source;

use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;
use Author\Example\Api\GroupRepositoryInterface;
use Author\Example\Api\Data\GroupInterface;

class Group implements OptionSourceInterface
{
    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var GroupRepositoryInterface
     */
    private $groupRepository;

    /**
     * @var array
     */
    protected $_options;

    /**
     * @param SortOrderBuilder $sortOrderBuilder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param GroupRepositoryInterface $groupRepository
     */
    public function __construct(
        SortOrderBuilder $sortOrderBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        GroupRepositoryInterface $groupRepository
    ) {
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        if ($this->_options === null) {
            $sortOrder = $this->sortOrderBuilder
                ->setField(GroupInterface::NAME)
                ->setAscendingDirection()
                ->create();
            $searchCriteria = $this->searchCriteriaBuilder
                ->addSortOrder($sortOrder)
                ->create();

            $items = $this->groupRepository->getList($searchCriteria)->getItems();

            $options = [];
            foreach ($items as $group) {
                $options[] = [
                    'value' => $group->getId(),
                    'label' => $group->getName()
                ];
            }
            $this->_options = $options;
        }

        return $this->_options;
    }
}
