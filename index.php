<?php

//Фразы для завтравки
$allPhrases = ["Ну здравствуй, здравствуй", "Ничего себе! Вы так изменились, а может, я просто давно Вас не видел", "Не верю своим глазам! А ну-ка, протрите-ка мне стекла", "Мне кажется, или я реально Вас вижу", "Ну ничего себе какие люди нарисовались перед моими глазами", "О, здравствуй, мой драгоценный друг", "Самое необычное, что сегодня могло со мной произойти – это встреча с Вами", "Стоп! Стоп! Стоп! Дайте я Вас сфотографирую, иначе никто не поверит, что я Вас видел", "Вот это подарок! Я вижу Вас своими глазами", "Машу Вам рукой! Машу ногой! Могу и головой помахать! Привет, я рад Вас видеть", "Вы от меня так настойчиво прятался, но я все-таки Вас выследил. Дружище", "Вы знаете, я рад Вас видеть сегодня даже больше, чем солнышко на небе", "Вы так хорошо выглядишь! Не пропадай! Давай чаще здороваться", "Сколько лет и сколько зим! ТЫ всегда неотразим", "Привет! Вы всегда вовремя, как ложка к обеду", "Привет! Не вижу причин, чтобы не зажать Вас в своих крепких объятых", "Это самое яркое событие дня – Вы передо мной", "Вы – единственный человек, которого я так рад видеть! Здравствуй", "Здравствуй, дорогой человек! Как же мне хорошо, когда я на Вас смотрю", "О, да! Вы мой подарок на сегодня", "Дай-ка я Вас расцелую от счастья"];
shuffle($allPhrases);

?>

<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Установка счетчиков воды в день обращения">

    <title>MODx мастер</title>

    <!-- Bootstrap core CSS -->
	<link href="/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/chat/main.css" rel="stylesheet" />
  </head>

  <body>
	<div class="chat_block">
		<div class="chat_block-row">
		<div id="chat" class="conv-form-wrapper">
			<form action="" method="POST" class="hidden">
				<select data-conv-question="Привет! Я виртуальный помощник, который помогает оформить заказ. Хотите поговорить? <span class='colorlight'>Нужно выбрать ответ</span>" name="first-question">
					<option value="yes">Давай</option>
					<option value="sure">Конечно поболтаем!</option>
				</select>
				<input type="text" name="name" data-conv-question="Тогда поехали! Сначала скажите Ваше имя, пожалуйста.| Хорошо! Как мне к Вам обращаться?" data-pattern="^[a-zA-Zа-яА-Я]*$">
				<input type="text" data-conv-question="<? echo $allPhrases[0]; ?>!" data-no-answer="true">
				<select name="multi" data-conv-question="Какая услуга вам необходима, <span class='upper'>{name}:0</span>?<span class='colorlight'></span>">
					<option value="1">Хочу новый сайт</option>
					<option value="2">Тех.поддержка</option>
					<option value="3">Оплата</option>
				</select>
				<div data-conv-fork="multi">
					<div data-conv-case="1">
						<input type="text" data-conv-question="Снимаю шляпу перед Вами!"  data-no-answer="true">
					</div>
					<div data-conv-case="2">
						<input type="text" data-conv-question="Бегите срочно мерить! После этого сообщите мне по рации." data-no-answer="true">
					</div>
					<div data-conv-case="3">
						<input type="text" data-conv-question="Высылаю ссылку для оплаты:<br /><a href='https://yoomoney.ru/to/41001647923334'>https://yoomoney.ru/to/41001647923334</a>">
					</div>
				</div>
				<div data-conv-fork="programmer">
					<div data-conv-case="yes">
						<input type="text" data-conv-question="Снимаю шляпу перед Вами!"  data-no-answer="true">
					</div>
					<div data-conv-case="no">
						<input type="text" data-conv-question="Бегите срочно мерить! После этого сообщите мне по рации." data-no-answer="true">
					</div>
					<input type="text" name="phonenumber" data-conv-question="Напишите свой телефон, я его передам вебмастеру. <span class='colorlight'>Пример: +79008007788 / даю свое согласие на <a href='#'>обработку персональных данных</a>.</span>" data-pattern="^\([\+]\d{11})?$" data-maxlength="12" required>
				</div>
				<input type="text" data-conv-question="Прекрасно, {phonenumber}:0! Красивый номер." data-no-answer="true">
				<input data-conv-question="<span class='upper'>{name}:0</span>, пришлите мне код домофона, и я привезу вам бутылочку пенного." type="password" data-minlength="6" id="senha" name="password" required placeholder="password">
				
				<input type="text" data-conv-question="{password}" data-no-answer="true">
				<select name="callbackTest" data-conv-question="Хочу только спросить, развратных девушек захватить?">
					<option value="">Конечно</option>
					<option value="">Конечно, да!</option>
				</select>
				<input type="text" data-conv-question="<img src='img/pilula.png' width='100' />" data-images="true" data-no-answer="true">
				<input type="text" data-conv-question="Вот вам витаминка, не забудьте её выпить." data-no-answer="true">
				<select data-conv-question="Все, я собрал чемоданы и отложил захват мира на пару дней, уже лечу!" id="">
					<option value="">Превосходно!</option>
				</select>
			</form>
		</div>
	</div></div>
 
	<script src="/js/jquery-3.1.1.min.js"></script>
	<script src="/js/jquery.convform.js?v1.1"></script>
<script>
	var convForm = $('#chat').convform({selectInputStyle: 'disable'});
	console.log(convForm);
</script>
</body>
</html>