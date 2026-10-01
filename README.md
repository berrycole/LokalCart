# LokalCart POS

A CodeIgniter 4 point-of-sale foundation for IT0049 Technical Formative Assessment 3. It keeps the original LokalCart Home, About, customer, and user pages while adding account forms, server-side validation, and prepared user avatars.

## Requirements

- PHP 8.2 or later with `intl`, `mysqli`, `fileinfo`, and `gd` extensions
- MySQL or MariaDB
- Composer
- A writable `public/uploads/avatars` directory for the web server

## Local setup

1. Run `composer install` in this directory.
2. Import `database/lokalcart_pos_tfa3.sql` into MySQL. This creates the `lokalcart_pos_tfa3` database, tables, and sample data. **It drops existing tables in that database**, so back up any data there first.
3. Copy `.env.example` to `.env`. Set your database username, password, host, and port as needed. The default database name is `lokalcart_pos_tfa3`.
4. Run `php spark serve` and visit `http://localhost:8080/`.

For an existing TFA2 installation, run `database/upgrade_tfa2_to_tfa3.sql` against `lokalcart_pos_tfa2` instead of importing the fresh export. Keep `.env` pointed at `lokalcart_pos_tfa2`. That script preserves tasks and users, adds a customers table if needed, and adds missing email and avatar columns to users. It can be rerun safely.

## Pages and behavior

| Route | Purpose |
| --- | --- |
| `/` | Original LokalCart Home page |
| `/about` | Original LokalCart project overview |
| `/customers` | Customer listing, with create and edit links |
| `/customers/new` | Create a customer |
| `/customers/{id}/edit` | Edit a customer |
| `/users` | User listing with prepared avatars or a placeholder |
| `/users/new` | Create a user |
| `/users/{id}/edit` | Edit a user and optionally upload an avatar |

The pre-existing `/tasks` and `/profile` routes remain available, but the main navigation follows the original LokalCart point-of-sale pages.

Customer forms require a full name and valid email. User forms require a full name and unique username. The edit form accepts an optional JPG or PNG avatar up to 2 MB. The server validates the file, crops it to a 256 × 256 pixel image, stores the image in `public/uploads/avatars`, and saves only the generated filename in `users.avatar`. Generated avatars are ignored by Git; the placeholder SVG is tracked. Invalid forms show field errors and keep entered text.

The forms include CSRF tokens, and the application enables the CodeIgniter CSRF filter for POST requests. Keep the uploads directory writable on your host and serve the app through the `public` directory.

## Verification

Run `vendor/bin/phpunit` with the PHP SQLite3 extension enabled; the test suite uses an in-memory database. To check the application manually, open both new forms, submit empty and invalid values, create records, edit them, test a duplicate username, and upload a valid and invalid avatar. Verify that the user listing shows a 256 × 256 prepared image or the placeholder.

## Repository

[GitHub repository](https://github.com/berrycole/LokalCart)
