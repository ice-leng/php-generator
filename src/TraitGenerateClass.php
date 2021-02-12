<?php

namespace Lengbin\PhpGenerator;

trait TraitGenerateClass
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
}
