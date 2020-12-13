<pre>
<?php

class MyClass
{
    // var $name;
    var $y;
    public $mobile;
    private $sno = 'secret';
    // protected

    // public function __construct($name='noname')
    public function __construct($name = 'noname')
    {
        // 相當於java的'.'
        $this->y = $name;
    }
    function myMethod1()
    {
    }
}

$a = new MyClass(); // 實體
echo "$a->y <br>";
