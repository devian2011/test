* Изменил входящий json
* Вообще нужно привязывать к заказу ID купонов и налогов по-мимо входных данных
* Использование в валидаторе проверки на существование чего-то (taxNumber, productId, coupon, providers) в БД нарушает принципы SOLID - однако добавил
* Купоны и их уникальность должны привязываться к продавцу, но тогда нужна промежуточная таблица с ценой товаром и продавцом
* Добавил условие что если цена товара со скидкой должна все-таки быть больше 0
* Сменил сервер разработки на nginx-unit
* Для БД использовал SQLite