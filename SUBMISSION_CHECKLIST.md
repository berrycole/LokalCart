# TFA4 submission checklist

- [x] Continue the TFA3 project and retain its visual design and account features.
- [x] Add users.password and hash every existing user's initial password.
- [x] Build username/password login using password_verify().
- [x] Regenerate session ID and store login identity on success.
- [x] Register AuthFilter on customer/user lists, new/edit forms, and save routes.
- [x] Destroy the session on POST logout and redirect to login.
- [x] Include automated access-control tests and local setup instructions.
- [x] Include base database export and TFA4 migration.
- [ ] Provide a hosted link — deferred at the user's request.

Demo login after import and migration: admin.ramos / LokalCart2026! (unless TFA4_INITIAL_PASSWORD was customized before migration).
