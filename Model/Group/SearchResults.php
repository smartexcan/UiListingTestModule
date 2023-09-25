<?php
declare(strict_types=1);

namespace Author\Example\Model\Group;

use Magento\Framework\Api\SearchResults as BaseSearchResults;
use Author\Example\Api\Data\GroupSearchResultsInterface;

/**
 * @api
 */
class SearchResults extends BaseSearchResults implements GroupSearchResultsInterface
{}
