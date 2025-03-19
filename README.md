# Редактор Excel для пользователей

Редактор Excel для пользователей — это веб-приложение на PHP для обработки данных пользователей и генерации файлов Excel. Оно позволяет вводить данные в формате JSON через веб-интерфейс, добавлять признак совершеннолетия (`is_adult`) и сохранять результаты в файл Excel. Приложение запускается в Docker-контейнере с Apache и использует библиотеку [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet).

## Основные возможности

- Ввод данных пользователей через веб-форму в формате JSON.
- Обработка данных: добавление столбца `is_adult` (true, если возраст ≥ 18).
- Генерация и скачивание Excel-файла с обработанными данными.
- Отображение результатов в таблице на веб-странице.
- Лёгкое развёртывание с помощью Docker Compose.

## Требования

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- Операционная система: Linux, macOS или Windows с поддержкой Docker.

## Установка
**Клонируйте репозиторий**:
   ```bash
   git clone https://github.com/<ваш-username>/user-excel-editor.git
   cd user-excel-editor
