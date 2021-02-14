<?php

namespace Lengbin\PhpGenerator;

use Lengbin\PhpGenerator\Printer\PrinterFactory;

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

    public function __toString(): string
    {
        return PrinterFactory::getInstance()->getPrinter($this->getVersion())->printProperty($this);
    }
}
