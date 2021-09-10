<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    <?php
    print_r(gd_info());
    ?>
    <li>创建画布</li>
    imagecreatefromgif() 通过 GIF 文件或者 URL 新建一个图像
    imagecreatefromjpeg() 通过 JPEG 文件或者 UR 新建一个图像
    imagecreatefrompng() 通过 PNG 文件或者 UR L新建一个图像
    imagecreatefromwbmp() 通过 WBMP 文件或者URL，新建一个图像
    <section>
        <?php
        header('Content-Type: image/png');
        $im  = @imagecreate(100, 50) or die("画布1创建失败！");
        $img = @imagecreatetruecolor(120, 20) or die('画布2创建失败！');
        ?>

        <?php
        $img = @imagecreatetruecolor(120, 20) or die('画布创建失败！');
        echo '画布的宽度为：' . imagesx($img) . '像素';
        echo '<br>画布的高度为：' . imagesy($img) . '像素';
        ?>
    </section>

    <li>输出图片</li>
    在图像的所有资源使用完毕后，通常需要释放图像处理所占用的内存。在 PHP 中可以通过 imagedestroy() 函数来释放图像资源
    <section>
        <?php
        header('Content-type:image/jpeg');
        $image1 = imagecreatefromgif('http://c.biancheng.net/uploads/allimg/191023/1-1910231P5435C.gif');
        $image2 = imagecreatefromjpeg('./logo.jpg');
        imagepng($image1, 'php.png'); # 保存图片
        imagedestroy($image1);
        imagejpeg($image2);
        imagedestroy($image2);
        ?>
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