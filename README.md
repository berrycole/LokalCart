# LokalCart Tasks for Today Management System

A CodeIgniter 4 MVC application for the IT0049 Tasks for Today Management System activity. It provides a today-only dashboard, a complete task list, a demo profile, and a static About page.

## Pages

| Route | Purpose |
| --- | --- |
| `/` | Welcome page showing only tasks where `task_date` equals today |
| `/tasks` | Full task listing ordered by task date |
| `/profile` | The single demo user record |
| `/about` | Static developer and application overview |

## Database setup

1. Start MySQL in XAMPP or another local MySQL installation.
2. Import `database/lokalcart_pos_tfa2.sql` using phpMyAdmin or the MySQL client.
3. Copy `.env.example` to `.env` and confirm the database settings point to `lokalcart_pos_tfa2`.
4. Start the app with `php spark serve`, then open `http://localhost:8080/`.

The SQL export creates the required `tasks` and `users` tables, inserts eight tasks across four dates including today, and inserts exactly one demo user. `TaskModel` and `UserModel` provide the shared data layer used by the pages.

## Project structure

```text
app/Controllers/Pages.php       Today dashboard and About page
app/Controllers/Tasks.php       Full task listing
app/Controllers/Profile.php     Demo profile page
app/Models/TaskModel.php        tasks table model
app/Models/UserModel.php        users table model
database/lokalcart_pos_tfa2.sql Schema and seed data
```

## Requirements

PHP 8.2+, CodeIgniter 4, MySQL, the `intl` and `mysqli` PHP extensions, and Composer dependencies from `composer.json`.
