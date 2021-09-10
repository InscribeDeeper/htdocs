<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    <li>table</li>
    <section>
        <?php
        echo '<table border="1">';
        $x = 0;
        while ($x < 10) {
            echo '<tr align="center">';
            $y = 0;
            while ($y < 10) {
                echo '<td>' . ($x * 10 + $y) . '</td>';
                $y++;
            }
            echo '</tr>';
            $x++;
        }
        echo '</table>';
        ?>
    </section>
    <li>9x9</li>
    <?php
    for ($i = 1; $i <= 9; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo $j . ' * ' . $i . ' = ' . $i * $j . '&nbsp;&nbsp;';
        }
        echo '<br>';
    }
    ?>


    <section>
    </section>
    <li>foreach</li>
    <?php
    $array = [0, 1, 2];
    foreach ($array as $val) {
        echo "值是：" . $val;
        echo "<br/>";
    }
    foreach ($array as $key => $value) {
        echo "键名是：" . $key . "值是：" . $value;
        echo "<br/>";
    }
    ?>

    <section>
    </section>
    <li>Include</li>
    <?php
    include './demo.php';
    echo $str;
    echo 'require 语句和 include 语句几乎完全一样，不同的是当被包含文件不存或存在错误时，require 语句会发出一个 Fatal error 错误并终止程序执行，而 include 则会发出一个 Warining 警告但程序会接着向下执行。';

    ?>


    <section>
    </section>
    <li>特殊标识符</li>
    <section>
    </section>




</ol>