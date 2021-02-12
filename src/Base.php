<?php

namespace Lengbin\PhpGenerator;

use Lengbin\Common\Component\BaseObject;

/**
 * Class Base
 */
class Base extends BaseObject
{
    use TraitGenerateClass;
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
    public function setPrivate(bool $private): Base
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
    public function setProtected(bool $protected): Base
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
    public function setPublic(bool $public): Base
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
     * 获取 作用域
     *
     * @param Base $base
     *
     * @return string
     */
    protected function getScope(Base $base): string
    {
        $str = '';
        if ($base->getPublic()) {
            $str = 'public';
        }

        if ($base->getProtected()) {
            $str = 'protected';
        }

        if ($base->getPrivate()) {
            $str = 'private';
        }

        if ($base->getStatic()) {
            $str .= ' static';
        }
        return $str;
    }
}
