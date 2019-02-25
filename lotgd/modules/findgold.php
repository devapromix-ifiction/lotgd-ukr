<?php
// translator ready
// mail ready
// addnews ready
function findgold_getmoduleinfo(){
	$info = array(
		"name"=>"Знайдено Золото",
		"version"=>"1.1",
		"author"=>"Eric Stevens",
		"category"=>"Forest Specials",
		"download"=>"core_module",
		"settings"=>array(
			"Унікальна Подія -> Знайдено Золото -> Налаштування,title",
			"mingold"=>"Мінімальна к-сть золота (множиться на рівень),range,0,50,1|10",
			"maxgold"=>"Максимальна к-сть золота (множиться на рівень),range,20,150,1|50"
		),
	);
	return $info;
}

function findgold_install(){
	module_addeventhook("forest", "return 100;");
	module_addeventhook("travel", "return 20;");
	return true;
}

function findgold_uninstall(){
	return true;
}

function findgold_dohook($hookname,$args){
	return $args;
}

function findgold_runevent($type,$link)
{
	global $session;
	$min = $session['user']['level']*get_module_setting("mingold");
	$max = $session['user']['level']*get_module_setting("maxgold");
	$gold = e_rand($min, $max);
	output("`^Фортуна всміхнулась Вам і Ви знайшли %s золота!`0", $gold);
	$session['user']['gold']+=$gold;
	debuglog("found $gold gold in the dirt");
}

function findgold_run(){
}
?>
