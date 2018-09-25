# Приложение "Шаблоны писем"

## Описание

Приложение позволяет создавать **шаблоны** для отправки e-mail писем и сохраняет их в формате **html-файла**.
Содержит административную часть **(backend)** и страницу доступную всем пользователям **(frontend)**.

## Установка

- Склонировать данный репозиторий в рабочую директорию
- Настроить **nginx** ([пример конфигурации](/)).

Заменить данные строки на свои значения:

```
server {
...
# адрес для frontend-части
server_name mail-templates.poymanov-projects.ru;

# путь к коду проекта
root /home/projects/mail-templates/frontend/web/;

...

# Директорию для логов nginx необходимо предварительно создать
access_log  /var/log/nginx/mail-templates/frontend-access.log;
error_log   /var/log/nginx/mail-templates/frontend-error.log;

...
}

server {
...
# адрес для backend-части
server_name admin-mail-templates.poymanov-projects.ru;

# путь к коду проекта
root /home/projects/mail-templates/backend/web/;

...

# Директорию для логов nginx необходимо предварительно создать
access_log  /var/log/nginx/mail-templates/backend-access.log;
error_log   /var/log/nginx/mail-templates/backend-error.log;

...

}
```
- Создать базы и пользователей в **mysql**
```
# Рабочая база
DROP DATABASE IF EXISTS `mail_templates`;
CREATE DATABASE IF NOT EXISTS `mail_templates` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON mail_templates.* TO mail_templates@localhost IDENTIFIED BY '123qwe';

# База для запуска тестов
DROP DATABASE IF EXISTS `mail_templates_test`;
CREATE DATABASE IF NOT EXISTS `mail_templates_test` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON mail_templates_test.* TO mail_templates_test@localhost IDENTIFIED BY '123qwe';
```
- Установить права на директорию для сохранения шаблонов в **html**:
```
chmod 0777 -R common/storage
```
- Установить пакеты из composer:
```
composer install

composer install --no-dev # без установки пакетов для тестирования и вспомогательных пакетов для разработки

```

- Инициализировать проект:
```
./init

Затем выбрать режим работы проекта: "боевой" (production) или "разработка" (development)
```

- Указать настройки базы данных:

Для базы проекта в `common/config/main-local.php`:
```
'db' => [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=mail_templates',
    'username' => 'mail_templates',
    'password' => '123qwe',
    'charset' => 'utf8',
],
```

Идентичные для базы для запуска тестов в `common/config/test-local.php`

- Запустить миграции для баз данных:

```
./yii migrate
./yii_test migrate
```

## Создание пользователей

Создания пользователя для управления шаблонами происходит через консольную команду:
```
./yii user/create
```

Приложение предложит указать имя, email и пароль. 
После этого пользователь будет создан и сможет авторизоваться на **frontend** и **backend** разделах приложения.

## Запуск тестов

```
./vendor/bin/codecept run
```
