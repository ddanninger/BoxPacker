<?php
/**
 * Box packing (3D bin packing, knapsack problem).
 *
 * @author Doug Wright
 */
declare(strict_types=1);

namespace DVDoug\BoxPacker;

use JsonSerializable;

/**
 * A packed item.
 */
class PackedItem implements JsonSerializable
{
    protected int $x;

    protected int $y;

    protected int $z;

    protected Item $item;

    protected int $width;

    protected int $length;

    protected int $depth;

    public function __construct(Item $item, int $x, int $y, int $z, int $width, int $length, int $depth)
    {
        $this->item = $item;
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->width = $width;
        $this->length = $length;
        $this->depth = $depth;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getZ(): int
    {
        return $this->z;
    }

    public function getItem(): Item
    {
        return $this->item;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getDepth(): int
    {
        return $this->depth;
    }

    public function getVolume(): int
    {
        return $this->width * $this->length * $this->depth;
    }

    /**
     * @return PackedItem
     */
    public static function fromOrientatedItem(OrientatedItem $orientatedItem, int $x, int $y, int $z): self
    {
        return new static(
            $orientatedItem->getItem(),
            $x,
            $y,
            $z,
            $orientatedItem->getWidth(),
            $orientatedItem->getLength(),
            $orientatedItem->getDepth()
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
            'z' => $this->z,
            'width' => $this->width,
            'length' => $this->length,
            'depth' => $this->depth,
            'item' => [
                'description' => $this->item->getDescription(),
                'width' => $this->item->getWidth(),
                'length' => $this->item->getLength(),
                'depth' => $this->item->getDepth(),
                'allowedRotation' => $this->item->getAllowedRotation(),
            ],
        ];
    }
}
