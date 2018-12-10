<?php


namespace fit\maze;


class NodeBuilder
{
    /**
     * @var Node[]
     */
    private $nodeStack = [];

    /**
     * @param Node $node
     */
    public function __construct(Node $node = null)
    {
        $this->setNode($node ?: $this->nodeInstanceByValue());
    }

    public function setNode(Node $node)
    {
        $this
            ->emptyStack()
            ->pushNode($node)
        ;

        return $this;
    }

    public function getNode()
    {
        return $this->nodeStack[count($this->nodeStack) - 1];
    }

    public function leaf($value = null)
    {
        $this->getNode()->addChild(
            $this->nodeInstanceByValue($value)
        );

        return $this;
    }

    public function leafs($value1 /*,  $value2, ... */)
    {
        foreach (func_get_args() as $value) {
            $this->leaf($value);
        }

        return $this;
    }

    public function tree($value = null)
    {
        $node = $this->nodeInstanceByValue($value);
        $this->getNode()->addChild($node);
        $this->pushNode($node);

        return $this;
    }

    public function end()
    {
        $this->popNode();

        return $this;
    }

    public function nodeInstanceByValue($value = null)
    {
        return new Node($value);
    }

    public function value($value)
    {
        $this->getNode()->setValue($value);

        return $this;
    }

    private function emptyStack()
    {
        $this->nodeStack = [];

        return $this;
    }

    private function pushNode(Node $node)
    {
        array_push($this->nodeStack, $node);

        return $this;
    }

    private function popNode()
    {
        return array_pop($this->nodeStack);
    }
}
