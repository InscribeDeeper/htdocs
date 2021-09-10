<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    <li>cookie</li>
    <section>
        <?php
        setcookie('Website', 'C语言中文网');
        setcookie('Title', 'Cookie', time() + 3600);  // 设置 Cookie 1 小时后过期
        setcookie('Url', 'http://c.biancheng.net/php/', time() + 3600, '/', 'c.biancheng.net', false);
        echo '<pre>';
        print_r($_COOKIE);
        ?>
    </section>

    <li>使用超全局变量 $_COOKIE 获取 Cookie 的值</li>
    <section>
        <?php
        if (!isset($_COOKIE['time'])) {                           //检测 Cookie 文件是否存在
            setcookie('time', date('Y-m-d H:i:s'));              //设置一个 Cookie 变量
            echo "第一次访问<br>";
        } else {
            echo "上次访问的时间为：" . $_COOKIE['time'] . '<br>';    //输出上次访问网站的时间
            setcookie('time', date('Y-m-d H:i:s'), time() + 60);      //设置保存 Cookie 失效的时间的变量
        }
        echo "本次访问的时间为：" . date('Y-m-d H:i:s');            //输出当前的访问时间
        ?>
    </section>

    <li>使用 setcookie() 函数将 Cookie 的值设置为空的方式来清除 Cookie</li>
    首次运行上面的代码会创建名为 url、name 的两个 Cookie；再次运行可以查看 Cookie 的值，并清除其中 url 的值；第三次运行可以查看清除后的结果
    <section>
        <?php
        echo '<pre>';
        if (!isset($_COOKIE['url']) && !isset($_COOKIE['name'])) {
            setcookie('url', 'http://c.biancheng.net/php/');
            setcookie('name', 'C语言中文网');
            echo '首次运行，设置 url、name 两个 Cookie 的值';
        } else if (isset($_COOKIE['url'])) {
            echo '查看 Cookie 的值，如下所示：<br>';
            print_r($_COOKIE);
            echo '清除 url 的值';
            setcookie('url', '');
        } else {
            print_r($_COOKIE);
        }
        ?>
    </section>

    <li>cookie 过期时间</li>
    <section>
        <?php
        echo '<pre>';
        if (!isset($_COOKIE['url']) && !isset($_COOKIE['name'])) {
            setcookie('url', 'http://c.biancheng.net/php/');
            setcookie('name', 'C语言中文网');
            echo '首次运行，设置 url、name 两个 Cookie 的值';
        } else if (isset($_COOKIE['url'])) {
            echo '查看 Cookie 的值，如下所示：<br>';
            print_r($_COOKIE);
            echo '清除 url 的值';
            setcookie('url', 'http://c.biancheng.net/php/', time() - 1);
        } else {
            print_r($_COOKIE);
        }
        ?>
    </section>

    <li>自动登录</li>
    <section>
        <?php
        /**
         * 首页
         */
        function index()
        {
            $logout = isset($_POST['logout']) ? $_POST['logout'] : '';
            $user   = isset($_COOKIE['user']) ? $_COOKIE['user'] : '';
            $rem    = isset($_COOKIE['remember']) ? $_COOKIE['remember'] : '';
            if ($logout == 'true') {  //判断是否执行退出登陆
                logout();
            } else if ($user == '') {  //如果Cookie中没有用户信息则执行登陆操作
                login();
            } else {  //显示首页
                //首页的html代码
                $str = <<<html
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>C语言中文网</title>
                </head>
                <body>
                    <form action="" method="post">
                        <p><input type="hidden" value="true" name="logout" /></p>
                        <p><input type="submit" value="退出登陆" /></p>
                    </form>
                </body>
                </html>
            html;
                echo $str;
            }
        }
        /**
         * 登陆
         */
        function login()
        {
            //获取提交的用户信息
            $user   = isset($_POST['user']) ? trim($_POST['user']) : '';
            $pwd    = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';
            $rem    = isset($_POST['remember']) ? $_POST['remember'] : '';
            if ($user == '') {    //如果用户名为空，则显示登陆页面
                // 登陆页面的html代码
                $info = <<<html
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>C语言中文网</title>
                </head>
                <body>
                    <form action="" method="post">
                        <p>用户名：<input type="text" name="user" /></p>
                        <p>密&emsp;码：<input type="password" name="pwd" /></p>
                        <p><input type="checkbox" name="remember" value='true'/>自动登陆</p>
                        <p><input type="submit" value="登 陆" />&emsp;&emsp;<input type="reset" value="重 置" /></p>
                    </form>
                </body>
                </html>
            html;
                echo $info;
            } else {
                if (!empty($user) && !empty($pwd)) {  // 登陆成功，并记录Cookie信息
                    if ($rem != '') {
                        setcookie('user', $user, time() + 3600 * 24 * 7);
                        setcookie('remember', $rem, time() + 3600 * 24 * 7);
                    } else {
                        setcookie('user', $user);
                    }
                    echo '<script>alert(\'登陆成功\');location.replace(location.href);</script>';
                } else {  //登陆失败时，刷新页面
                    echo '<script>alert(\'用户名或密码不能为空\');location.replace(location.href);</script>';
                }
            }
        }
        /**
         * 退出登陆
         */
        function logout()
        {
            // 清除 Cookie 信息，并刷新页面
            isset($_COOKIE['user']) ? setcookie('user', '', time() - 1) : '';
            isset($_COOKIE['remember']) ? setcookie('remember', '', time() - 1) : '';
            echo '<script>alert(\'退出成功\');location.replace(location.href);</script>';
        }

        index(); //执行 index 函数
        ?>
    </section>



    <li>使用 $_SESSION 定义 Session，并获取 Session 的值。</li>
    <section>
        <?php
        session_start();
        $str = 'C语言中文网';
        $arr = ['Session', '$_SESSION'];
        $_SESSION['name']  = $str;
        $_SESSION['url']   = 'http://c.biancheng.net/php/';
        $_SESSION['title'] = $arr;
        foreach ($_SESSION as $key => $value) {
            if (is_array($value)) {
                echo $key . '：';
                print_r($value);
            } else {
                echo $key . ' = ' . $value . '<br>';
            }
        }
        ?>
    </section>



    <li>session_destroy()</li>
    <section>
    session_destroy() 函数不需要传入任何参数，另外，session_destroy() 函数虽然可以销毁当前会话中的全部数据，但是不会重置 $_SESSION 数组，也不会重置 Cookie。如果需要再次使用 Session 会话，则必须重新调用 session_start() 函数。
    注意：使用 $_SESSION = array() 清空 $_SESSION 数组的同时，也将这个用户在服务器端对应的 Session 文件内容清空。而使用 session_destroy() 函数时，则是将这个用户在服务器端对应的 Session 文件删除。
    </section>


    <li>cookie 过期时间</li>
    <section>
    </section>


    <li>cookie 过期时间</li>
    <section>
    </section>



</ol>