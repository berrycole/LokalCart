# IT0049 Technical Formative Assessment 3 Submission Checklist

## Database and setup

- [ ] Import `database/lokalcart_pos_tfa3.sql` for a fresh installation, or apply `database/upgrade_tfa2_to_tfa3.sql` to an existing TFA2 database.
- [ ] Configure `.env` for the selected database and make `public/uploads/avatars` writable by the web server.
- [ ] Confirm PHP has `intl`, `mysqli`, `fileinfo`, and `gd` enabled.

## Application verification

- [ ] Create a customer at `/customers/new`; confirm blank name and invalid email are rejected with retained entries.
- [ ] Create a user at `/users/new`; confirm blank fields and duplicate usernames are rejected.
- [ ] Edit an existing customer and user; confirm the forms start with stored values.
- [ ] On a user edit page, upload a JPG or PNG under 2 MB and confirm the user listing shows a prepared avatar.
- [ ] Confirm an invalid file is rejected, a user without an avatar shows the placeholder, and existing TFA2 pages still work.
- [ ] Run `vendor/bin/phpunit` with the SQLite3 extension enabled for the local test suite.

## Submission

- [ ] Push the project files and database export to [the LokalCart repository](https://github.com/berrycole/LokalCart).
- [ ] Deploy the same commit to a PHP/MySQL host and verify the hosted forms and upload folder.
- [ ] Submit both the repository URL and the working hosted application URL required by TFA3.
