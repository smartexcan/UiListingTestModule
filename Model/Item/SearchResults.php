<?php
declare(strict_types=1);

namespace Author\Example\Model\Item;

use Magento\Framework\Api\SearchResults as BaseSearchResults;
use Author\Example\Api\Data\ItemSearchResultsInterface;

/**
 * @api
 */
class SearchResults extends BaseSearchResults implements ItemSearchResultsInterface
{}
