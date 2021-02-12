<?php

namespace Lengbin\PhpGenerator;

class Property extends Base
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
     * @return Property
     */
    public function setDefault($default): Property
    {
        $this->default = $default;
        return $this;
    }

    public function __toString()
    {
        $data = [];
        // if not comment, add default value type
        if (empty($this->getComments()) && !is_null($this->getDefault())) {
            $this->addComment("@var " . $this->__valueType($this->getDefault()));
        }
        $data[] = $this->renderComment($this->getComments(), 1);
        $property = "{$this->getSpaces()}{$this->getScope($this)} $" . $this->getName();
        if (is_null($this->getDefault())) {
            $property .= ";";
        } else {
            $property .= (" = " . $this->__getValue($this->getDefault()) . ";");
        }
        $data[] = $property . "\n";
        return implode("\n", array_filter($data));
    }
}
