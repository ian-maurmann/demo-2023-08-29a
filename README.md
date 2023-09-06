# demo-2023-08-29a
Demo

---
# Overview

The word density helper opens with a list of given URLs:
![Screenshot 1](https://github.com/ian-maurmann/demo-2023-08-29a/blob/master/data/doc-images/screenshot-1.png?raw=true)

New URLs can be added with the "Add New URL" button:
![Screenshot 2](https://github.com/ian-maurmann/demo-2023-08-29a/blob/master/data/doc-images/screenshot-2.png?raw=true)

Clicking on the URL opens the list of word-density tests run to-date:
![Screenshot 3](https://github.com/ian-maurmann/demo-2023-08-29a/blob/master/data/doc-images/screenshot-3.png?raw=true)

When clicking on the test, the word-density results are listed:
![Screenshot 4](https://github.com/ian-maurmann/demo-2023-08-29a/blob/master/data/doc-images/screenshot-4.png?raw=true)

# Local Installation

### 1) Clone / Copy to project folder.


### 2) Install Composer
- Open the terminal and navigate to the project folder.
- Install Composer. Follow the instruction at [Download Composer](https://getcomposer.org/download/).

### 3) Run Composer

- Test PHP version is 8.2 or higher
```bash
php -v
```

- See that Composer is really there and working.

```bash
php composer.phar
```

- Run Composer:

```bash
php composer.phar install

php composer.phar update
```

- Check that everything was installed correctly. Review the list of installed packages with Composer Show:
```bash
php composer.phar show
```
![composer.phar show](https://github.com/ian-maurmann/demo-2023-08-29a/blob/master/data/doc-images/composer-show.png?raw=true)


Also for further reference, here's the composer-cheat-sheet by u/nicwortel
https://cheat-sheets.nicwortel.nl/composer-cheat-sheet.pdf

### 3) Copy the migration script to run the Doctrine migrations

```bash
cp vendor/pith/framework/mig .
```

### 4) Configure the Env file

- Copy `env.dist.php` to `env.php`
- Add your own settings.

### 5) Run Migrations

- Test that doctrine migrations will work.

```bash
php mig
```
- Look at the list of migrations

```bash
php mig migrations:list
```

- Run all migrations

```bash
php mig migrations:migrate
```

- The list of migrations should all be green now

```bash
php mig migrations:list
```

![mig migrations:list](https://github.com/ian-maurmann/demo-2023-08-29a/blob/master/data/doc-images/mig-migrations-list.png?raw=true)

- The database tables should all exist now.

![Sequel Pro table list](https://github.com/ian-maurmann/demo-2023-08-29a/blob/master/data/doc-images/sequel-pro-table-list.png?raw=true)


# Run Local

Navigate to the public-local folder
i.e:

```bash
cd public-local/
```

Tell PHP to run locally on port 8080, using serve.php

Ex:

```bash
php -S 127.0.0.1:8080 serve.php
```

Now open your web browser and open http://127.0.0.1:8080/

The project should be live and running now.

# LAMP non-local install

### 1) SSH into webserver

https://www.wikihow.com/Use-SSH

### 2) Check PHP version on running on the server
- Test PHP version is 8.2 or higher
```bash
php -v
```

### 3) Create repositories/ folder

Create a repositories/ folder outside the webroot.

i.e. Go to lowest folder:
```bash
cd ~
```

Look at folder. Look to see if the repositories/ folder already exists.
```bash
ls 

ls -la
```

Create repositories/ folder


```bash
mkdir repositories

ls
```

### 4) Clone to repositories folder.


Check that Git is already installed.

```bash
git --version
```


Clone

```bash
git clone https://github.com/ian-maurmann/demo-2023-08-29a.git
```

There should now be a demo-2023-08-29a/ folder inside of repositories/

```bash
ls
```

### 5) Install Composer
- Open the terminal and navigate to the project folder.
- Install Composer. Follow the instruction at [Download Composer](https://getcomposer.org/download/).

### 6) Run Composer

- Test that Composer is really there and working.

```bash
php composer.phar
```

- Run Composer:

```bash
php composer.phar install

php composer.phar update
```

- Check that everything was installed correctly. Review the list of installed packages with Composer Show:
```bash
php composer.phar show
```

### 7) Copy the migration script to run the Doctrine migrations

```bash
cp vendor/pith/framework/mig .
```

### 8) Create MySQL / MariaDB database

Create a MySQL or MariaDB database on the server, or at a location that the server can remotely connect to.

Keep the new database info, and data user info on-hand for the next step.

### 9) Configure the Env file

- Copy `env.dist.php` to `env.php`

```bash
cp env.dist.php env.php
```

- Add your own settings to env.php. To edit this you'll want to use Vim or else have FTP access. On Mac I use Cyberduck. Ex:

It should look something like:
```php
/**
* Env Constants
*
* @noinspection PhpConstantNamingConventionInspection - Long constant names are ok here.
*/

// Turn on strict types
declare(strict_types=1);

// Define our Constants
const PITH_APP_DATABASE_DSN           = 'mysql:host=127.0.0.1;dbname=XXXXXXXXXXXXXX';
const PITH_APP_DATABASE_USER_USERNAME = 'YYYYYYYYYYYYYYYYY';
const PITH_APP_DATABASE_USER_PASSWORD = 'ZZZZZZZZZZZZZZZZZ';

const PITH_DATABASE_MIGRATIONS_DATABASE_NAME   = 'XXXXXXXXXXXXXX';
const PITH_DATABASE_MIGRATIONS_DATABASE_HOST   = '127.0.0.1';
const PITH_DATABASE_MIGRATIONS_DATABASE_DRIVER = 'pdo_mysql';

const PITH_DEV_ACCESS_IP_ADDRESSES = ['127.0.0.1'];

const PITH_IMPRESSION_LOG_ENABLE   = false;
const PITH_IMPRESSION_LOG_LOCATION = 'logs/impressions-log';
```

Where XXXXXXXXXXXXXX is the database's name or schema name, YYYYYYYYYYYYYYYYY is the database user name, and ZZZZZZZZZZZZZZZZZ is database user password.


### 10) Run Migrations on the server to set up our tables on the database

- Test that doctrine migrations will work.

```bash
php mig
```
- Look at the list of migrations

```bash
php mig migrations:list
```

- (If your env isn't configured correctly above, you'll get an error like:

)





- Run all migrations

```bash
php mig migrations:migrate
```

- The list of migrations should all be green now

```bash
php mig migrations:list
```

- The database tables should all exist now.


### 11) Update the .htaccess file

On the server, go into the web root folder and update (or create) the .htaccess file.

It should be something like:

```htaccess
# Hide folders
Options -Indexes

# Turn on the Rewrite Engine
RewriteEngine On


# Force HTTPS
RewriteCond %{HTTPS} off
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Rewrite non-existent files to index
RewriteCond %{REQUEST_FILENAME} !-s
RewriteCond %{REQUEST_FILENAME} !-l
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ index.php [NC,L]
```

Where routes and non-existent files are being rewritten to the index.

### 11) Update the Index file in the web root folder

Add / update the index.php file in the web root folder to this:

```php
<?php 

error_reporting(E_ALL);
ini_set('display_startup_errors', '1');
ini_set('display_errors', 1);

// Switch folders
chdir('../../repositories/demo-2023-08-29a/'); // <---- Change to correct folder

require 'public-web/index.php';

```

(If there's an index.html file, rename or delete it so that it doesn't take precedence over index.php)