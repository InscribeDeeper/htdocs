<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    mysqli_connect(
    [string $host = ini_get("mysqli.default_host")
    [, string $username = ini_get("mysqli.default_user")
    [, string $password = ini_get("mysqli.default_pw")
    [, string $dbname = ""
    [, int $port = ini_get("mysqli.default_port")
    [, string $socket = ini_get("mysqli.default_socket")
    ]]]]]] )


    mysqli_fetch_row()：从结果集中取得一行，并以索引数组的形式返回；
    mysqli_fetch_assoc()：从结果集中取得一行，并以关联数组的形式返回；
    mysqli_fetch_array()：从结果集中取得一行，并以关联数组、索引数组或二者兼有的形式返回；
    mysqli_fetch_all()：从结果集中取得所有行，并以关联数组、索引数组或二者兼有的形式返回；
    mysqli_fetch_object()：从结果集中取得一行，并以对象的形式返回。


    <li>面向过程风格的写法-> build a pipeline </li>
    mysqli_select_db(mysqli $link, string $dbname)
    <section>

        <?php
        $host     = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname   = 'test';
        $port     = '3306';
        $link     = @mysqli_connect($host, $username, $password, $dbname, $port);   // 连接到数据库
        if ($link) {
            mysqli_set_charset($link, 'UTF-8');      // 设置数据库字符集
            $sql    = 'select * from user';         // SQL 语句
            $result = mysqli_query($link, $sql);    // 执行 SQL 语句，并返回结果
            $data   = mysqli_fetch_all($result);    // 从结果集中获取所有数据
            mysqli_close($link);
        } else {
            die('数据库连接失败！');
        }
        echo '<pre>';
        print_r($data);
        ?>

        <?php
        $host     = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname   = 'test';
        $link     = @mysqli_connect($host, $username, $password);
        if ($link) {
            mysqli_select_db($link, $dbname);           // 选择名为 test 的数据库
            $sql    = 'select name,sex,age from user';  // SQL 语句
            $result = mysqli_query($link, $sql);        // 执行 SQL 语句，并返回结果
            $data   = mysqli_fetch_all($result);        // 从结果集中获取所有数据
            mysqli_close($link);
        } else {
            echo '数据库连接失败！';
        }
        echo '<pre>';
        print_r($data);
        ?>
    </section>

    <li>面向对象风格的写法</li>
    mysqli::select_db(string $dbname)
    <section>
        <?php
        $host     = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname   = 'test';
        $mysql    = new Mysqli($host, $username, $password, $dbname);
        if ($mysql->connect_errno) {
            die('数据库连接失败：' . $mysql->connect_errno);
        } else {
            $mysql->set_charset('UTF-8'); //  设置数据库字符集
            $sql = 'select * from user';         // SQL 语句
            $result = $mysql->query($sql);
            $data = $result->fetch_all();
            $mysql->close();
        }
        echo '<pre>';
        print_r($data);
        ?>

        <?php
        $host     = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname   = 'test';
        $mysql    = new Mysqli($host, $username, $password);
        if ($mysql->connect_errno) {
            die('数据库连接失败：' . $mysql->connect_errno);
        } else {
            $mysql->select_db($dbname);                  // 选择名为 test 的数据库
            $sql    = 'select name,sex,age from user';     // SQL 语句
            $result = $mysql->query($sql);               // 执行上面的 SQL 语句
            $data   = $result->fetch_all();
            $mysql->close();
        }
        echo '<pre>';
        print_r($data);
        ?>
    </section>

    <li>multi query</li>

    <section>
        <?php
        $host     = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname   = 'test';
        $mysql    = new Mysqli($host, $username, $password, $dbname);
        if ($mysql->connect_errno) {
            die('数据库连接失败：' . $mysql->connect_errno);
        } else {
            $sql    = 'select id,name from user;';  // SQL 语句
            $sql    .= 'select sex,age from user';  // SQL 语句
            if ($mysql->multi_query($sql)) {
                do {
                    if ($result = $mysql->store_result()) {
                        while ($row = $result->fetch_row()) {
                            print_r($row);
                        }
                        $result->free();
                    }
                    if ($mysql->more_results()) {
                        echo '<hr>';
                    } else {
                        break;
                    }
                } while ($mysql->next_result());
            }
            $mysql->close();
        }
        ?>

        <?php
        $host     = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname   = 'test';
        $link     = @mysqli_connect($host, $username, $password, $dbname);
        if ($link) {
            $sql    = 'select id,name from user;';  // SQL 语句
            $sql    .= 'select sex,age from user';  // SQL 语句
            $result = mysqli_multi_query($link, $sql);        // 执行 SQL 语句，并返回结果
            do {
                if ($data = mysqli_use_result($link)) {
                    while ($row = mysqli_fetch_row($data)) {
                        print_r($row);
                    }
                    mysqli_free_result($data);
                }
                if (mysqli_more_results($link)) {
                    echo '<hr>';
                } else {
                    break;
                }
            } while (mysqli_next_result($link));
            mysqli_close($link);
        } else {
            echo '数据库连接失败！';
        }
        ?>

    </section>

    <li>PDO 是 PHP Date Object（PHP 数据对象) </li>
    和ORM 的区别? ORM提供了实现持久化层的另一种模式，它采用映射元数据来描述对象关系的映射，使得ORM中间件能在任何一个应用的业务逻辑层和数据库层之间充当桥梁
    PDO::__construct(string $dsn[, string $username [, string $password [, array $driver_options]]])

    第一个是数据库名称，第二个是数据库地址

    <section>
        <?php
        $dsn  = 'mysql:dbname=test;host=127.0.0.1';
        $user = 'root';
        $pwd  = 'root';
        try {
            $obj = new PDO($dsn, $user, $pwd);
        } catch (PDOException $e) {
            echo '数据库连接失败：' . $e->getMessage();
        }
        ?>

        <?php
        $dsn  = 'uri:file:///install/phpstudy/WWW/dsn.txt';
        $user = 'root';
        $pwd  = 'root';
        try {
            $obj = new PDO($dsn, $user, $pwd);
        } catch (PDOException $e) {
            echo '数据库连接失败：' . $e->getMessage();
        }
        ?>
    </section>

    <li>table</li>
    <section>
    </section>

</ol>