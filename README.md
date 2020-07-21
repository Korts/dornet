## Создать JSON API отзывов о точках (объектах) на карте.
Необходимо создать сервис для хранения и подачи отзывов. Отзывы должны храниться в базе данных. Сервис должен предоставлять API, работающее поверх HTTP в формате JSON.

##### Требования
* язык, технологии: PHP, MySQL;
* код должен быть выложен на github;
* 3 метода: получение списка отзывов, получение одного отзыва, создание отзыва;
* валидация полей (рейтинг от 1 до 5, имя (никнейм) не больше 50 символов, описание не больше 1000
 символов, ссылки на фото не больше 3-х).
 
##### Метод получения списка отзывов
* нужна пагинация, на одной странице должно присутствовать 10 отзывов;
* нужна возможность сортировки: по рейтингу (возрастание/убывание) и по дате создания (возрастание/убывание);
* поля в ответе: идентификатор отзыва, имя (никнейм), рейтинг, ссылка на главное (первое) фото.
##### Метод получения конкретного отзыва
* обязательные поля в ответе: имя (никнейм), рейтинг, ссылка на главное (первое) фото;
* опциональные поля (можно запросить, передав параметр fields): описание, ссылки на все фото.
##### Метод создания отзыва:
* принимает все вышеперечисленные поля: имя (никнейм), описание, несколько ссылок на фотографии (сами фото загружать никуда не требуется), рейтинг;
* возвращает ID созданного отзыва и код результата (ошибка или успех).
