<?php

namespace Lengbin\PhpGenerator;

class Constant extends Base
{
    /**
     * @var mixed
     */
    private $default;

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param $default
     *
     * @return Constant
     */
    public function setDefault($default): Constant
    {
        $this->default = $default;
        return $this;
    }

    public function __toString()
    {
        $data = [];
        // if not comment, add name
        if (empty($this->getComments())) {
            $this->addComment($this->getName());
        }
        if (!empty($this->getComments())) {
            $data[] = $this->renderComment($this->getComments(), 1);
        }
        $data[] = ("{$this->getSpaces()}{$this->getScope($this)} const " . strtoupper($this->getName()) . " = " . $this->__getValue($this->getDefault()) . ";\n");
        return implode("\n", array_filter($data));
    }
}
