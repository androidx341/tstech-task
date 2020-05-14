Добавленить запись в CronTab
```* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1```

Скопировать `.env.example` в `.env`. Создать Базу данных проекта и указать имя Базы данных в `.env`

Выполнить команду `composer install`

Сгенерировать ключ `php artisan key:generate`

Выполнить миграции `php artisan migrate`
Запустить посев базы данных `php artisan db:seed` 

### Консольные комманды:
* Начисление процентов по депозитам  `php artisan accounting:accrual` 
* Вычитание коммисии за пользование счётом `php artisan accounting:fee` 
