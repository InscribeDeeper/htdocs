<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    <li>特殊标识符</li>
    <section>

        定界符标识必须前后一致；
        可以任意定义定界符标识，比如 echo、html、div，尽量选用有意义的标识符，并遵循命名规范；
        起始标识符后不能跟任何字符，空格也不可以，另起一行后再输入文本内容；
        结束标识符后面要紧跟一个分号，并且前后都不能有任何字符，<b>即结束标识要顶头写，且独占一行，其后除紧跟分号外，</b> 不能有任何字符（空格也不可以）；
        最后要注意的是，结束标识所在行不能成为脚本的最后一行，其下必须有空行或者其他代码行，否则报错。

        <?php
        $website = 'C语言中文网';
        $url = 'http://c.biancheng.net/php/ 定界符';
        $title = 'PHP 教程';
        $str = <<<str
        <!DOCTYPE html>
        <html>
        <head>
            <title> $title </title>
        </head>
        <body>
            您正在访问的是：<strong style="color:red">$website</strong><br>
            网址：<a href="$url" target="_blank">$url</a>
        </body>
        </html>
str;
        echo $str;
        ?>
    </section>


    <li>字符串/class声明</li>
    <section>
        <?php
        //双引号方式声明字符串
        $str1 = "C语言中文网";
        //单引号方式声明字符串
        $str2 = 'PHP 教程';
        //Heredoc 方式声明字符串
        $str3 = <<<EOF
    url：
    http://c.biancheng.net/php/
EOF;
        echo $str1 . "<br>" . $str2 . "<br>" . $str3;

        echo "<pre>";   // <pre> 是一个 HTML 标签，用来格式化输出内容

        class Car  //使用 class 声明一个类对象
        {
            var $color;
            function car($color = "black")
            {
                $this->color = $color;
            }
            function getColor()
            {
                return $this->color;
            }
        }
        $car = new Car();
        $car->car('red');
        echo $car->getColor();
        ?>

    </section>

    <li>地址赋值/全局变量/静态变量</li>
    <section>
        <?php
        $arr = array('website' => 'C语言中文网', 'url' => 'http://c.biancheng.net/');
        echo "<pre>";   // <pre> 是一个 HTML 标签，用来格式化输出内容
        var_dump($arr);
        ?>


        <?php
        header("content-type:text/html;charset=utf-8"); //设置编码，解决中文乱码
        $file = fopen("test.txt", "rw"); //打开test.txt文件
        var_dump($file);
        ?>


        <?php
        // 全局变量就是定义在所有函数以外的变量，其作用域是当前源码的任何地方，但是在函数内部是不可用的。
        $a = "C语言中文网";      // 在函数外部定义全局变量 a
        function example()
        {
            if ($a) {
                echo "在函数内部调用全局变量 a，其值为：" . $a;
            }
        }
        example();
        echo "在函数外部调用全局变量 a，其值为：" . $a;
        ?>


        <?php
        // 地址赋值
        $a = 100;
        $b = &$a;   // 将$a的地址复制一份，传给$b
        $a = 200;   // 重新为 $a 赋值
        echo '$a = ' . $a . ', $b = ' . $b;
        ?>


        <?php
        // 可变变量
        $demo = 'string';
        $$demo = 'C语言中文网'; // 一个变量以另外一个变量的值作为变量名。 $sting = $$demo = 'C语言中文网'
        echo $string . '<br>';
        $name = 'PHP入门教程';
        $str = 'name';
        echo $$str . '<br>';
        $url = 'http://c.biancheng.net/php/';
        $website = 'url';
        $link = 'website';
        echo $ $$link;


        $demo = 'C语言中文网';
        $test = 'http://c.biancheng.net/php/';
        $arr = array('demo', 'test');
        echo ${$arr[0]} . '<br>' . ${$arr[1]} . '<br>';

        $arr2 = array('PHP 教程', 'PHP 可变变量');
        $str = 'arr2';
        echo ${$str}[0] . '<br>' . ${$str}[1];
        ?>



        $GLOBALS：全局作用域中的全部可用变量；
        $_SERVER：服务器和执行环境的信息；
        $_REQUEST：包含了 $_GET，$_POST 和 $_COOKIE 的所有信息；
        $_POST：通过 POST 方法提交的数据；
        $_GET：通过 GET 方法提交的数据；
        $_FILES：通过 POST 方式上传到服务器的文件数据；
        $_ENV：通过环境方式传递给当前脚本的变量组成的数组；
        $_COOKIE：通过 HTTP Cookies 方式传递给当前脚本的变量所组成的数组；
        $_SESSION：当前脚本可用 SESSION 变量组成的数组。

        <?php
        echo "<pre>";
        var_dump($_SERVER);
        ?>

        <?php
        echo '之所以称为静态，是因为它不会随着函数的调用和退出而发生变化。即上次调用函数的时候，如果我们给静态变量赋予某个值的话，那么下次函数调用时，这个值是保持不变。';

        function demo()
        {
            static $a;
            $b = 0;
            $a++;
            $b++;
            echo '第 ' . $a . ' 次运行 demo 函数, 局部变量 $b 的值为：' . $b . '<br>';
        }
        demo();
        demo();
        demo();
        demo();
        ?>


        global 关键字，只能在函数内部使用，不能在函数外部使用；
        global 关键字只能用来引用函数外部的全局变量，在引用时不能直接赋值，赋值和声明语句需要分开写；
        在函数内部销毁一个使用 global 关键字修饰的变量时，函数外部的变量不受影响。
        相当于把外部的一个变量 引到 当前的局部来

        <?php

        $a = 1;
        $b = 2;
        $c = 3;
        function demo1()
        {
            global $a, $b;
            echo "变量 a：" . $a;
            echo "<br>变量 b：" . $b;
            echo "<br>变量 c：" . $c;
        }
        demo1();
        ?>



        <?php
        // 常量
        define('WebSite', 'C语言中文网');
        const url = 'http://c.biancheng.net/php/';
        echo WebSite . '<br>';
        echo url;
        ?>


    </section>

    <li>build-in function</li>
    <section>
        PHP 中魔术常量有八个，如下所示：
        __LINE__ ：文件中的当前行号；
        __FILE__：当前文件的绝对路径（包含文件名）；
        __DIR__：当前文件的绝对路径（不包含文件名），等价于 dirname(__FILE__)；
        __FUNCTION__：当前函数（或方法）的名称；
        __CLASS__：当前的类名（包括该类的作用区域或命名空间）；
        __TRAIT__：当前的 trait 名称（包括该 trait 的作用区域或命名空间）；
        __METHOD__：当前的方法名（包括类名）；
        __NAMESPACE__：当前文件的命名空间的名称。

        <?php
        echo "当前文件的路径：" . __FILE__;
        echo "<br/>当前的行数：" . __LINE__;
        echo "<br/>当前PHP的版本信息：" . PHP_VERSION;
        echo "<br/>当前的操作系统：" . PHP_OS;
        ?>


    </section>


    <li>字符串操作</li>
    <section>

        <?php
        // 字符串拼接
        $str1 = 'C语言';
        $str2 = '中文网';
        $str3 = $str1 . $str2;
        echo $str3;
        ?>
    </section>
</ol>


