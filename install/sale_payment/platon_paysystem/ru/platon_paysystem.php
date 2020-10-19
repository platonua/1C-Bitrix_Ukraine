<?global $MESS;
$MESS["PLATON_PAYSYSTEM_DDESCR"]='Прием платежей в платежной системе <a href="https://platon.ua" target="_blank">Platon</a>';
$MESS["PLATON_PAYSYSTEM_DDESCR"]='Прием платежей в платежной системе Platon';

$MESS["PLATON_PAYSYSTEM_KEY"]='Ключ для идентификации клиента *';
$MESS["PLATON_PAYSYSTEM_KEY_DESC"]='Обязательный параметр. Назначается зарегистрированному в системе Platon пользователю.';

$MESS["PLATON_PAYSYSTEM_PASSWORD"]='Пароль идентификации клиента *';
$MESS["PLATON_PAYSYSTEM_PASSWORD_DESC"]=$MESS["PLATON_PAYSYSTEM_KEY_DESC"];

$MESS["PLATON_PAYSYSTEM_WEB_URL"]='Адрес Platon, на который передается (POST) оплата *';
$MESS["PLATON_PAYSYSTEM_WEB_URL_DESC"]=$MESS["PLATON_PAYSYSTEM_KEY_DESC"];

$MESS["PLATON_PAYSYSTEM_SUCCESS"]="Success URL *";
$MESS["PLATON_PAYSYSTEM_SUCCESS_DESC"]="Обязательный параметр. Адрес, на который возвращается Покупатель в случае успешной оплаты";

$MESS["PLATON_PAYSYSTEM_CANCEL"]="Cancel URL";
$MESS["PLATON_PAYSYSTEM_CANCEL_DESC"]="Адрес, на который возвращается Покупатель в случае неуспешной оплаты";

/////////////////////////////////////////////
$MESS["PLATON_PAYSYSTEM_ORDER_ID"]="Номер платежа";
$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"]="Не надо изменять";

$MESS["PLATON_PAYSYSTEM_SUMM"]="Сумма счета";
$MESS["PLATON_PAYSYSTEM_SUMM_DESC"]=$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"];

$MESS["PLATON_PAYSYSTEM_CURRENCY"]="Валюта";
$MESS["PLATON_PAYSYSTEM_CURRENCY_DESC"]=$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"];

$MESS["PLATON_PAYSYSTEM_USER_ID"]="Код покупателя";
$MESS["PLATON_PAYSYSTEM_USER_ID_DESC"]=$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"];

//////////////////////////////////////////////
$MESS["PLATON_PAYSYSTEM_PAYMENT_ORDER"]='заказ';
$MESS["PLATON_PAYSYSTEM_PAYMENT_DOP_INFO"]='Вы хотите оплатить через систему';
$MESS["PLATON_PAYSYSTEM_PAYMENT_DOP_TTL"]='Сумма к оплате по счету';
$MESS["PLATON_PAYSYSTEM_PAYMENT_DOP_SEND"]='Оплатить платежной картой';
$MESS["PLATON_PAYSYSTEM_PAYMENT_ELSE_SEND"]='Использовать другую карту';
$MESS["PLATON_PAYSYSTEM_PAYMENT_RECURRING_SEND"]='Купить с карты #CARD#';

$MESS["ERR_PLATON_PAYSYSTEM_KEY"]='Не указан ключ пользователя Platon';
$MESS["ERR_PLATON_PAYSYSTEM_PASSWORD"]='Не указан пароль пользователя Platon';
$MESS["ERR_PLATON_MODULE_URL"]='Не указан адрес отправки POST запроса';
$MESS["ERR_PLATON_REQUEST_SUCCESS_URL"]='Не указан адрес для получения результата';
$MESS["ERR_PLATON_MODULE_PAYSYSTEM"]='Ошибка платежной системы';
$MESS["ERR_PLATON_PAYSYSTEM_PARAM"]='Не указан обязательный параметр: #PARAM#!';
$MESS["ERR_PLATON_PAYSYSTEM_PRICE"]='Несоответствие цены заказа (#PRICE#) оплаченной сумме (#AMOUNT#)!';
$MESS["ERR_PLATON_PAYSYSTEM_CURRENCY"]='Несоответствие валюты заказа (#CURRENCY1#) оплаченной валюте (#CURRENCY2#)!';
$MESS["ERR_PLATON_PAYSYSTEM_SIGN"]='Ошибка. Неверная сигнатура.';
$MESS["ERR_PLATON_PAYSYSTEM_REFUND"]='Возврат денег продавцом.';
$MESS["ERR_PLATON_PAYSYSTEM_CHARGEBACK"]='Возврат денег банком.';

$MESS["ERR_PLATON_ORDER_PLATON"]='Этот заказ не обслуживается в платёжной системе Platon!';
$MESS["UNKNOWN_RESPONCE_PLATON"]='Неизвестный ответ платежной системы';
$MESS["PLATON_SUCCESS_MESSAGE"]='Спасибо! Ваш заказ #ORDER_ID# оплачен.';
?>