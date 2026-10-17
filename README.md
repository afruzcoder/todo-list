# To-Do List

A Laravel web application for managing personal tasks: registration and login,
a task list with search and filters, a stats dashboard, a user profile, and a
dark theme.

Each user sees and edits **only their own** tasks.

---

## Features

- **Authentication (Laravel Breeze, Blade):** registration, login, logout,
  password reset, password confirmation.
- **Profile:** edit name, surname, phone, email and password; delete the account.
- **Tasks:**
  - create, view, edit and delete;
  - bound to the current user (data isolation);
  - server-side validation (including `endTime >= startTime` and valid enum values);
  - fields: name, description, status (`not started` / `doing` / `done`),
    priority (`low` / `medium` / `high`), start date and end date.
- **Reactive task list (Livewire 4):** search by name/description, filters by
  status and priority, pagination, delete with confirmation — no page reloads.
- **Dashboard:** task counters by status and priority, plus a list of recent tasks.
- **Dark mode:** navbar toggle that remembers the choice and respects the system theme.

---

## Tech Stack

| Layer | Technologies |
|---|---|
| Backend | PHP 8.2+, Laravel 11 |
| Authentication | Laravel Breeze (Blade stack) |
| Interactivity | Livewire 4 |
| Frontend | Vite 6, Tailwind CSS 3, DaisyUI 4, Alpine.js 3 |
| Database | MySQL |
| Testing | Pest 3 |
| Code style | Laravel Pint |

---

## Requirements

- **PHP 8.2+** with the `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo` extensions.
- **Composer**
- **Node.js 18+** and **npm**
- **MySQL** 5.7+ / 8.x

---

## Installation

1. Clone the repository and enter the project directory:
   ```bash
   git clone https://github.com/afruzcoder/todo-list.git
   cd todo-list
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Create the environment file and generate the app key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure the database in `.env`:
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_todo_list
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Create the database first, for example:
   ```sql
   CREATE DATABASE laravel_todo_list CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

5. Run the migrations:
   ```bash
   php artisan migrate
   ```

6. (Optional) Seed the database with sample data:
   ```bash
   php artisan db:seed
   ```
   This creates a user: **email `test@example.com`**, **password `password`**.

7. Install and build the frontend dependencies:
   ```bash
   npm install
   npm run build
   ```

---

## Running

Start the local server:

```bash
php artisan serve
```

The app will be available at **http://127.0.0.1:8000**.

During frontend development it is convenient to run Vite with hot reload:

```bash
npm run dev
```

Or run everything at once (server + queue + Vite):

```bash
composer dev
```

---

## Routes

| Method | URI | Purpose | Middleware |
|---|---|---|---|
| GET | `/` | Login screen | — |
| GET | `/register`, POST `/register` | Registration | guest |
| GET | `/login`, POST `/login` | Login | guest |
| POST | `/logout` | Logout | auth |
| GET | `/forgot-password` … | Password reset | guest |
| GET | `/dashboard` | Dashboard | auth |
| GET | `/tasks` | Task list | auth |
| GET | `/tasks/create` | Create form | auth |
| POST | `/tasks` | Store a task | auth |
| GET | `/tasks/{task}` | View a task | auth |
| GET | `/tasks/{task}/edit` | Edit form | auth |
| PUT/PATCH | `/tasks/{task}` | Update a task | auth |
| DELETE | `/tasks/{task}` | Delete a task | auth |
| GET/PATCH/DELETE | `/profile` | User profile | auth |

Access to other users' tasks is denied by `TaskPolicy` (response `403`).

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── TaskController.php        # task CRUD (+ authorization)
│   │   ├── ProfileController.php     # profile
│   │   └── Auth/                     # Breeze controllers
│   └── Requests/
│       ├── TaskRequest.php           # task validation
│       └── ProfileUpdateRequest.php  # profile validation
├── Livewire/
│   ├── TaskList.php                  # reactive task list
│   └── Dashboard.php                 # dashboard stats
├── Models/
│   ├── Task.php                      # belongsTo User, date casts
│   └── User.php                      # hasMany Task
└── Policies/TaskPolicy.php           # ownership-based access

resources/
├── css/app.css                       # Tailwind + DaisyUI
├── js/app.js                         # Alpine
└── views/
    ├── layouts/{app,guest}.blade.php # layouts (navbar, dark theme)
    ├── livewire/                      # Livewire component templates
    ├── task/                          # task pages
    ├── auth/                          # authentication screens
    └── profile/                       # profile pages

database/
├── factories/                        # UserFactory, TaskFactory
├── migrations/                       # database schema
└── seeders/DatabaseSeeder.php

tests/Feature/                        # Pest tests (auth, profile, tasks)
```

---

## Data Model

**users:** `name`, `surname` (nullable), `email` (unique), `phone` (nullable), `password`.

**tasks:** `user_id` (FK → users, cascade), `name`, `description`, `status`
(enum: `done`, `doing`, `not started`), `priority` (enum: `low`, `medium`, `high`),
`startTime` (date), `endTime` (date).

Relationships: `User hasMany Task`, `Task belongsTo User`.

---

## Testing

```bash
php artisan test
```

Tests run against in-memory SQLite (configured in `phpunit.xml`), so MySQL is not
required for them. Coverage includes registration/login, password reset, profile,
task CRUD, validation, and task isolation between users.

Code formatting:

```bash
./vendor/bin/pint
```
