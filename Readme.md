# Сокращатель ссылок
*ну или почти*

### Подготовка
- Как нибудь поднять Postgre (В докер пока не могу)
- Настроить строку подключения в .env
```php
// Текущая строка
DATABASE_URL="postgresql://postgres:12345@127.0.0.1:5432/pg_shlink_db?serverVersion=10&charset=utf8"
```
- Открыть директорию проекта в консоли и выполнить команды
```php
// Оно все делалось из-под винды
composer update // vendor по умолчанию в игноре у гита
php bin/console doctrine:database:create // создание бд
php bin/console doctrine:migrations:migrate // накатывание бд
```
- Как нибудь поднять сервер (На винде можно запустить run.bat - встроенный сервер php)
- Надеюсь ничего не забыл

### Запросы Postman
```json
// ShortLinks.postman_collection.json - экспортированная коллекция запросов
// Ниже вырезка
{
	"item": [
		{
			"name": "Добавление",
			"request": {
				"method": "POST",
				"header": [
					{
						"key": "Content-Type",
						"value": "application/json",
						"type": "default"
					}
				],
				"body": {
					"mode": "raw",
					"raw": "{\r\n    \"name\": \"Asd\",\r\n    \"originalLink\": \"https://symfony.com/doc/5.4/doctrine.html#updating-an-object\"\r\n}"
				},
				"url": {
					"raw": "http://localhost:8000/post_link",
				}
			},
			"response": []
		},
		{
			"name": "Переход",
			"request": {
				"method": "GET",
				"header": [],
				"url": {
					"raw": "http://localhost:8000/1",
				}
			},
			"response": []
		}
	]
}
```

### О веселом
- Вин 7
- symfony-cli не встала (точнее промлемы со scoop)
- Ide - netbeans, который не хочет смотреть внутрь vendor
- БД из OpenServer, чтобы не фонила
- Консоль из OpenServer - она сожрала composer и он больше ниоткуда не вызывается (composer везде заменяется на "")
- Сервер - встроенный в php, изначально хотел портативную штуку делать с SQLite (Для маленькой задачи с ORM разницы почти нет), потом долшло что на линухе оно не запустится
- В общем, надо разбираться с докером (docker-composer звучит как что-то портативное)
