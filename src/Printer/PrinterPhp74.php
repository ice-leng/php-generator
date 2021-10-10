<?php

namespace Lengbin\PhpGenerator\Printer;

use Lengbin\PhpGenerator\Constant;
use Lengbin\PhpGenerator\GenerateClass;
use Lengbin\PhpGenerator\Method;
use Lengbin\PhpGenerator\Params;
use Lengbin\PhpGenerator\Property;

class PrinterPhp74 extends PrinterPhp72
{
    public function printProperty(Property $property): string
    {
        $data = [];
        // if not comment, add default value type
        if (empty($property->getComments()) && !is_null($property->getDefault())) {
            $property->addComment("@var " . $property->__valueType($property->getDefault()));
        }
        $comment = $this->renderComment($property->getComments(), 1);
        preg_match('/@var\s+([^\s]+)/', $comment, $matches);
        [, $type] = $matches;
        $data[] = $comment;
        $str = "{$this->getSpaces()}{$this->getScope($property)} {$type} $" . $property->getName();
        if (is_null($property->getDefault())) {
            $str .= ";";
        } else {
            $str .= (" = " . $property->__getValue($property->getDefault()) . ";");
        }
        $data[] = $str . "\n";
        return implode("\n", array_filter($data));
    }
}
