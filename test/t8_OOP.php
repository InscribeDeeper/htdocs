<?php
define('SCRIPT_ROOT', 'http://localhost/test');
echo '<link rel="stylesheet" type="text/css" href="' . SCRIPT_ROOT . '/css/style.css">';
?>

<ol>
    <li>table</li>
    public：公共的，在类的内部、子类中或者类的外部都可以使用，不受限制；
    protected：受保护的，在类的内部和子类中可以使用，但不能在类的外部使用；
    private：私有的，只能在类的内部使用，在类的外部或子类中都无法使用。
    提示：权限修饰符可以和定义静态变量的关键字 static 混合在一起使用，如上面代码中所示。
    <section>
        <?php
        class Students
        {
            var $name;
            public $age;
            private $sex;
            public static $school;
            public function Write(string $a, int $b): bool
            {
            }
            protected static function Read(string $str): int
            {
            }
            function Listen(int $num): bool
            {
            }
        }
        ?>
    </section>

    <li>访问对象中的成员</li>
    只能通过对象的引用来访问对象中的成员。但还要使用一个特殊的运算符号->来完成对象成员的访问，访问对象中成员的语法格式如下所示：
    变量名 = new 类名(参数); //实例化一个类
    变量名 -> 成员属性 = 值; //为成员属性赋值
    变量名 -> 成员属性; //直接获取成员属性的值
    变量名 -> 成员方法(); //访问对象中的成员方法
    <section>
        <?php
        class Website1
        {
            public $name, $url, $title;
            public function demo()
            {
                echo '成员方法 demo()';
            }
        }
        $student = new Website1();
        $student->name = 'C语言中文网';
        $student->url = 'http://c.biancheng.net/php/';
        $student->title = '实例化对象';
        echo $student->name . '<br>';
        echo $student->url . '<br>';
        echo $student->title . '<br>';
        $student->demo();
        ?>
    </section>

    <li>table</li>
    <section>
        <?php
        class Website3
        {
            public $name, $url, $title;
            public function __construct($str1, $str2, $str3)
            {
                $this->name  = $str1;
                $this->url   = $str2;
                $this->title = $str3;
                $this->demo();
            }
            public function demo()
            {
                echo $this->name . '<br>';
                echo $this->url . '<br>';
                echo $this->title . '<br>';
            }
        }
        $object = new Website3('C语言中文网', 'http://c.biancheng.net/php/', '构造函数');
        ?>
    </section>

    <li>public function __destruct()</li>
    析构函数的作用和构造函数正好相反，析构函数只有在对象被垃圾收集器收集前（即对象从内存中删除之前）才会被自动调用。析构函数允许我们在销毁一个对象之前执行一些特定的操作，例如关闭文件、释放结果集等。
    <section>
        <?php
        class Website2
        {
            public $name, $url, $title;
            public function __construct()
            {
                echo '------这里是构造函数------<br>';
            }
            public function __destruct()
            {
                echo '------这里是析构函数------<br>';
            }
        }
        $object = new Website2();
        echo 'C语言中文网<br>';
        echo 'http://c.biancheng.net/php/<br>';
        echo '脚本运行结束之前会调用对象的析构函数<br>';
        ?>
    </section>

    <li>API继承 extend</li>
    <section>
        <?php
        class Website
        {
            public $name, $url, $title;
            public function __construct()
            {
                echo '------基类中的构造函数------<br>';
            }
            public function demo()
            {
                echo '基类中的成员方法<br>';
            }
        }
        class ClassOne extends Website
        {
        }
        class ClassTwo extends Website
        {
            public function __construct()
            {
                echo '------子类中的构造函数------<br>';
            }
        }
        $object = new ClassOne();
        $object->demo();
        $object2 = new ClassTwo();
        $object2->demo();
        ?>
    </section>



    <li>类中使用 private 修饰的成员被称为私有成员。父类中的私有成员不会被子类继承，因此不能被子类访问到</li>
    <section>
        <?php
        class Website41
        {
            private function demo12()
            {
                echo '基类中的成员方法<br>';
            }
        }
        class ClassOne1 extends Website41
        {
            public function test()
            {
                $this->demo12();
            }
        }
        $object = new ClassOne1();
        $object->test();
        ?>
    </section>



    <li>受保护的成员不可以在类外部访问到，但是可以在子类的内部访问</li>
    <section>
        <?php
        class Website12
        {
            public $name, $url, $title;
            public function __construct()
            {
                echo '------基类中的构造函数------<br>';
            }
            protected function demo()
            {
                echo '基类中的成员方法<br>';
            }
        }
        class ClassOne12 extends Website12
        {
        }
        class ClassTwo12 extends Website12
        {
            public function __construct()
            {
                echo '------子类中的构造函数------<br>';
            }
            public function test()
            {
                $this->demo();
            }
        }
        $object = new ClassOne12();
        // $object -> demo();      // 在子类中调用父类使用 protected 修饰的成员方法会报错
        $object2 = new ClassTwo12();
        $object2->test();
        ?>
    </section>



    <li>this的使用, 需要 -> name来指代 他的属性或者方法</li>
    <section>
        <?php
        class Website111
        {
            public $name;
            public function __construct($name)
            {
                $this->name = $name;
                $this->name();
            }
            public function name()
            {
                echo $this->name . '<br>';
                $this->url();
            }
            public function url()
            {
                echo 'http://c.biancheng.net/php/<br>';
                $this->title();
            }
            public function title()
            {
                echo 'PHP入门教程<br>';
            }
        }
        $object = new Website111('C语言中文网');
        ?>
    </section>


    <li>namespace</li>
    与目录和文件的关系很象，PHP 中的命名空间也允许指定层次化的命名空间名称。因此，命名空间的名字可以使用分层次的方式定义
    namespace App\Model;
    namespace App\Controller\Home;

    <section>
        在讨论如何使用命名空间之前，必须了解 PHP 是如何知道要使用哪一个命名空间中的元素的。我们可以将 PHP 命名空间与文件系统作一个简单的类比。在文件系统中访问一个文件有三种方式：
        相对文件名形式如 foo.txt。它会被解析为 currentdirectory/foo.txt，其中 currentdirectory 表示当前目录。因此如果当前目录是 /home/foo，则该文件名被解析为 /home/foo/foo.txt；
        相对路径名形式如 subdirectory/foo.txt。它会被解析为 currentdirectory/subdirectory/foo.txt；
        绝对路径名形式如 /main/foo.txt。它会被解析为 /main/foo.txt。

        PHP 命名空间中的元素使用同样的原理。例如，命名空间下的类名可以通过三种方式引用：
        非限定名称，或不包含前缀的类名称，例如$a=new foo();或foo::staticmethod();。如果当前命名空间是 currentnamespace，那么 foo 将被解析为 currentnamespace\foo。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，则 foo 会被解析为 foo。
        限定名称，或包含前缀的名称，例如$a = new subnamespace\foo();或subnamespace\foo::staticmethod();。如果当前的命名空间是 currentnamespace，则 foo 会被解析为 currentnamespace\subnamespace\foo。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，foo 会被解析为 subnamespace\foo。
        完全限定名称，或包含了全局前缀操作符的名称，例如$a = new \currentnamespace\foo();或\currentnamespace\foo::staticmethod();。在这种情况下，foo 总是被解析为代码中的文字名 currentnamespace\foo。
        警告：如果命名空间中的函数或常量未定义，则该非限定的函数名称或常量名称会被解析为全局函数名称或常量名称。
    </section>

</ol>