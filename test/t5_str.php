<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    <li>引号</li>
    PHP 会解析双引号中的变量，而不会解析单引号中的变量。也就是说，如果使用单引号定义的字符串中出现变量，在输出时变量会被原样输出，不会解析成变量的值。而如果使用双引号定义的字符串中存在变量，在输出时变量会被解析为具体的值。
    需要注意的是，虽然双引号定义的字符串能够解析变量，但是如果变量后边还有字符串的话，就需要将变量与后面的字符串使用空格分开，或者使用大括号{ }将变量包裹起来。如果不这么做的话，很可能会造成意想不到的结果。
    因为单引号不需要考虑变量的解析，所以处理速度比双引号要快，我们在定义字符串时应该尽量遵循能用单引号尽量用单引号的原则。
    <section>
        <?php
        $website = 'C语言中文网';
        $url = 'http://c.biancheng.net/php/';
        $str1 = '您正在访问的是：$website <br>';
        $str2 = "网站的链接地址为：$url";
        echo $str1;
        echo $str2;
        ?>
    </section>

    <li>build-in function</li>
    strtoupper 将字符串转化为大写
    strtolower 将字符串转化为小写
    ucfirst 将字符串的首字母转化为大写
    lcfirst 将字符串的首字母转化为小写
    ucwords 将字符串中每个单词的首字符转化为大写
    mb_strtoupper 将字符串转化为大写（与 strtoupper 函数有区别）
    mb_strtolower 将字符串转化为小写（与 strtolower 函数有区别）
    mb_convert_case 按照不同的模式对字符串进行转换

    <section>

    </section>

    <li>table</li>
    <section>
    </section>

    <li>9x9</li>
    <section>
    </section>

    <li>table</li>
    <section>
    </section>

</ol>