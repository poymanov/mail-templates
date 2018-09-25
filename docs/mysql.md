# Настройка MySQL

 Создать базы и пользователей в **mysql**
```
# Рабочая база
DROP DATABASE IF EXISTS `mail_templates`;
CREATE DATABASE IF NOT EXISTS `mail_templates` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON mail_templates.* TO mail_templates@localhost IDENTIFIED BY '123qwe';

# База для запуска тестов
DROP DATABASE IF EXISTS `mail_templates_test`;
CREATE DATABASE IF NOT EXISTS `mail_templates_test` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON mail_templates_test.* TO mail_templates_test@localhost IDENTIFIED BY '123qwe';