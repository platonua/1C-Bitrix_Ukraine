<?global $MESS;
$MESS["PLATON_PAYSYSTEM_DTITLE"] = 'Payments System Platon';
$MESS["PLATON_PAYSYSTEM_DDESCR"]='Accept payments in the payment system <a href="https://platon.ua" target="_blank">Platon</a>';

$MESS["PLATON_PAYSYSTEM_KEY"]='Key for customer identification *';
$MESS["PLATON_PAYSYSTEM_KEY_DESC"]='Required parameter. Registered in system appointed Platon user.';

$MESS["PLATON_PAYSYSTEM_PASSWORD"]='Password authentication client *';
$MESS["PLATON_PAYSYSTEM_PASSWORD_DESC"]=$MESS["PLATON_PAYSYSTEM_KEY_DESC"];

$MESS["PLATON_PAYSYSTEM_WEB_URL"]='Address Platon, to which transferred (POST) payment *';
$MESS["PLATON_PAYSYSTEM_WEB_URL_DESC"]=$MESS["PLATON_PAYSYSTEM_KEY_DESC"];

$MESS["PLATON_PAYSYSTEM_SUCCESS"]="Success URL *";
$MESS["PLATON_PAYSYSTEM_SUCCESS_DESC"]="Required parameter. Address, which is returned to the Buyer in case successful payment";

$MESS["PLATON_PAYSYSTEM_CANCEL"]="Cancel URL";
$MESS["PLATON_PAYSYSTEM_CANCEL_DESC"]="Address, which is returned to the Buyer in case unsuccessful payment";

/////////////////////////////////////////////
$MESS["PLATON_PAYSYSTEM_ORDER_ID"]="Number of payment";
$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"]="Not necessary change";

$MESS["PLATON_PAYSYSTEM_SUMM"]="Invoice amount";
$MESS["PLATON_PAYSYSTEM_SUMM_DESC"]=$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"];

$MESS["PLATON_PAYSYSTEM_CURRENCY"]="Currency";
$MESS["PLATON_PAYSYSTEM_CURRENCY_DESC"]=$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"];

$MESS["PLATON_PAYSYSTEM_USER_ID"]="UserID";
$MESS["PLATON_PAYSYSTEM_USER_ID_DESC"]=$MESS["PLATON_PAYSYSTEM_ORDER_ID_DESC"];

//////////////////////////////////////////////
$MESS["PLATON_PAYSYSTEM_PAYMENT_ORDER"]='order';
$MESS["PLATON_PAYSYSTEM_PAYMENT_DOP_INFO"]='You want to pay through the system';
$MESS["PLATON_PAYSYSTEM_PAYMENT_DOP_TTL"]='The amount payable on account';
$MESS["PLATON_PAYSYSTEM_PAYMENT_DOP_SEND"]='Pay by credit card';
$MESS["PLATON_PAYSYSTEM_PAYMENT_ELSE_SEND"]='Use another card';
$MESS["PLATON_PAYSYSTEM_PAYMENT_RECURRING_SEND"]='Buy from card #CARD#';

$MESS["ERR_PLATON_PAYSYSTEM_KEY"]='Unknown key of the user Platon';
$MESS["ERR_PLATON_PAYSYSTEM_PASSWORD"]='Unknown password of the user Platon';
$MESS["ERR_PLATON_MODULE_URL"]='Unknown address to send the request';
$MESS["ERR_PLATON_REQUEST_SUCCESS_URL"]='No address for the result';
$MESS["ERR_PLATON_MODULE_PAYSYSTEM"]='Error payment system';
$MESS["ERR_PLATON_PAYSYSTEM_PARAM"]='Not a required parameter: #PARAM#!';
$MESS["ERR_PLATON_PAYSYSTEM_PRICE"]='Inconsistency order price (#PRICE#) paid amount (#AMOUNT#)!';
$MESS["ERR_PLATON_PAYSYSTEM_CURRENCY"]='Inconsistency order currency(#CURRENCY1#) paid currency (#CURRENCY2#)!';
$MESS["ERR_PLATON_PAYSYSTEM_SIGN"]='Error. Incorrect signature.';
$MESS["ERR_PLATON_PAYSYSTEM_REFUND"]='Refund seller.';
$MESS["ERR_PLATON_PAYSYSTEM_CHARGEBACK"]='Refund Bank.';

$MESS["ERR_PLATON_ORDER_PLATON"]='This order is not served in the payment system Platon!';
$MESS["UNKNOWN_RESPONCE_PLATON"]='Unknown reply payment system';
$MESS["PLATON_SUCCESS_MESSAGE"]='Thanks! Your order #ORDER_ID# paid.';
?>