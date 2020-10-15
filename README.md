## Currency API

### Install

Установить все необходимые зависимости с помощью Composer

```
composer install
```

Скопировать файл .env и задать в нем параметры для соединения с БД

```
cp .env.example .env
```

Запустить миграции для создания необходимых таблиц в БД

```
php artisan migrate
```

Запустить сидеры БД

```
php artisan db:seed
```

### Commands

Парсинг котировок с 1 января 2010 года

```
php artisan currencies:parse:all
```

Парсинг котировок за сегодня

```
php artisan currencies:parse:daily
```

### Methods

Все запросы необходимо выполнять с HTTP-заголовком

```
Authorization: Bearer <token>
```

Получение курса конкретной валюты на определенную дату

```
GET /currency/JPY?date=10.03.2017
```

Если не передавать параметр `date`, курс валюты будет на текущую дату

```
GET /currency/AUD
```

Получение всех курсов валют с пагинацией

```
GET /currencies?page=2&per_page=10
```

Если параметры `page` и `per_page` явно не указаны, то подставляются значения по умолчанию

```
page = 1
per_page = 20
```
