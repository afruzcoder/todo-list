# To-Do List

Веб-приложение для управления личными задачами на Laravel: регистрация и вход,
список задач с поиском и фильтрами, дашборд со статистикой, профиль пользователя
и тёмная тема оформления.

Каждый пользователь видит и редактирует **только свои** задачи.

---

## Возможности

- **Аутентификация (Laravel Breeze, Blade):** регистрация, вход, выход, сброс пароля,
  подтверждение пароля.
- **Профиль:** изменение имени, фамилии, телефона, email и пароля; удаление аккаунта.
- **Задачи:**
  - создание, просмотр, редактирование и удаление;
  - привязка к текущему пользователю (изоляция данных);
  - серверная валидация полей (в т.ч. `endTime >= startTime`, корректность enum-полей);
  - поля: название, описание, статус (`not started` / `doing` / `done`),
    приоритет (`low` / `medium` / `high`), дата начала и дата окончания.
- **Реактивный список задач (Livewire 4):** поиск по названию/описанию, фильтры
  по статусу и приоритету, пагинация, удаление с подтверждением — без перезагрузки страницы.
- **Дашборд:** счётчики задач по статусам и приоритетам, список последних задач.
- **Тёмный режим:** переключатель в навбаре с сохранением выбора и учётом системной темы.

---

## Стек технологий

| Слой | Технологии |
|---|---|
| Backend | PHP 8.2+, Laravel 11 |
| Аутентификация | Laravel Breeze (Blade-стек) |
| Интерактив | Livewire 4 |
| Frontend | Vite 6, Tailwind CSS 3, DaisyUI 4, Alpine.js 3 |
| БД | MySQL |
| Тесты | Pest 3 |
| Форматирование кода | Laravel Pint |

---

## Требования

- **PHP 8.2+** с расширениями `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`.
- **Composer**
- **Node.js 18+** и **npm**
- **MySQL** 5.7+ / 8.x

---

## Установка

1. Клонируйте репозиторий и перейдите в папку проекта:
   ```bash
   git clone https://github.com/afruzcoder/todo-list.git
   cd todo-list
   ```

2. Установите PHP-зависимости:
   ```bash
   composer install
   ```

3. Создайте файл окружения и сгенерируйте ключ приложения:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Настройте подключение к БД в `.env`:
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_todo_list
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Предварительно создайте базу данных, например:
   ```sql
   CREATE DATABASE laravel_todo_list CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

5. Выполните миграции:
   ```bash
   php artisan migrate
   ```

6. (Необязательно) Заполните БД тестовыми данными:
   ```bash
   php artisan db:seed
   ```
   Будет создан пользователь: **email `test@example.com`**, **пароль `password`**.

7. Установите и соберите фронтенд-зависимости:
   ```bash
   npm install
   npm run build
   ```

---

## Запуск

Запустите локальный сервер:

```bash
php artisan serve
```

Приложение будет доступно по адресу **http://127.0.0.1:8000**.

Во время разработки фронтенда удобно запускать Vite в режиме горячей перезагрузки:

```bash
npm run dev
```

Либо одной командой (сервер + очередь + Vite):

```bash
composer dev
```

---

## Маршруты

| Метод | URI | Назначение | Middleware |
|---|---|---|---|
| GET | `/` | Экран входа | — |
| GET | `/register`, POST `/register` | Регистрация | guest |
| GET | `/login`, POST `/login` | Вход | guest |
| POST | `/logout` | Выход | auth |
| GET | `/forgot-password` … | Сброс пароля | guest |
| GET | `/dashboard` | Дашборд | auth |
| GET | `/tasks` | Список задач | auth |
| GET | `/tasks/create` | Форма создания | auth |
| POST | `/tasks` | Сохранить задачу | auth |
| GET | `/tasks/{task}` | Просмотр задачи | auth |
| GET | `/tasks/{task}/edit` | Форма редактирования | auth |
| PUT/PATCH | `/tasks/{task}` | Обновить задачу | auth |
| DELETE | `/tasks/{task}` | Удалить задачу | auth |
| GET/PATCH/DELETE | `/profile` | Профиль пользователя | auth |

Доступ к чужим задачам запрещён политикой `TaskPolicy` (ответ `403`).

---

## Структура проекта

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── TaskController.php        # CRUD задач (+ авторизация)
│   │   ├── ProfileController.php     # профиль
│   │   └── Auth/                     # контроллеры Breeze
│   └── Requests/
│       ├── TaskRequest.php           # валидация задач
│       └── ProfileUpdateRequest.php  # валидация профиля
├── Livewire/
│   ├── TaskList.php                  # реактивный список задач
│   └── Dashboard.php                 # статистика дашборда
├── Models/
│   ├── Task.php                      # belongsTo User, касты дат
│   └── User.php                      # hasMany Task
└── Policies/TaskPolicy.php           # доступ по владельцу

resources/
├── css/app.css                       # Tailwind + DaisyUI
├── js/app.js                         # Alpine
└── views/
    ├── layouts/{app,guest}.blade.php # макеты (навбар, тёмная тема)
    ├── livewire/                      # шаблоны Livewire-компонентов
    ├── task/                          # страницы задач
    ├── auth/                          # экраны аутентификации
    └── profile/                       # страницы профиля

database/
├── factories/                        # UserFactory, TaskFactory
├── migrations/                       # схема БД
└── seeders/DatabaseSeeder.php

tests/Feature/                        # Pest-тесты (auth, профиль, задачи)
```

---

## Модель данных

**users:** `name`, `surname` (nullable), `email` (unique), `phone` (nullable), `password`.

**tasks:** `user_id` (FK → users, cascade), `name`, `description`, `status`
(enum: `done`, `doing`, `not started`), `priority` (enum: `low`, `medium`, `high`),
`startTime` (date), `endTime` (date).

Связи: `User hasMany Task`, `Task belongsTo User`.

---

## Тестирование

```bash
php artisan test
```

Тесты используют SQLite в памяти (настраивается в `phpunit.xml`), поэтому MySQL
для их запуска не требуется. Покрыты регистрация/вход, сброс пароля, профиль,
CRUD задач, валидация и изоляция задач между пользователями.

Форматирование кода:

```bash
./vendor/bin/pint
```

---

## Контакты

- **Email:** nizomitdinov.afruziddin@gmail.com
- **GitHub:** [afruzcoder](https://github.com/afruzcoder)
