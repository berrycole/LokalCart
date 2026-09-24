# LokalCart POS TFA2

LokalCart POS TFA2 is a CodeIgniter 4 application for IT0049 Technical Formative Assessment 2. It extends TFA1 by replacing static customer and user arrays with a MySQL database and CodeIgniter Models.

## Completed requirements

| Requirement | Implementation |
| --- | --- |
| Database connection | .env and .env.example define MySQLi settings for lokalcart_pos_tfa2. |
| Schema and data | database/lokalcart_pos_tfa2.sql creates customers and users and adds six records to each. |
| Models | CustomerModel and UserModel map to the required tables. |
| Query usage | Controllers use their Models with orderBy()->findAll(). |
| Views | The responsive account tables render retrieved records with esc(). |

## Routes

| Route | Controller | Database source |
| --- | --- | --- |
| / | Pages::index | None |
| /about | Pages::about | None |
| /customers | Customers::index | CustomerModel and customers |
| /users | Users::index | UserModel and users |

## Local setup on Windows

### 1. Install PHP dependencies

Open PowerShell in the project folder:

~~~powershell
C:\php\php.exe -d extension=intl -d extension=mysqli C:\Users\Ycole\composer\composer.phar install
~~~

Use the PHP executable installed on your computer if it is stored elsewhere. PHP 8.2+, intl, and mysqli are required.

### 2. Start MySQL and import the export

Start MySQL in XAMPP or another local MySQL installation. In phpMyAdmin, open http://localhost/phpmyadmin, select Import, choose database/lokalcart_pos_tfa2.sql, and click Import.

The export creates the lokalcart_pos_tfa2 database, both required tables, and six sample records in each table. Import it into a fresh local database; repeating the import adds duplicate customer rows.

### 3. Confirm .env settings

This project contains a ready-to-edit .env file. After cloning from GitHub, create it with:

~~~powershell
Copy-Item .env.example .env
~~~

The default settings assume a normal local XAMPP/MySQL installation:

~~~ini
database.default.hostname = localhost
database.default.database = lokalcart_pos_tfa2
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
~~~

Change the username, password, or port only when your MySQL setup uses different credentials. Never commit .env.

### 4. Run and verify

~~~powershell
C:\php\php.exe -d extension=intl -d extension=mysqli spark serve
~~~

Open:

- http://localhost:8080/
- http://localhost:8080/about
- http://localhost:8080/customers
- http://localhost:8080/users

Customers should display six records; Users should display six records and their creation dates. Stop the server with Ctrl+C.

## Tests

~~~powershell
C:\php\php.exe -d extension=intl -d extension=mysqli vendor\bin\phpunit
~~~

The automated checks verify the non-database routes and Model classes. Verify the database-backed pages after importing the SQL export because they intentionally connect to local MySQL.

## Project structure

~~~text
app/Controllers/Customers.php    Reads customers through CustomerModel
app/Controllers/Users.php        Reads users through UserModel
app/Models/CustomerModel.php     Customer table model
app/Models/UserModel.php         User table model
database/lokalcart_pos_tfa2.sql  MySQL schema and sample records
~~~

## GitHub and hosting submission

1. Create a new public repository, for example LokalCart-TFA2.
2. From this project, point Git to the new repository and push:

~~~powershell
git remote set-url origin https://github.com/YOUR-USERNAME/LokalCart-TFA2.git
git add .
git commit -m "Complete LokalCart POS TFA2 database integration"
git branch -M main
git push -u origin main
~~~

3. Confirm GitHub includes app, database/lokalcart_pos_tfa2.sql, public, tests, .env.example, and README.md, but not .env or vendor.
4. Deploy with a host that supports PHP and MySQL, points its web root to public, and stores database credentials securely.
5. Submit the GitHub repository link and deployed HTTPS link required by the assignment.

## Rubric alignment

- Functionality: the four original routes remain available with database-backed account listings.
- Code structure: controllers, models, views, SQL export, and tests are kept separate.
- Database design: the export matches the required schema and controllers use CodeIgniter Models instead of raw SQL.
- Documentation: this README covers import, configuration, verification, GitHub, and hosting.

## References

- [CodeIgniter Models](https://codeigniter.com/user_guide/models/model.html)
- [CodeIgniter Query Builder](https://codeigniter.com/user_guide/database/query_builder.html)
