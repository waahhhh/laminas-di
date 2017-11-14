<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Di\TestAsset\InjectionClasses;

class A
{
    public $bs = [];

    public function addB(B $b)
    {
        $this->bs[] = $b;
    }

    public function injectBOnce(B $b)
    {
        $this->bs[] = $b;
    }

    public function injectBTwice(B $b)
    {
        $this->bs[] = $b;
    }

    public function injectSplitDependency(B $b, $somestring)
    {
        $b->id = $somestring;
        $this->bs[] = $b;
    }
}
