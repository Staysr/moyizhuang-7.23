<?php
header("Content-type: text/html; charset=utf-8");
$gold=[];
$m_array=array();
$all_gold=array();
$m_date1=array(
    'price' => '79',
    'product' => '56',
    'shop' => '56',
);
$m_date2=array(
    'price' => '322',
    'product' => '56',
    'shop' => '44',
); 
$m_date3=array(
    'price' => '299',
    'product' => '00',
    'shop' => '()',
);
$m_date4=array(
    'price' => '300',
    'product' => '**',
    'shop' => '&&',
);
$m_date5=array(
    'price' => '299',
    'product' => '^^',
    'shop' => '%%',
);
array_push($m_array,$m_date1,$m_date2,$m_date3,$m_date4,$m_date5);

for($i=0;$i<count($m_array);$i++){
    if(array_key_exists( $m_array[$i]['shop'], $gold) ){
        
       array_push($gold[$m_array[$i]['shop']],$m_array[$i]);

      }
    else{
        $gold[$m_array[$i]['shop']][0]=$m_array[$i];
    }
}
$pt = array (
            '妇 福' =>
                array (

                    'price' => '310',
                    'product' => '999',
                    'shop' => '66',

                ),
            '李江鹏'=>
              array(
                  array (
                      'price' => '300',
                      'product' => '将鹏',
                      'shop' => '鹏将',
                    ),
                  array(
                      'price' => 'pt',
                      'product' => '哈哈',
                      'shop' => '嘿嘿',
                    )
                )
);
   $all_gold=array(
         'pt' => $pt,
         'gold' => $gold
     );
echo "<br>";
var_dump($all_gold);