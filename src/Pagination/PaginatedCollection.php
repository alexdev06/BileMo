<?php

namespace App\Pagination;

use JMS\Serializer\Annotation as Serializer;

/**
 *  Represents a collection of paginated items with additionnal navigation links 
 */
class PaginatedCollection
{
    /**
     * @Serializer\Groups({"list"})
     */
    private $items;

    /**
     * @Serializer\Groups({"list"})
     */
    private $total;

    /**
     * @Serializer\Groups({"list"})
     */
    private $count;

    /**
     * @Serializer\Groups({"list"})
     */
    private $links = [];

    public function __construct(array $items, $totalItems)
    {
        $this->items = $items;
        $this->total = $totalItems;
        $this->count = count($items);
    }

    public function addLink($ref, $url)
    {
        $this->links[$ref] = $url;
    }
}