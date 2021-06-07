# Модуль 1С-Битрикс для Украины

## Чеклист интеграции:
- [x] Установить модуль.
- [x] Передать тех поддержке PSP Platon  ссылку для коллбеков.
- [x] Провести оплату используя тестовые реквизиты.

## Установка:

* Установить с https://marketplace.bitrix.ua/solutions/platon.paysystem/

* В админке Битрикса перейти во вкладку "Магазин" - "Настройки" - "Платёжные системы".

* Нажать "Добавить платёжную систему".

* Выбрать обработчик platon_paysystem, выбрать кодировку UTF-8.

* Внести "Заголовок", "Название".

* Во вкладке "По умолчанию" внести "Пароль идентификации клиента (API pass)" и "Ключ для идентификации клиента (API Key)".

* В Cancel URL и Success URL внести адрес "https://АДРЕСС_САЙТА/personal/order/payment/result.php".

* Отметить чек бокс "Активность".

* Загрузить логотип на ПК https://drive.google.com/file/d/1NfQN5MSdrVT8rR-N6w3Mo9bkSr5N-NVg/view?usp=sharing - Connect to preview и добавить через кнопку.

* Нажать кнопку "Сохранить".

## Настройка HOLD

* Первоначально HOLD необходимо активировать запросив данный функционал у менеджера или в групповом чате.

* Перейти в настройки на левой панеле - Настройки продукта - Настройки модулей - Платёжная система Platon.

* Установить "Галочку" в поле "Удерживать оплату (HOLD) на кароточке покупателя. Заказ будет переведен в оплаченные только после подтверждения продавцом".

* Установить нужные статусы в разделе "Изменения статусов заказа".

* Нажимаем "Сохранить".

## Настройка статусов платежей

* Если какого то подходящего статуса нет, необходимо перейти во вкладку "Магазин" - "Настройки" - "Статусы".

* Нажать "Добавить статус".

* В поле "Код статуса (1-2 латинские буквы):" вносим коротке название нового статуса.

* В поле "Сортировка" ставим от 1000 до 1500.

* Выбираем цвет статуса.

* Указываем название статуса на en, ru, ua языках.

* Нажимаем "Сохранить".

## Настройка обработчика коллбеков

* Перейти во вкладку "Контент" - Структура сайта - Файлы и папки.

* Перейти в папку personal - order - payment.

* Выбрать существующий или создать файл "result.php".

* Редактировать его как HTML.

* В правой боковой панеле (см. скриншот) выбрать Магазин - Процедура оформления заказа.

* "Вытянуть" в белое поле, вкладку с названием "Подключение обработчика результата платежной системы".

* Выбрать параметры компонента на этой вкладке.

* Во вкладке "Платежная система:" выбираем "Банковские карты".

* Нажимаем кнопку "Сохранить".

* Сохраняем ещё раз.

## Иностранные валюты:
Готовые CMS модули PSP Platon по умолчанию поддерживают только оплату в UAH.

Если необходимы иностранные валюты необходимо провести правки модуля вашими программистами согласно раздела [документации](https://platon.atlassian.net/wiki/spaces/docs/pages/1810235393).

## Ссылка для коллбеков:
https://ВАШ_САЙТ/personal/order/payment/result.php

## Тестирование:
В целях тестирования используйте наши тестовые реквизиты.

| Номер карты  | Месяц / Год | CVV2 | Описание результата |
| :---:  | :---:  | :---:  | --- |
| 4111  1111  1111  1111 | 02 / 2022 | Любые три цифры | Не успешная оплата без 3DS проверки |
| 4111  1111  1111  1111 | 06 / 2022 | Любые три цифры | Не успешная оплата с 3DS проверкой |
| 4111  1111  1111  1111 | 01 / 2022 | Любые три цифры | Успешная оплата без 3DS проверки |
| 4111  1111  1111  1111 | 05 / 2022 | Любые три цифры | Успешная оплата с 3DS проверкой |
