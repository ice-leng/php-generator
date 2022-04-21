# php-generator
> 生成php文件

# 支持php版本
- [x] php7.2
- [x] php7.4
- [x] php8

# 安装
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require lengbin/php-generator
```

or add

```
"lengbin/php-generator": "*"
```
to the required section of your `composer.json` file.

# 使用
------------

## GenerateClass
------------
```php
    $generateClass = new GenerateClass();
    $generateClass->setNamespace('App\Controller')
        ->setClassname('CalculateController')
        ->setStrictTypes()
        ->addUse('App\Common\BaseController')
        ->setComments([
            'Class CalculateController',
            '@package App\Controller',
        ])->setInheritance('BaseController')
        ->setAbstract(true)
        ->addMethod((new Method())->setFinal()
            ->setName('add')
            ->setPrivate(true)
            ->setContent('        return $a + $b;')
            ->setReturn('int')
            ->addParams((new Params())
                ->setName('a')
                ->setType('int')
                ->setDefault(1)
                ->setComment('左边参数')
            )
            ->addParams((new Params())
                ->setName('b')
                ->setType('int')
                ->setDefault(2)
                ->setComment('右边参数')
            )->addComment('加法'))
        ->addMethod((new Method())
            ->setName('subtraction')
            ->setProtected(true)
            ->setContent('        return $a - $b;')
            ->setReturn('int')
            ->addParams((new Params())
                ->setName('a')
                ->setType('int')
                ->setDefault(1)
                ->setComment('左边参数')
            )
            ->addParams((new Params())
                ->setName('b')
                ->setType('int')
                ->setDefault(2)
                ->setComment('右边参数')
            )->addComment('减法'))
        ->addMethod((new Method())
            ->setName('abstractFunction')
            ->setAbstract(true)
            ->setReturn('int')
            ->addParams((new Params())
                ->setName('a')
                ->setType('int')
                ->setDefault(1)
                ->setComment('左边参数')
            )
            ->addParams((new Params())
                ->setName('b')
                ->setType('int')
                ->setDefault(2)
                ->setComment('右边参数')
            )->addComment('abstract'));
        echo $generateClass;
```
或者
```php
    $generateClass = new GenerateClass([
        'namespace'   => 'App\Controller',
        'classname'   => 'CalculateController',
        'strictTypes' => true,
        'uses'        => [
            'App\Common\BaseController',
        ],
        'comments'    => [
            'Class CalculateController',
            '@package App\Controller',
        ],
        'inheritance' => 'BaseController',
        'abstract'    => true,
        'methods'     => [
            [
                'name'     => 'add',
                'private'  => true,
                'content'  => '        return $a + $b;',
                'return'   => 'int',
                'comments' => ['加法'],
                'params'   => [
                    ['name' => 'a', 'type' => 'int', 'default' => 1, 'comment' => '左边参数'],
                    ['name' => 'b', 'type' => 'int', 'default' => 2, 'comment' => '右边参数'],
                ],
            ],
            [
                'name'      => 'subtraction',
                'protected' => true,
                'content'   => '        return $a - $b;',
                'return'    => 'int',
                'comments'  => ['减法'],
                'params'    => [
                    ['name' => 'a', 'type' => 'int', 'default' => 3, 'comment' => '左边参数'],
                    ['name' => 'b', 'type' => 'int', 'default' => 2, 'comment' => '右边参数'],
                ],
            ],
            [
                'name'     => 'abstractFunction',
                'abstract' => true,
                'return'   => 'int',
                'comments' => ['abstract'],
                'params'   => [
                    ['name' => 'a', 'type' => 'int', 'default' => 1, 'comment' => '左边参数'],
                    ['name' => 'b', 'type' => 'int', 'default' => 2, 'comment' => '右边参数'],
                ],
            ],
        ],
    ]);
    echo $generateClass;
```
得到
```php
    <?php

    declare(strict_types=1);
    
    namespace App\Controller;
    
    use App\Common\BaseController;
    
    /**
     * Class CalculateController
     * @package App\Controller
     */
    abstract class CalculateController extends BaseController
    {
        /**
         * 加法
         * @param int $a 左边参数
         * @param int $b 右边参数
         * @return int
         */
        private function add(int $a = 1, int $b = 2): int
        {
            return $a + $b;
        }
    
        /**
         * 减法
         * @param int $a 左边参数
         * @param int $b 右边参数
         * @return int
         */
        protected function subtraction(int $a = 3, int $b = 2): int
        {
            return $a - $b;
        }
    
        /**
         * abstract
         * @param int $a 左边参数
         * @param int $b 右边参数
         * @return int
         */
        abstract public function abstractFunction(int $a = 1, int $b = 2): int;
    }
```

## Constant
------------
```php
    $constant = new Constant();
    $constant->setName('success')
        ->setDefault("2")
        ->setPrivate()
        ->addComment('@Message("成功")');
    echo $constant;
```
或者
```php
    $constant = new Constant([
        'name'     => 'success',
        'default'  => '2',
        'private'  => 'true',
        'comments' => ['@Message("成功")'],
    ]);
    echo $constant;
```
得到
```php
    /**
     * @Message("成功")
     */
    private const SUCCESS = '2';
```

## Property
------------
```php
    $property = new Property();
    $property->setProtected(true)
        ->setName('test')
        ->setStatic()
        ->setDefault(true);
    echo $property;
```
或者
```php
    $property = new Property([
        'name'      => 'test',
        'protected' => true,
        'default'   => true,
        'static'    => true,
    ]);
    echo $property;
```
得到
```php
    /**
     * @var bool
     */
    protected static $test = true;
```

## Method
------------
```php
    $method = new Method();
    $method->setFinal()
        ->setName('add')
        ->setPrivate(true)
        ->setContent('        return $a + $b;')
        ->setReturn('int')
        ->addParams((new Params())
            ->setName('a')
            ->setType('int')
            ->setDefault(1)
            ->setComment('左边参数')
        )
        ->addParams((new Params())
            ->setName('b')
            ->setType('int')
            ->setDefault(2)
            ->setComment('右边参数')
        )->addComment('加法');
    echo $method;
```
或者
```php
    $method = new Method([
        'name'     => 'add',
        'final'    => true,
        'private'  => true,
        'content'  => '        return $a + $b;',
        'return'   => 'int',
        'comments' => ['加法'],
        'params'   => [
            [
                'name'    => 'a',
                'type'    => 'int',
                'default' => 1,
                'comment' => '左边参数',
            ],
            [
                'name'    => 'b',
                'type'    => 'int',
                'default' => 2,
                'comment' => '右边参数',
            ],
        ],
    ]);
    echo $method;
```
得到
```php
    /**
     * 加法
     * @param int $a 左边参数
     * @param int $b 右边参数
     * @return int
     */
    final private function add(int $a = 1, int $b = 2): int
    {
        return $a + $b;
    }
```

