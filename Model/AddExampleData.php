<?php
/**
 * Copyright © Smartex Canada All rights reserved.
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Author\Example\Model;

use Author\Example\Api\GroupRepositoryInterface;
use Author\Example\Api\ItemRepositoryInterface;
use Author\Example\Api\Data\GroupInterface;
use Author\Example\Api\Data\GroupInterfaceFactory;
use Author\Example\Api\Data\ItemInterface;
use Author\Example\Api\Data\ItemInterfaceFactory;

class AddExampleData
{
    /**
     * @var GroupInterfaceFactory
     */
    protected $groupFactory;

    /**
     * @var ItemInterfaceFactory
     */
    protected $itemFactory;

    /**
     * @var GroupRepositoryInterface
     */
    protected $groupRepository;

    /**
     * @var ItemRepositoryInterface
     */
    protected $itemRepository;

    /**
     * @param GroupInterfaceFactory $groupFactory
     * @param ItemInterfaceFactory $itemFactory
     * @param GroupRepositoryInterface $groupRepository
     * @param ItemRepositoryInterface $itemRepository
     */
    public function __construct(
        GroupInterfaceFactory $groupFactory,
        ItemInterfaceFactory $itemFactory,
        GroupRepositoryInterface $groupRepository,
        ItemRepositoryInterface $itemRepository
    ) {
        $this->groupFactory = $groupFactory;
        $this->itemFactory = $itemFactory;
        $this->groupRepository = $groupRepository;
        $this->itemRepository = $itemRepository;
    }

    /**
     * Add example data to database
     *
     * @return void
     */
    public function execute(): void
    {
        $groups = [
            [
                GroupInterface::GROUP_ID => 1,
                GroupInterface::NAME => 'Group 1'
            ], [
                GroupInterface::GROUP_ID => 2,
                GroupInterface::NAME => 'Group 2'
            ], [
                GroupInterface::GROUP_ID => 3,
                GroupInterface::NAME => 'Group 3'
            ]
        ];

        $items = [
            [
                ItemInterface::GROUP_ID => 1,
                ItemInterface::NAME => 'Item 1',
                ItemInterface::STATUS => 'new'
            ], [
                ItemInterface::GROUP_ID => 1,
                ItemInterface::NAME => 'Item 2',
                ItemInterface::STATUS => 'new'
            ], [
                ItemInterface::GROUP_ID => 1,
                ItemInterface::NAME => 'Item 3',
                ItemInterface::STATUS => 'started'
            ], [
                ItemInterface::GROUP_ID => 2,
                ItemInterface::NAME => 'Item 4',
                ItemInterface::STATUS => 'processing'
            ], [
                ItemInterface::GROUP_ID => 2,
                ItemInterface::NAME => 'Item 5',
                ItemInterface::STATUS => 'pending'
            ], [
                ItemInterface::GROUP_ID => 3,
                ItemInterface::NAME => 'Item 6',
                ItemInterface::STATUS => 'complete'
            ], [
                ItemInterface::GROUP_ID => 2,
                ItemInterface::NAME => 'Item 8',
                ItemInterface::STATUS => 'testing'
            ]
        ];

        foreach ($groups as $data) {
            $group = $this->groupFactory->create(['data' => $data]);
            $this->groupRepository->save($group);
        }

        foreach ($items as $data) {
            $item = $this->itemFactory->create(['data' => $data]);
            $this->itemRepository->save($item);
        }
    }
}
