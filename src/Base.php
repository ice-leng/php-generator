<?php

namespace Lengbin\PhpGenerator;

use Lengbin\Common\BaseObject;
use Lengbin\PhpGenerator\Printer\PrinterFactory;

/**
 * Class Base
 */
class Base extends BaseObject
{
    /**
     * @var int
     */
    protected $version = PrinterFactory::VERSION_PHP72;

    /**
     * @var bool
     */
    protected $static = false;

    /**
     * @var bool
     */
    protected $private = false;

    /**
     * @var bool
     */
    protected $protected = false;

    /**
     * @var bool
     */
    protected $public = true;

    /**
     * @var array
     */
    protected $comments = [];

    /**
     * @var string
     */
    protected $name;

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     *
     * @return Base
     */
    public function setVersion(int $version): Base
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return bool
     */
    public function getStatic(): bool
    {
        return $this->static;
    }

    /**
     * @param bool $static
     *
     * @return Base
     */
    public function setStatic(bool $static = true): Base
    {
        $this->static = $static;
        return $this;
    }

    /**
     * @return bool
     */
    public function getPrivate(): bool
    {
        return $this->private;
    }

    /**
     * @param bool $private
     *
     * @return Base
     */
    public function setPrivate(bool $private = true): Base
    {
        $this->private = $private;
        if ($private === true) {
            $this->setPublic(false);
            $this->setProtected(false);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function getProtected(): bool
    {
        return $this->protected;
    }

    /**
     * @param bool $protected
     *
     * @return Base
     */
    public function setProtected(bool $protected = true): Base
    {
        $this->protected = $protected;
        if ($protected === true) {
            $this->setPublic(false);
            $this->setPrivate(false);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function getPublic(): bool
    {
        return $this->public;
    }

    /**
     * @param bool $public
     *
     * @return Base
     */
    public function setPublic(bool $public = true): Base
    {
        $this->public = $public;
        if ($public === true) {
            $this->setProtected(false);
            $this->setPrivate(false);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Base
     */
    public function setName(string $name): Base
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     *
     * @return Base
     */
    public function setComments(array $comments): Base
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @param string $comment
     *
     * @return Base
     */
    public function addComment(string $comment): Base
    {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function __valueType($value): string
    {
        switch (gettype($value)) {
            case 'boolean':
                $value = 'bool';
                break;
            case 'integer':
                $value = 'int';
                break;
            case 'double':
                $value = 'float';
                break;
            case 'NULL':
                $value = 'null';
                break;
            default:
                break;
        }
        return $value;
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function __getValue($value): string
    {
        switch (gettype($value)) {
            case 'boolean':
                $value = $value ? 'true' : 'false';
                break;
            case 'integer':
            case 'double':
                $value = (string)$value;
                break;
            case 'string':
                $value = "'" . $value . "'";
                break;
            case 'resource':
                $value = '{resource}';
                break;
            case 'NULL':
                $value = 'null';
                break;
            case 'unknown type':
                $value = '{unknown}';
                break;
            case 'array':
                $value = json_encode($value);
                break;
        }
        return $value;
    }
}
