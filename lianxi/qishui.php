<?php
// class father{
// 	private $str="hello";
// 	function fun1(){
// 		echo "$this->str";
// 	}
// }
// class son extends father{
// 	private $str="hello-son";

// }
// $ob=new son;
// $ob->fun1();
class Foo{
	private $name='hdj';
	public function getName(){
		return $this->name;
	}
}
class Bar extends Foo{
   public $naem='dedeka';
}
$bar=new Bar;
var_dump($bar->name);
var_dump($bar->getName());
