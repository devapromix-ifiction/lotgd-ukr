<?php
// translator ready
// mail ready
// addnews ready
function findgem_getmoduleinfo(){
	$info = array(
		"name"=>"Знайдено Рубін",
		"version"=>"1.1",
		"author"=>"Eric Stevens",
		"category"=>"Forest Specials",
		"download"=>"core_module",
	);
	return $info;
}

function findgem_install(){
	module_addeventhook("forest", "return 100;");
	module_addeventhook("travel", "return 10;");
	return true;
}

function findgem_uninstall(){
	return true;
}

function findgem_dohook($hookname,$args){
	return $args;
}

function findgem_runevent($type,$link)
{
	global $session;
	output("`^Ви знайшли в багнюці великий `%рубін`^!`0");
	$session['user']['gems']++;
	debuglog("found a gem in the dirt");
}

function findgem_run(){
}
?>
