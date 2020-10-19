<?global $MESS;
$MESS["PLATON_PAYSYSTEM_DTITLE"] = 'Платіжна система Platon';
$MESS["PLATON_PAYSYSTEM_DDESCR"]='Прийом платежів в платіжній системі <a href="https://platon.ua" target="_blank">Platon</a>';

$MESS["PLATON_PAYSYSTEM_KEY"]='Ключ для ідентифікації клієнта *';
$MESS["PLATON_PAYSYSTEM_KEY_DESC"]='Обов`зковий параметр. Призначається зареєстрованому в системі Platon користувачу.';

$MESS["PLATON_PAYSYSTEM_PASSWORD"]='Пароль ідентифікації клієнта *';
$MESS["PLATON_PAYSYSTEM_PASSWORD_DESC"]=$MESS["PLATON_PAYSYSTEM_KEY_DESC"];

$MESS["PLATON_PAYSYSTEM_WEB_URL"]='Адреса Platon, на котру передається (POST) оплата *';
$MESS["PLATON_PAYSYSTEM_WEB_URL_DESC"]=$MESS["PLATON_PAYSYSTEM_KEY_DESC"];

$MESS["PLATON_PAYSYSTEM_SUCCESS"]="Success URL *";
$MESS["PLATON_PAYSYSTEM_SUCCESS_DESC"]="Обов`зковий параметр. Адреса, на яку повертається Покупець в разі успішної оплати";

$MESS["PLATON_PAYSYSTEM_CANCEL"]="Cancel URL";
$MESS["PLATON_PAYSYSTEM_CANCEL_DESC"]="Адреса, на яку повертається Покупець в разі неуспішної оплати";

/////////////////////////////////////////////
$MESS["PLATON_PAYSYSTEM_ORDER_ID"]="Номер платежу";
$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"]="Не треба змінювати";

$MESS["PLATON_PAYSYSTEM_SUMM"]="Сума рахунку";
$MESS["PLATON_PAYSYSTEM_SUMM_DESC"]=$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"];

$MESS["PLATON_PAYSYSTEM_CURRENCY"]="Валюта";
$MESS["PLATON_PAYSYSTEM_CURRENCY_DESC"]=$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"];

$MESS["PLATON_PAYSYSTEM_USER_ID"]="Код отримувача";
$MESS["PLATON_PAYSYSTEM_USER_ID_DESC"]=$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"];

//////////////////////////////////////////////
$MESS["PLATON_PAYSYSTEM_PAYMENT_ORDER"]='замовлення';
$MESS["PLATON_PAYSYSTEM_PAYMENT_DOP_INFO"]='Ви бажаєте здійснити платіж через систему';
$MESS["PLATON_PAYSYSTEM_PAYMENT_DOP_TTL"]='Сума до сплати по рахунку';
$MESS["PLATON_PAYSYSTEM_PAYMENT_DOP_SEND"]='Сплатити платіжною карткою';
$MESS["PLATON_PAYSYSTEM_PAYMENT_ELSE_SEND"]='Використати іншу картку';
$MESS["PLATON_PAYSYSTEM_PAYMENT_RECURRING_SEND"]='Придбати з картки #CARD#';

$MESS["ERR_PLATON_PAYSYSTEM_KEY"]='Не вказаний ключ користувача Platon';
$MESS["ERR_PLATON_PAYSYSTEM_PASSWORD"]='Не вказаний пароль користувача Platon';
$MESS["ERR_PLATON_MODULE_URL"]='Не вказана адреса відправки POST запиту';
$MESS["ERR_PLATON_REQUEST_SUCCESS_URL"]='Не вказана адреса для отримання результату';
$MESS["ERR_PLATON_MODULE_PAYSYSTEM"]='Помилка платіжної системи';
$MESS["ERR_PLATON_PAYSYSTEM_PARAM"]='Не вказаний обов`язковий параметр: #PARAM#!';
$MESS["ERR_PLATON_PAYSYSTEM_PRICE"]='Невідповідність ціни замовлення (#PRICE#) сплаченій сумі (#AMOUNT#)!';
$MESS["ERR_PLATON_PAYSYSTEM_CURRENCY"]='Невідповідність валюти замовлення (#CURRENCY1#) сплаченій валюті (#CURRENCY2#)!';
$MESS["ERR_PLATON_PAYSYSTEM_SIGN"]='Помилка. Невірна сигнатура.';
$MESS["ERR_PLATON_PAYSYSTEM_REFUND"]='Повернення грошей продавцем.';
$MESS["ERR_PLATON_PAYSYSTEM_CHARGEBACK"]='Повернення грошей банком.';

$MESS["ERR_PLATON_ORDER_PLATON"]='Це замовлення не обслуговується в платіжній системі Platon!';
$MESS["UNKNOWN_RESPONCE_PLATON"]='Невідома відповідь платіжної системи';
$MESS["PLATON_SUCCESS_MESSAGE"]='Дякуємо! Ваше замовлення #ORDER_ID# сплачено.';
?>