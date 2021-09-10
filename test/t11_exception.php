<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    <li>table</li>
    <section>
        <?php
        $a = 1;
        $b = 2;

        $c = $a > 1;
        echo $c;
        echo $a > 1;

        echo 2 <=> 1; // 1

        echo 1 <=> 2; // -1

        echo 1 <=> 1; // 0

        if ($a == $b) {
            echo '$a = $b';
        } else {
            echo '$a != $b';
        }
        ?>
    </section>

    <li>逻辑判断</li>
    <section>

        <?php
        // Integers
        echo 1 <=> 1; // 0
        echo 1 <=> 2; // -1
        echo 2 <=> 1; // 1

        // Floats
        echo 1.5 <=> 1.5; // 0
        echo 1.5 <=> 2.5; // -1
        echo 2.5 <=> 1.5; // 1

        // Strings
        echo "a" <=> "a"; // 0
        echo "a" <=> "b"; // -1
        echo "b" <=> "a"; // 1

        echo "a" <=> "aa"; // -1
        echo "zz" <=> "aa"; // 1

        // Arrays
        echo [] <=> []; // 0
        echo [1, 2, 3] <=> [1, 2, 3]; // 0
        echo [1, 2, 3] <=> []; // 1
        echo [1, 2, 3] <=> [1, 2, 1]; // 1
        echo [1, 2, 3] <=> [1, 2, 4]; // -1

        // Objects
        $a = (object) ["a" => "b"];
        $b = (object) ["a" => "b"];
        echo $a <=> $b; // 0

        $a = (object) ["a" => "b"];
        $b = (object) ["a" => "c"];
        echo $a <=> $b; // -1

        $a = (object) ["a" => "c"];
        $b = (object) ["a" => "b"];
        echo $a <=> $b; // 1

        // not only values are compared; keys must match
        $a = (object) ["a" => "b"];
        $b = (object) ["b" => "b"];
        echo $a <=> $b; // 1

        ?>
    </section>

    <li>syslog</li>
    以 Windows 系统为例，通过右击“我的电脑/此电脑”选择“管理”选项，然后到系统工具菜单中，选择“事件查看器”，再找到“Windows 日志”下的“应用程序”选项，就可以看到我们自己定制的警告消息了。如下图所示：
    <section>
        <?php
        openlog("C语言中文网", LOG_PID, LOG_USER);
        syslog(LOG_WARNING, "向 syslog 中发送定时消息，发送时间：" . date("Y/m/d H:i:s"));
        closelog();
        ?>
    </section>

    <li>使用 @ 错误控制运算符屏蔽代码中的错误</li>
    错误处理函数将返回 0.
    PHP 支持使用错误控制运算符@。将其放置在一个 PHP 表达式之前，该表达式可能产生的任何错误信息都将被忽略掉。
    <section>
        <?php
        $link = @mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db") ;
        echo '数据库连接失败！';
        ?>
    </section>

    <li>error_reporting</li>
    将 $level 设置为 0，将关闭所有 PHP 错误报告；如果设置为 -1，将返回所有的错误报告。

    <section>
        <?php
        error_reporting(0);
        $link = mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db")        ;
        echo '数据库连接失败！';
        ?>
    </section>

    <li>自动捕捉错误 的 line</li>
            Throwable
        ├─ Error
        │    ├─ ArithmeticError
        │    │     └─ DivisionByZeroError
        │    ├─ AssertionError
        │    ├─ CompileError
        │    │    └─ ParseError
        │    └─ TypeError
        │           └─ ArgumentCountError
        └─ Exception
                └─ ...（各种 Exception 的子类）
    <section>
    <?php
    try {
        $a = new cat();
    } catch (Error $e) {
        echo 'Error 的信息：' . $e->getMessage() . '<br>Error 发生的行号：' . $e->getLine();
    }
    ?>
    </section>


</ol>