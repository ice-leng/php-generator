<?php

namespace Lengbin\PhpGenerator\Printer;

use Exception;
use Lengbin\Common\Singleton;

class PrinterFactory
{
    use Singleton;

    const VERSION_PHP72 = 72;
    const VERSION_PHP74 = 74;
    const VERSION_PHP80 = 80;

    public function getPrinter(int $version): PrinterInterface
    {
        switch ($version) {
            case self::VERSION_PHP72:
                $printer = new PrinterPhp72();
                break;
            case self::VERSION_PHP74:
                $printer = new PrinterPhp74();
                break;
            default:
                throw new Exception('Kind must be one of ::VERSION_PHP72, ::VERSION_PHP74 or ::VERSION_PHP80');
        }
        return $printer;
    }
}
