<?php

namespace Lengbin\PhpGenerator;

class Method extends Base
{
    /**
     * @var bool
     */
    private $final = false;

    /**
     * @var bool
     */
    private $abstract = false;

    /**
     * @var Params[]
     */
    private $params = [];

    /**
     * @var mixed
     */
    private $return;

    /**
     * @var ?string
     */
    private $content;

    /**
     * @return bool
     */
    public function getFinal(): bool
    {
        return $this->final;
    }

    /**
     * @param bool $final
     *
     * @return Method
     */
    public function setFinal(bool $final = true): Method
    {
        $this->final = $final;
        return $this;
    }

    /**
     * @return Params[]
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param Params[] $params
     *
     * @return Method
     */
    public function setParams(array $params): Method
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @param mixed $return
     *
     * @return Method
     */
    public function setReturn($return): Method
    {
        $this->return = $return;
        return $this;
    }

    /**
     * @param Params $params
     *
     * @return $this
     */
    public function addParams(Params $params): Method
    {
        $this->params[] = $params;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param ?string $content
     *
     * @return Method
     */
    public function setContent(?string $content): Method
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAbstract(): bool
    {
        return $this->abstract;
    }

    /**
     * @param bool $abstract
     *
     * @return Method
     */
    public function setAbstract(bool $abstract): Method
    {
        $this->abstract = $abstract;
        return $this;
    }

    protected function renderPrefix(): string
    {
        $str = '';
        if ($this->getFinal()) {
            $str .= "final ";
        }
        if ($this->getAbstract()) {
            $str .= "abstract ";
        }
        return $str;
    }

    public function __toString()
    {
        $data = $params = [];
        if (!empty($this->getParams())) {
            foreach ($this->getParams() as $classParams) {
                $classParamName = "$" . $classParams->getName();
                if (empty($classParams->getType()) && !empty($classParams->getDefault())) {
                    $classParams->setType($this->__valueType($classParams->getDefault()));
                }
                $classParam = '';
                if (!empty($classParams->getType())) {
                    $classParam .= "{$classParams->getType()} ";
                } else {
                    $classParams->setType("mixed");
                }
                $classParam .= $classParamName;
                if ($classParams->getAssign()) {
                    $classParam .= (" = " . $this->__getValue($classParams->getDefault()));
                }
                $params[] = $classParam;
                $type = str_replace('?', 'null|', $classParams->getType());
                $this->addComment("@param {$type} {$classParamName} {$classParams->getComment()}");
            }
        }
        $param = implode(", ", $params);

        $method = $this->getSpaces() . $this->renderPrefix() . $this->getScope($this) . " function {$this->getName()}({$param})";
        if (!empty($this->getReturn())) {
            $method .= ": {$this->getReturn()}";
        } else {
            $this->setReturn('mixed');
        }
        $this->addComment("@return {$this->getReturn()}");

        $data[] = $this->renderComment($this->getComments(), 1);
        $data[] = $method;
        $data[] = "{$this->getSpaces()}{";
        if (empty($this->getContent())) {
            $this->setContent("{$this->getSpaces(2)}// TODO: Implement {$this->getName()}() method.");
        }
        $data[] = $this->getContent();
        $data[] = "{$this->getSpaces()}}\n";
        return implode("\n", array_filter($data));
    }
}
