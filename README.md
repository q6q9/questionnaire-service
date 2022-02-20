# Questionnaire Service

## Installing steps:
Copy "example.env" to ".env" and define real DB connection parameters
### bash:
```
composer install
php yii migrate
php yii serve
```

For adding questionnaires in database u can use command with number of records:
```
php yii questionnaires-factory  

# example:
# php yii questionnaires-factory 30000
```

If not download Excel data, check this: https://stackoverflow.com/a/65748236

## Using:
### Credentials:
```
login: admin
password: admin
```
## Description
* Так как база данных пользователей не является основной задачей, за их хранение отвечает примитивный массив: ```app\models\User::$users```
* Все пользователи могут проходить (заполнять) анкеты
* Админ-панель:
  * доступен CRUD анкет;
  * фильтры;
  * извлечение анкет в виде Excel файла (Использовать ОСТОРОЖНО при большом кол-ве анкет!);
  * некоторая статистика по анкетам (2 созданные заранее и 1 по аттрибуту выбранному пользователем (Использовать ОСТОРОЖНО при большом кол-ве анкет!))



 
