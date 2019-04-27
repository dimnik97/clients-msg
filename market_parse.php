<?php

/*$json_goods = json_decode(file_get_contents('https://api.vk.com/method/market.get?access_token=45e3df0083acd214c19217332b87eec8833b872f5b2f5c20dee81aadb7a049972ea4aed485802cf9d3342&owner_id=-167496838&v=5.95'), true);

echo $json_goods["response"]["items"][0]["description"];*/


$json_good_by_id = json_decode(file_get_contents('https://api.vk.com/method/market.getById?access_token=45e3df0083acd214c19217332b87eec8833b872f5b2f5c20dee81aadb7a049972ea4aed485802cf9d3342&item_ids=-167496838_2233584&v=5.95'), true);

$description = $json_good_by_id["response"]["items"][0]["description"];

echo $description;

// если есть слово "девочки", переменной пол присваиваем ж, если есть слово "мальчика", переменной пол присваиваем м. если есть слово "возраст", после него парсим цифру и присваиваем переменной возраст, если есть слово "рост", после него парсим цифру и присваиваем переменной рост. 

if (strstr($description, "мальчика") !== false) {
	$gender = "м";
}
else {
	$gender = "ж";
}

$pos1 = strpos($description, "Возраст");
$pos2 = strpos($description, "Рост");

if ($pos1 !== false) {
	$age = substr($description, $pos1+16, 1);
}
else {
	$height = substr($description, $pos2+10, 3);
}

//если age непустая, нужно взять gender и age и найти записи в таблице дети, где значения соответсвующих полей совпадают со значениями переменных
//если age пустая, нужно взять gender и height и найти записи в таблице дети, где значения соответсвующих полей совпадают со значениями переменных
// все найденные записи наеверное (я не знаю, как тут лучше) поместить в массив. пройтись по массиву и найти к каждому ребенку родителя, а у родителя найти поле c_info. вывести поле c_info 