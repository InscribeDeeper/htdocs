<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    <li>func</li>
    <section>
        <?php
        function add($num1, $num2)
        {
            $a = $num1 + $num2;
            return $a;
        }
        $sum = add(11, 5);
        echo '$sum = ' . $sum . '<br>';
        echo '6 + 33 =' . add(6, 33) . '<br>';
        echo '42 + 21 =' . add(42, 21) . '<br>';
        echo '167 + 153 =' . add(167, 153);
        ?>
        <?php
        function hello($str)
        {
            echo '参数 $str 的值为：' . $str . '<br>';
            echo 'C语言中文网';
        }
        ?>
    </section>

    <li>类型声明</li>
    <section>
        <?php
        function test(int $a, string $b, string $c)
        {
            echo ($a + $b);
            echo " the string is $c";
        }
        test(3.8, 2, 'hello');
        ?>
    </section>

    <li>引用地址传递</li>
    <section>
        <?php
        function swap1(&$a, &$b)
        {
            echo '函数内，交换前 $a = ' . $a . ', $b = ' . $b . '<br>';
            $temp = $a;
            $a = $b;
            $b = $temp;
            echo '函数内，交换后 $a = ' . $a . ', $b = ' . $b . '<br>';
        }
        $x = 5;
        $y = 7;
        echo '函数外，交换前 $x = ' . $x . ', $y = ' . $y . '<br>';
        swap1($x, $y);
        echo '函数外，交换后 $x = ' . $x . ', $y = ' . $y;
        ?>
    </section>

    <li>值传递</li>
    <section>
        <?php
        function swap($a, $b)
        {
            echo '函数内，交换前 $a = ' . $a . ', $b = ' . $b . '<br>';
            $temp = $a;
            $a = $b;
            $b = $temp;
            echo '函数内，交换后 $a = ' . $a . ', $b = ' . $b . '<br>';
        }
        $x = 5;
        $y = 7;
        echo '函数外，交换前 $x = ' . $x . ', $y = ' . $y . '<br>';
        swap($x, $y);
        echo '函数外，交换后 $x = ' . $x . ', $y = ' . $y;
        ?>
    </section>

    <li>可变长度参数</li>
    <section>
        <?php
        function test1(...$arr)
        {
            print_r($arr);
        }
        echo '<pre>';
        test1(1, 2, 3, 4);
        test1(5, 6, 7, 8, 9, 10);
        ?>
    </section>

    <li>var_dump 也是一种 print out</li>
    <section>
        <?php
        function sum($a, $b): float
        {
            return $a + $b;
        }
        var_dump(sum(114, 233));
        ?>
    </section>


    <li>匿名函数=一次性函数</li>
    <section>
        <?php
        $arr    = [1, 2, 3, 4, 5, 6];
        $result = array_map(function ($num) {
            return $num * $num;
        }, $arr);

        echo '<pre>';
        print_r($result);
        ?>
    </section>

    <li>可变函数 - 这个只需要改变变量名, 就可以改变绑定的 那个 func</li>
    <section>
        <?php
        function website()
        {
            echo 'C语言中文网<br>';
        }
        function url($str = '')
        {
            echo $str . '<br>';
        }
        function title($string)
        {
            echo $string;
        }
        $funcname = 'website';
        $funcname();
        $funcname = 'url';
        $funcname('http://c.biancheng.net/php/');
        $funcname = 'title';
        $string = 'PHP 教程';
        $funcname($string);
        ?>
    </section>

    <li>回调函数</li>
    不像 C、Java 等语言那样直接使用函数名作为函数参数，而是使用函数名对应的字符串名称来调用.

    两个内置函数 call_user_func() 和 call_user_func_array() 来对回调函数进行支持。这两个函数的区别是 call_user_func_array() 是以数组的形式接收回调函数的参数，而 call_user_func() 则是以具体的参数来接收回调函数参数的。

    所谓的回调函数，就是指调用函数时并不是向函数中传递一个标准的变量作为参数，而是将另一个函数作为参数传递到调用的函数中，这个作为参数的函数就是回调函数。通俗的来说，回调函数也是一个我们定义的函数，但是不是我们直接来调用的，而是通过另一个函数来调用的，这个函数通过接收回调函数的名字和参数来实现对它的调用。

    <section>
        <?php
        function arithmetic($funcName, $m, $n)
        {
            return $funcName($m, $n);
        }
        function add1($m, $n)
        {
            return $m + $n;
        }
        $sum = arithmetic('add1', 5, 9);
        echo '5 + 9 =' . $sum;
        ?>

        <?php
        function arithmetic1($funcName, $m, $n)
        {
            return call_user_func($funcName, $m, $n);
        }
        function add2($m, $n)
        {
            return $m + $n;
        }
        $sum = arithmetic1('add2', 7, 17);
        echo '7 + 17 =' . $sum;
        ?>
    </section>

    <li>递归</li>
    在 PHP 中最大递归层数也不是没有限制的，这与程序的内存限额有关，PHP5 默认允许一个程序使用 128M 的内存，因此当递归层数过大导致 128M 内存耗尽时，程序就会产生一个致命错误并退出。PHP7 默认允许使用 256M 的内存。
    <section>
        <?php
        function factorial($num)
        {
            //确定递归函数的出口
            if ($num == 1) {
                return 1;
            } else {
                return $num * factorial($num - 1);
            }
        }
        echo '15 的阶乘是：' . factorial(15);
        ?>
    </section>

</ol>