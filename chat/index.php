<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>The Doctor</title>
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="main.css" />
  </head>
  <body>
	<section id="demo">
		<div class="vertical-align">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 col-xs-offset-0">
						<div class="card no-border">
							<div id="chat" class="conv-form-wrapper">
								<form action="" method="GET" class="hidden">
									<select data-conv-question="Здравствуйте! Я виртуальный доктор, который контролирует температуру сотрудников. Могу вам составить компанию, хотите поговорить? (Нужно выбрать ответ)" name="first-question">
										<option value="yes">Давай</option>
										<option value="sure">Конечно поболтаем!</option>
									</select>
									<input type="text" name="name" data-conv-question="Тогда поехали! Сначала скажите Ваше имя, пожалуйста.| Хорошо! Как мне к Вам обращаться?">
									<input type="text" data-conv-question="Ну здравствуйте, здравствуйте, {name}:0! Выпьем за знакомство!" data-no-answer="true">
									<input type="text" data-conv-question="Я попробую больше о Вас узнать, чтобы стать Вам электронным другом, давай начнем!" data-no-answer="true">
									<select name="multi[]" data-conv-question="Какое пиво вы бы выпили сейчас {name}:0!?" multiple>
										<option value="Светлое">Светлое</option>
										<option value="Темное">Темное</option>
										<option value="Крафтовое">Крафтовое</option>
										<option value="Лимонадика бы (нет)">Лимонадика бы (нет)</option>
									</select>
									<select name="programmer" data-conv-question="Итак {name}:0!, вы опытный ал..программист смотрю! Много времени проводите за компом {name}:0!?">
										<option value="yes">24/7</option>
										<option value="no">8/5</option>
									</select>
									<div data-conv-fork="programmer">
										<div data-conv-case="yes">
											<input type="text" data-conv-question="Снимаю шляпу перед Вами!" data-no-answer="true">
										</div>
										<div data-conv-case="no">
											<select name="thought" data-conv-question="Вы когда-нибудь думали оторваться от компа и увидеть солнечный свет?">
												<option value="yes">Да, нет наверное</option>
												<option value="no">Нет, наверное</option>
											</select>
										</div>
									</div>
									<input type="text" data-conv-question="Поздравляю, вы вступили в клуб по интересам, куда выслать бутылочку пенного?" data-no-answer="true">
									<input data-conv-question="Напиши мне свою почту, чтобы я вычеслил Вас по IP {name}:0!" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" id="email" type="email" name="email" required placeholder="What's your e-mail?">
									<input data-conv-question="А теперь код домофона" type="password" data-minlength="6" id="senha" name="password" required placeholder="password">

									<select name="callbackTest" data-conv-question="Ну все, мы договорились, хочу только спросить, развратных девушек захватить?">
										<option value="yes" data-callback="rollback">Коненчо</option>
										<option value="no" data-callback="restore">Конечно да!</option>
									</select>
									<select data-conv-question="Все, я собрал чемоданы и отложил захват мира на пару дней, уже лечу!" id="">
										<option value="">Превосходно!</option>
									</select>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<div class="dialog-cb-button"><a href="#"></a></div>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.convform.js"></script>
<script>
	function google(stateWrapper, ready) {
		window.open("https://google.com");
		ready();
	}
	function bing(stateWrapper, ready) {
		window.open("https://bing.com");
		ready();
	}
	var rollbackTo = false;
	var originalState = false;
	function storeState(stateWrapper, ready) {
		rollbackTo = stateWrapper.current;
		console.log("storeState called: ",rollbackTo);
		ready();
	}
	function rollback(stateWrapper, ready) {
		console.log("rollback called: ", rollbackTo, originalState);
		console.log("answers at the time of user input: ", stateWrapper.answers);
		if(rollbackTo!=false) {
			if(originalState==false) {
				originalState = stateWrapper.current.next;
					console.log('stored original state');
			}
			stateWrapper.current.next = rollbackTo;
			console.log('changed current.next to rollbackTo');
		}
		ready();
	}
	function restore(stateWrapper, ready) {
		if(originalState != false) {
			stateWrapper.current.next = originalState;
			console.log('changed current.next to originalState');
		}
		ready();
	}
		
	jQuery(function($){
		var convForm = $('#chat').convform({selectInputStyle: 'disable'});
		console.log(convForm);
	});	
</script>
</body>
</html>