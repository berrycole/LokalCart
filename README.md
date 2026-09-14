# LokalCart POS

LokalCart POS is a four-page CodeIgniter 4 application created for IT0049 Technical Formative Assessment 1. It demonstrates routing, controllers, views, reusable layouts, and temporary static-array data before a database is introduced.

## Required pages

| Route | Controller method | Purpose |
| --- | --- | --- |
| `/` | `Pages::index` | Landing page and project summary |
| `/about` | `Pages::about` | MVC and project-scope explanation |
| `/customers` | `Customers::index` | Six customer records from a static PHP array |
| `/users` | `Users::index` | Six staff records from a static PHP array |

The customer and user views use `foreach` loops to render the arrays received from their controllers. No database is used in this milestone.

## Technology requirements

- PHP 8.2 or newer
- PHP extensions: `intl` and `mbstring`
- Composer 2.0.14 or newer
- A modern browser

This project was built and tested with PHP 8.4.10, Composer 2.8.9, and CodeIgniter 4.7.4.

## Run the project on this Windows computer

PHP and Composer are already present on this computer. PHP is located at `C:\php\php.exe`, Composer is located at `C:\Users\Ycole\composer\composer.phar`, and a second PHP installation is available through XAMPP at `D:\xampp\php\php.exe`.

### 1. Enable the required PHP extensions

The `intl` file exists but is not currently enabled in the command-line PHP configuration. Enable it once so normal Composer and Spark commands work without extra flags:

1. Open File Explorer and go to `C:\php`.
2. Right-click `php.ini`, choose **Open with**, and select Notepad. If Windows refuses to save, reopen Notepad with **Run as administrator**, then open `C:\php\php.ini` from Notepad.
3. Press `Ctrl+F`, search for `;extension=intl`, and remove the leading semicolon so the line reads `extension=intl`.
4. Search for `;extension=zip` and remove its leading semicolon so the line reads `extension=zip`. Zip is not required by the running website, but Composer uses it to install packages reliably.
5. Confirm `extension=mbstring` is also enabled without a leading semicolon.
6. Save `php.ini`, close all open command prompts or PowerShell windows, and open a new PowerShell window.
7. Verify the extensions:

   ```powershell
   C:\php\php.exe -m | Select-String 'intl|mbstring|zip'
   ```

   The output should list `intl`, `mbstring`, and `zip`.

If you prefer not to edit `php.ini`, prefix PHP commands with temporary extension options:

```powershell
C:\php\php.exe -d extension=intl -d extension=zip C:\Users\Ycole\composer\composer.phar install
C:\php\php.exe -d extension=intl spark serve
```

### 2. Open the project directory

In PowerShell, run:

```powershell
cd "PATH\TO\lokalcart-pos"
```

Replace `PATH\TO\lokalcart-pos` with the actual extracted or cloned project location.

### 3. Install project dependencies

The `vendor` directory is intentionally excluded from Git repositories. After cloning the project, run:

```powershell
C:\php\php.exe C:\Users\Ycole\composer\composer.phar install
```

Wait until Composer reports that it generated the autoload files. If Composer reports that `ext-intl` is missing, return to step 1.

### 4. Create the local environment file

If `.env` is not present after cloning, copy the safe template:

```powershell
Copy-Item .env.example .env
```

Open `.env` and confirm:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
app.indexPage = ''
```

### 5. Start the development server

Run:

```powershell
C:\php\php.exe spark serve
```

Keep the PowerShell window open. When the terminal says the server started, open `http://localhost:8080/` in a browser.

### 6. Verify all routes

Open each address and confirm the navigation and page content load:

- `http://localhost:8080/`
- `http://localhost:8080/about`
- `http://localhost:8080/customers`
- `http://localhost:8080/users`

Press `Ctrl+C` in the server terminal when you want to stop it.

## Automated checks

Run the full test suite from the project root:

```powershell
C:\php\php.exe vendor\bin\phpunit
```

The feature tests check that all four required pages return HTTP 200 and that both listing pages render the sample array records.

Inspect registered routes with:

```powershell
C:\php\php.exe spark routes
```

## Project structure

```text
app/
  Config/Routes.php             Four explicit GET routes
  Controllers/Pages.php         Landing and about page logic
  Controllers/Customers.php     Six-record customer array
  Controllers/Users.php         Six-record staff array
  Views/layouts/main.php        Shared header, navigation, and footer
  Views/pages/                  Landing and about views
  Views/customers/index.php     Customer foreach table
  Views/users/index.php         User foreach table
public/
  assets/css/app.css            Shared responsive design system
tests/feature/PagesTest.php     Route and content checks
database/
  no-database-required.sql      Submission note for this no-database activity
```

## GitHub submission steps

1. Sign in to GitHub and select **New repository**.
2. Name it `lokalcart-pos` and choose **Public** unless the instructor requires a private repository.
3. Do not add a README, `.gitignore`, or license on GitHub because the project already contains them.
4. Select **Create repository**.
5. In PowerShell, from the project root, run the following commands. Replace `YOUR-USERNAME` with your GitHub username:

   ```powershell
   git init
   git add .
   git commit -m "Complete CodeIgniter POS foundation"
   git branch -M main
   git remote add origin https://github.com/YOUR-USERNAME/lokalcart-pos.git
   git push -u origin main
   ```

6. Refresh the GitHub repository page and confirm the `app`, `public`, `tests`, and `database` folders appear.
7. Confirm that `.env` and `vendor` do not appear. Their omission is intentional for security and repository size; `.env.example`, `composer.json`, and `composer.lock` allow the project to be rebuilt.
8. Copy the repository URL for the submission form.

## Hosting checklist

The hosting provider must support PHP 8.2+, Composer dependencies, and a document root that can point to the `public` directory.

1. Push the final project to GitHub.
2. Create a new PHP web service with your hosting provider and connect the GitHub repository.
3. Set the build command to `composer install --no-dev --optimize-autoloader`.
4. Set the web or document root to the project's `public` directory. Do not expose the project root.
5. Add an environment variable named `CI_ENVIRONMENT` with the value `production`.
6. Set `app.baseURL` to the complete HTTPS site address, including the trailing slash, such as `https://example-host.app/`.
7. Ensure the server process can write to the `writable` directory.
8. Deploy, then open all four routes and compare them with the local version.
9. Copy the live HTTPS URL for the submission form.

Hosting dashboards differ, so use the provider's PHP deployment guide for the exact button names. Never upload the development `.env` file or expose `vendor`, `app`, or `writable` as the public web root.

## Rubric alignment

- **Functionality and completeness:** all four required routes, shared navigation, and both listing pages are implemented.
- **Code structure and organization:** routes, controllers, views, layout, CSS, and tests have separate responsibilities and consistent names.
- **Static-array data handling:** each listing controller defines six associative records; each view uses `foreach` and escapes output with `esc()`.
- **Documentation and submission quality:** this README includes local setup, verification, repository submission, and production-hosting instructions.

## References

- [CodeIgniter installation guide](https://codeigniter.com/user_guide/installation/)
- [CodeIgniter routing guide](https://codeigniter.com/user_guide/incoming/routing.html)
- [CodeIgniter controllers guide](https://codeigniter.com/user_guide/incoming/controllers.html)
- [CodeIgniter views guide](https://codeigniter.com/user_guide/outgoing/views.html)
