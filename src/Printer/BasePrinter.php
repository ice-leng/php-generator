<?php

namespace Lengbin\PhpGenerator\Printer;

use Lengbin\PhpGenerator\Base;
use Lengbin\PhpGenerator\GenerateClass;

class BasePrinter
{
    /**
     * @param int $level
     *
     * @return string
     */
    protected function getSpaces(int $level = 1): string
    {
        return str_repeat(' ', $level * 4);
    }

    /**
     * @param array $comments
     * @param int   $level
     *
     * @return string
     */
    protected function renderComment(array $comments = [], int $level = 0): string
    {
        $data = [];
        if (!empty($comments)) {
            $data[] = "{$this->getSpaces($level)}/**";
            foreach ($comments as $comment) {
                $data[] = "{$this->getSpaces($level)} * {$comment}";
            }
            $data[] = "{$this->getSpaces($level)} */";
        }
        return implode("\n", $data);
    }

    /**
     * @param GenerateClass|Base $obj
     *
     * @return string
     */
    protected function renderPrefix($obj): string
    {
        $str = '';
        if ($obj->getFinal()) {
            $str .= "final ";
        }
        if ($obj->getAbstract()) {
            $str .= "abstract ";
        }
        return $str;
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
