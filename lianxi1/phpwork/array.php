<?php
/*
 *练习一
 * 创建一个数组
 *输出最大和最小
 * */
$text = 21323;
$int1 = 99879;
$int2 = 99879;
$int3 = 343242;
$int4 = 5223;
$arr = array(
    'text' => $text,
    'int1' => $int1,
    'int2' => $int2,
    'int3' => $int3,
    'int4' => $int4
);
print_r($arr);//输出数组
echo "<br/>";
echo "最大值:" . max($arr);//输出数组最大值
echo "<br/>";
echo "最小值" . min($arr);//输出数组最小值
echo "<br/>";

echo "-------------------------------------------------------------------------------------------------";
echo "<br/>";

function fun1($i)
{
    echo $i + 100;
    echo "<br/>";
}

function fun2($j)
{
    echo $j * 100;
    echo "<br/>";
}

$value = 100;
if ($value > 100) {
    fun1($value);
} else {
    fun2($value);
}
echo "<br/>";


echo "---------------------------------------------------------------------------------------------------------";


//php语言编写一个程序编写一个程序,用户输入一个正整数,把它的各位数字前后颠倒一下,并输出颠倒后的结果
function reverseNo($number)
{
    $res = "";
    for ($i = 0; ; $i++) {
        if ($number < 10) {
            return $res . $number;
        }
        $n = $number % 10;
        $res .= $n;
        $number = (int)($number / 10);
    }
}

$number = 41235345;
$res = reverseNo($number);
echo "<br/>";
echo $res;

$number = 0;
//使用for循环
for ($number = 200; $number < 300; $number++) {
    //取出百位数
    $bai = $number / 100;
    //取出十位数
    $shi = $number % 100 / 10;
    //取出个位数
    $ge = $number % 10;
    //计算三个数字之积
    $cheng = $ge * $shi * $bai;
    //计算三个数字之和
    $jia = $ge + $shi + $bai;
    //如果积等于42并且和为12，则将满足条件的数输出
    if ($cheng == 42 & $jia == 12) {
        print_r($number);

    }
    echo "<br/>";
    print_r($number);
}
