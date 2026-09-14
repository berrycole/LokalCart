# IT0049 Technical Formative Assessment 1 Submission Checklist

## Student details

- Student or group name: ______________________________
- Members, if a group: ________________________________
- Section: ____________________________________________
- Professor: __________________________________________

## Final verification

- [ ] `/` opens the LokalCart landing page.
- [ ] `/about` explains the project and MVC request flow.
- [ ] `/customers` displays at least five customer records with full name, email, and phone.
- [ ] `/users` displays at least five staff records with username, full name, and role.
- [ ] Every navigation link works on all four pages.
- [ ] The layout remains readable on a phone-size browser window.
- [ ] `php vendor/bin/phpunit` reports all tests passing.
- [ ] `php spark routes` lists exactly the four required GET routes.

## Rubric evidence

- **Functionality and requirements, 40 points:** four working pages, complete fields, and consistent navigation.
- **Code structure and organization, 25 points:** explicit routes, three focused controllers, reusable layout, separate views, and shared CSS.
- **Static-array data handling, 20 points:** six associative records in each listing controller and a `foreach` loop in each listing view.
- **Documentation and submission, 15 points:** complete README, lock file, environment example, automated tests, database-status note, repository link, and live link.

## Links to submit

- GitHub repository: __________________________________
- Hosted application: _________________________________

## Repository check

- [ ] The repository contains `app`, `public`, `tests`, and `database`.
- [ ] `README.md`, `composer.json`, and `composer.lock` are visible.
- [ ] `.env.example` is visible, but `.env` is not committed.
- [ ] `vendor` is not committed.
- [ ] The latest commit matches the hosted version.
- [ ] The live site uses HTTPS and all four routes work.

## Database submission note

This activity explicitly requires static PHP arrays and states that no database is involved. The file `database/no-database-required.sql` documents that scope while satisfying the general submission checklist's request for a database-export item.
