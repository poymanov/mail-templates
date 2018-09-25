# Настройка nginx

[пример конфигурации](nginx/mail_templates)

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