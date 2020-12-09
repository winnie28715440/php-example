<pre>
<?php

//php class的變數前要先宣告屬性
class MyCLASS
{
    var $name;
    public $mobile; //公開的變數
    private $sno = 'secret'; //私人的變數

    public function __construct($name = 'noname')
    {
        $this->name = $name;
        // echo $this->name;
    }
}

$a = new MyClass(); // 實體
echo "$a->name <br>";


$b = new MyClass('david');
echo "$b->name <br>";



?>
</pre>