<?php

namespace App\Representation;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;

class PaginatedCollection
{

    /**
     * @Type("array<App\Entity\Phone>")
     * @Serializer\Groups({"detail", "list"})
     */
    private $items;
    /**
     * @Serializer\Groups({"detail", "list"})
     */
    private $total;
    /**
     * @Serializer\Groups({"detail", "list"})
     */
    private $count;
        /**
     * @Serializer\Groups({"detail", "list"})
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