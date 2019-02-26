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
			"maxgold"=>"Максимальна к-сть золота (множиться на рівень),range,20,150,1|20",
			
			"Унікальна Подія -> Знайдено Золото -> Повідомлення,title",
			"goldmsg1"=>"Випадкове повідомлення #1|Поряд із ледь помітною стежкою, біля великого сірого каменя, Ви знайшли мішечок, а ньому %s золотих монет!",
			"goldmsg2"=>"Випадкове повідомлення #2|Ви піднімаєте із багнюки невеличкий шкіряний гаманець і стаєте багатшими на %s золотих монет.",
			"goldmsg3"=>"Випадкове повідомлення #3|Внутрішній голос змушує Вас озирнутися, і не дарма! За колючим кущем хтось сховав мішечок, а в ньому %s золотих монет.",
			"goldmsg4"=>"Випадкове повідомлення #4|Фортуна всміхнулась Вам і прямо посеред лісової стежки Ви знайшли %s золотих монет!",
			"goldmsg5"=>"Випадкове повідомлення #5|Неподалік пролетіла чарівна фея і загубила маленький гаманець, а в ньому %s золотих монет!",
			"goldmsg6"=>"Випадкове повідомлення #6|Обережно крадучись лісом Ви помітили, як щось блищить в пилюці під ногами. Виявилося, це %s золотих монет.",
			"goldmsg7"=>"Випадкове повідомлення #7|На темній лісовій галявині Ви помітили відблиск сонячного світла. Виявилося, що це %s золотих монет.",
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
	$str_arr = array();
	$str_arr[1] = get_module_setting("goldmsg1");
	$str_arr[2] = get_module_setting("goldmsg2");
	$str_arr[3] = get_module_setting("goldmsg3");
	$str_arr[4] = get_module_setting("goldmsg4");
	$str_arr[5] = get_module_setting("goldmsg5");
	$str_arr[6] = get_module_setting("goldmsg6");
	$str_arr[7] = get_module_setting("goldmsg7");
	$r = e_rand(1, 7);
	output("`n".$str_arr[$r], $gold);
	$session['user']['gold']+=$gold;
	debuglog("found $gold gold in the dirt");
}

function findgold_run(){
}
?>
