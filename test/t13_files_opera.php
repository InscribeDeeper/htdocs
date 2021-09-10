<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    <li>files fgetc</li>
    在读取文件时，不仅要注意行结束符号\n，程序也需要一种标准的方式来识别何时到达文件的末尾，这个标准通常称为 EOF（End Of File）字符。
    EOF 是非常重要的概念，几乎每种主流的编程语言中都提供了相应的内置函数，来解析是否到达了文件 EOF。在 PHP 中，我们可以使用 feof() 函数。该函数接受个打开的文件资源，判断一个文件指针是否位于文件的结束处，如果在文件末尾处则返回 TRUE。
    <section>
        <?php
        header("Content-Type: text/html;charset=utf-8");    //设置字符编码
        $handle = fopen('./test.txt', 'r');                 //打开文件
        if (!$handle) {                                     //判断文件是否打开成功
            echo '文件打开失败！';
        }
        while (false !== ($char = fgetc($handle))) {        //循环读取文件内容
            echo $char;
        }
        fclose($handle);                                    //关闭文件
        ?>

        <?php
        $file = 'test.txt';
        $info = readfile($file);
        ?>
    </section>

    <li>读写</li>
    <section>
        <?php
        $fp = fopen('test.txt', 'w');
        fwrite($fp, 'http://c.biancheng.net/');
        fwrite($fp, 'php/');
        fclose($fp);
        echo "<pre>";
        print_r(file('test.txt'));
        ?>
    </section>

    <li>文件上传 </li>
    使用 $_FILES 与 HTML 表单相结合，获取上传文件的信息

    ; Whether to allow HTTP file uploads.
    ; http://php.net/file-uploads
    file_uploads = On

    ; Temporary directory for HTTP uploaded files (will use system default if not
    ; specified).
    ; http://php.net/upload-tmp-dir
    ;upload_tmp_dir =

    ; Maximum allowed size for uploaded files.
    ; http://php.net/upload-max-filesize
    upload_max_filesize = 100M

    ; Maximum number of files that can be uploaded via a single request
    max_file_uploads = 100

    ; Maximum amount of memory a script may consume (128MB)
    ; http://php.net/memory-limit
    memory_limit=256M

    ; Maximum execution time of each script, in seconds
    ; http://php.net/max-execution-time
    ; Note: This directive is hardcoded to 0 for the CLI SAPI
    max_execution_time = 300

    <section>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>C语言中文网——PHP文件上传</title>
        </head>

        <body>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="upfile">
                <input type="submit" value="上传">
            </form>
        </body>

        </html>
        <?php
        if (!empty($_FILES)) {
            foreach ($_FILES['upfile'] as $key => $value) {
                echo $key . '=>' . $value . '<br>';
            }
        }
        ?>
    </section>

    <li>文件上传</li>
    <section>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>C语言中文网——PHP文件上传</title>
        </head>

        <body>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="upfile">
                <input type="submit" value="上传">
            </form>
        </body>

        </html>
        <?php
        if (!empty($_FILES)) {
            $tmpname   = $_FILES['upfile']['tmp_name'];     // 临时文件名称
            $name      = $_FILES['upfile']['name'];         // 文件的原名称
            $path      = './uploads';                       // 上传目录
            $file_name = date('YmdHis') . rand(100, 999) . $name; // 避免文件重名，更改文件名称
            if (move_uploaded_file($tmpname, $path . '/' . $file_name)) {
                echo $name . " 上传成功！";
            } else {
                echo $name . " 上传失败！";
            }
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>C语言中文网——PHP文件上传</title>
        </head>

        <body>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="upfile[]"><br>
                <input type="file" name="upfile[]"><br>
                <input type="file" name="upfile[]"><br>
                <input type="submit" value="上传">
            </form>
        </body>

        </html>
        <?php
        if (!empty($_FILES)) {
            $tmpname = $_FILES['upfile']['tmp_name'];
            $name = $_FILES['upfile']['name'];
            $path = './uploads';
            for ($i = 0; $i < count($tmpname); $i++) {
                $file_name = date('YmdHis') . rand(100, 999) . $name[$i];
                if (move_uploaded_file($tmpname[$i], $path . '/' . $file_name)) {
                    echo $name[$i] . ' 上传成功！<br>';
                } else {
                    echo $name[$i] . ' 上传失败！<br>';
                }
            }
        }
        ?>
    </section>

    <li>遍历文件目录</li>
    <section>
        <?php
        function selectdir($dir, $level = 0)
        {
            //首先先读取文件夹
            $temp = scandir($dir);
            $level++;
            //遍历文件夹
            foreach ($temp as $v) {
                $a = $dir . '/' . $v;
                if (is_dir($a)) { //如果是文件夹则执行
                    if ($v == '.' || $v == '..') { //判断是否为系统隐藏的文件.和..  如果是则跳过
                        continue;
                    }
                    echo str_repeat('——', $level - 1) . $v, "<br/>";
                    selectdir($a, $level); //因为是文件夹所以再次调用 selectdir，把这个文件夹下的文件遍历出来
                } else {
                    echo str_repeat('——', $level - 1) . $v, "<br/>";
                }
            }
        }
        $path = "./joo";
        selectdir($path);
        ?>
    </section>

</ol>