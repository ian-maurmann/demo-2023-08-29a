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

- Test PHP version
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

- Check that everything was installed correctly. Reveiw the list of installed packages with Composer Show:
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


