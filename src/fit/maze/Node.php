<?php
/*
 * This file is part of Tree.
 *
 * (c) 2013 Nicolò Martini
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace fit\maze;

/**
 * Class Node
 */
class Node
{
    /**
     * @var mixed
     */
    private $value;

    private $parent;

    private $children = [];

    public function __construct($value = null, array $children = [])
    {
        $this->setValue($value);
        if (!empty($children)) {
            $this->setChildren($children);
        }
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function addChild(Node $child)
    {
        $child->setParent($this);
        $this->children[] = $child;

        return $this;
    }

    public function removeChild(Node $child)
    {
        foreach ($this->children as $key => $myChild) {
            if ($child == $myChild) {
                unset($this->children[$key]);
            }
        }

        $this->children = array_values($this->children);

        $child->setParent(null);

        return $this;
    }

    public function removeAllChildren()
    {
        $this->setChildren([]);

        return $this;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren(array $children)
    {
        $this->removeParentFromChildren();
        $this->children = [];

        foreach ($children as $child) {
            $this->addChild($child);
        }

        return $this;
    }

    public function setParent(Node $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getAncestors()
    {
        $parents = [];
        $node = $this;
        while ($parent = $node->getParent()) {
            array_unshift($parents, $parent);
            $node = $parent;
        }

        return $parents;
    }

    public function getAncestorsAndSelf()
    {
        return array_merge($this->getAncestors(), [$this]);
    }

    public function getNeighbors()
    {
        $neighbors = $this->getParent()->getChildren();
        $current = $this;

        // Uses array_values to reset indexes after filter.
        return array_values(
            array_filter(
                $neighbors,
                function ($item) use ($current) {
                    return $item != $current;
                }
            )
        );
    }

    public function getNeighborsAndSelf()
    {
        return $this->getParent()->getChildren();
    }

    public function isLeaf()
    {
        return count($this->children) === 0;
    }

    public function isRoot()
    {
        return $this->getParent() === null;
    }

    public function isChild()
    {
        return $this->getParent() !== null;
    }

    /**
     * Find the root of the node
     *
     * @return Node
     */
    public function root()
    {
        $node = $this;

        while ($parent = $node->getParent())
            $node = $parent;

        return $node;
    }

    /**
     * Return the distance from the current node to the root.
     *
     * Warning, can be expensive, since each descendant is visited
     *
     * @return int
     */
    public function getDepth()
    {
        if ($this->isRoot()) {
            return 0;
        }

        return $this->getParent()->getDepth() + 1;
    }

    /**
     * Return the height of the tree whose root is this node
     *
     * @return int
     */
    public function getHeight()
    {
        if ($this->isLeaf()) {
            return 0;
        }

        $heights = [];

        foreach ($this->getChildren() as $child) {
            $heights[] = $child->getHeight();
        }

        return max($heights) + 1;
    }

    /**
     * Return the number of nodes in a tree
     * @return int
     */
    public function getSize()
    {
        $size = 1;
        foreach ($this->getChildren() as $child) {
            $size += $child->getSize();
        }

        return $size;
    }


    public function accept(Visitor $visitor)
    {
        $result = call_user_func([$visitor->maze, $this->value]);
        if($result == false){
            return;
        }else if($this->isLeaf()){
            $visitor->result = true;
            return;
        }else{
            $visitor->visit($this);
        }
    }

    private function removeParentFromChildren()
    {
        foreach ($this->getChildren() as $child)
            $child->setParent(null);
    }
}
