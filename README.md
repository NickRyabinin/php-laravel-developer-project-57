### Hexlet tests and linter status:
[![Actions Status](https://github.com/NickRyabinin/php-laravel-developer-project-57/workflows/hexlet-check/badge.svg)](https://github.com/NickRyabinin/php-laravel-developer-project-57/actions)
[![project-check](https://github.com/NickRyabinin/php-laravel-developer-project-57/actions/workflows/project-check.yml/badge.svg)](https://github.com/NickRyabinin/php-laravel-developer-project-57/actions/workflows/project-check.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/2c8550d312b58654b076/maintainability)](https://codeclimate.com/github/NickRyabinin/php-laravel-developer-project-57/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/2c8550d312b58654b076/test_coverage)](https://codeclimate.com/github/NickRyabinin/php-laravel-developer-project-57/test_coverage)

## О проекте

Task Manager – учебный проект - система управления задачами. Позволяет ставить задачи, назначать исполнителей и менять их статусы. Для работы с системой требуется регистрация и аутентификация.

Применяемый стек: PHP/Laravel/Blade/Eloquent. Регистрация и аутентификация сделаны с использованием Breeze (при сбросе пароля пользователя email на реальный адрес не отправляется, вместо этого используется сервис mailtrap.io). Стилизация - Tailwind CSS. Используемая БД - PostgreSQL. Есть локализация интерфейса, в зависимости от настроек языка, предпочитаемого для отображения страниц в браузере. Реализованы функциональные тесты.

### Требования:
PHP >= 8.1

Composer

Node.js

npm

### Локальная установка:
```bash
git clone git@github.com:NickRyabinin/php-laravel-developer-project-57.git

make install

make setup
```
### Линтинг и тестирование:
```bash
make check
```
### Локальный запуск:
```bash
make start
```
