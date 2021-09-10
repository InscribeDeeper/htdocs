<?php

namespace Foo\Bar;

include 'Demo.php';
const FOO = 2;
function foo()
{
    echo 'Foo\Bar 命名空间下的 foo 函数<br>';
}
class foo
{
    static function demo()
    {
        echo '命名空间为：Foo\Bar<br>';
    }
}

/* 非限定名称 */
foo();                  // 解析为 Foo\Bar\foo resolves to function Foo\Bar\foo
foo::demo();            // 解析为类 Foo\Bar\foo 的静态方法 staticmethod。
echo FOO . '<br>';        // 解析为常量 Foo\Bar\FOO

/* 限定名称 */
Demo\foo();             // 解析为函数 Foo\Bar\Demo\foo
Demo\foo::demo();       // 解析为类 Foo\Bar\Demo\foo,
// 以及类的方法 demo
echo Demo\FOO . '<br>';   // 解析为常量 Foo\Bar\Demo\FOO

/* 完全限定名称 */
\Foo\Bar\foo();         // 解析为函数 Foo\Bar\foo
\Foo\Bar\foo::demo();   // 解析为类 Foo\Bar\foo, 以及类的方法 demo
echo \Foo\Bar\FOO . '<br>'; // 解析为常量 Foo\Bar\FOO



