## README

Развертывание проекта
-

- Клонировать репозиторий
- Перейти в папку проекта
- Выполнить команду `composer install`
- Создать файл `.env`, скопировав содержимое из `.env.example`
  - или выполнить `php -r "file_exists('.env') || copy('.env.example', '.env');"`
- Выполнить команду `php artisan key:generate --ansi` для создания ключа приложения
- Скопировать архив бекапа в `storage/app/backups`
- Выполнить команду `php artisan backup:restore`
