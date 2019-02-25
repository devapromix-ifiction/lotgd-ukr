<?php
// addnews ready
// translator ready
// mail ready
require_once("common.php");
require_once("lib/commentary.php");
require_once("lib/villagenav.php");
require_once("lib/events.php");
require_once("lib/http.php");

tlschema("gardens");

page_header("Магічний Сад");

addcommentary();
$skipgardendesc = handle_event("gardens");
$op = httpget('op');
$com = httpget('comscroll');
$refresh = httpget("refresh");
$commenting = httpget("commenting");
$comment = httppost('insertcommentary');
// Don't give people a chance at a special event if they are just browsing
// the commentary (or talking) or dealing with any of the hooks in the village.
if (!$op && $com=="" && !$comment && !$refresh && !$commenting) {
	if (module_events("gardens", getsetting("gardenchance", 0)) != 0) {
		if (checknavs()) {
			page_footer();
		} else {
			// Reset the special for good.
			$session['user']['specialinc'] = "";
			$session['user']['specialmisc'] = "";
			$skipgardendesc=true;
			$op = "";
			httpset("op", "");
		}
	}
}
if (!$skipgardendesc) {
	checkday();

	output("`b`c`2Магічний Сад`0`c`b`n");
	output("Ви проходите через ворота і неквапливо крокуєте однією з багатьох звивистих доріжок, які пробираються через добре доглянутий чарівний сад. Сонм різноманітних квіткових запахів лоскочить ніс і наводить на приємні думки.`n`n");
	output("Тут все заворожує - від гарних клумб, які пишно квітнуть навіть у найтемніших закутках, до високмх живоплотів, чиї тіні обіцяють розкрити заборонені таємниці.");
	output("Цей сад є притулком для тих, хто шукає Зеленого Дракона; місце, де вони можуть забути про свої проблеми на деякий час і просто розслабитися.`n`n");
	output("Одна з чарівних фей, що великим роєм гудять над квітучим садом, підлітає ближче, щоб нагадати Вам, що сад є місцем для спокійних і мирних розмов і не потрібно порушувати цю умову.`n`n");
}

villagenav();
modulehook("gardens", array());

commentdisplay("", "gardens","Кілька відвідувачів неподалік про щось мирно розмовляють. Скажіть і Ви щось:",30,"whispers");

module_display_events("gardens", "gardens.php");
page_footer();
?>