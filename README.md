# Hi there 👋

## Getting Started

To set up the project, follow these steps:

1. **Dump Autoload**:
   ```bash
   composer dump-autoload
   ```
2. **Run Migrations**:
   ```bash
   php migrate.php
   ```
3. **Start the server**
   ```bash
   php -S localhost:3000
   ```

### Environment Variables

If you need to modify the database credentials, create a .env file with the following variables:

```env
DB_HOST=localhost
DB_NAME=yonivers
DB_USER=root
DB_PASSWORD=root
```

## Responses to questions :

### Exercise 2 : Database

- Question : Which field(s) should be indexed to optimize query execution :

Response : In the loans table we need to index book_id and member_id fields because they are related to members and books table

### Exercise 4 : Prime Numbers

- Question : Describe an algorithm to check if a number is a prime number. A simple description of the algorithm (pseudocode) is enough...

Response :

First, we can create a function with one argument which is a number.

Secondly we can check if the number is smaller than 2, then we can break the function

After that we can create a loop, inside create a condition with this (%) and push all prime numbers inside a results array.

```php

function pseudoCode(int $n) {
    if ($n < 2) {
        return [];
    }

    $premiers = [];

    for ($i = 2; $i <= $n; $i++) {
        if ($i % 2 === 0) {
            $premiers[] = $i;
        }
    }

    return $premiers;
}

pseudoCode(50);
```

### Description of the project structure :

You have all controllers inside app/Controllers. They receive the client request, interact with database functions (inside app/Models) or validators (app/Helpers/Validator) if its necessary and return the result to the client

All html views are inside views folder and the css inside assets folders.

The database migrations are inside migrations folder they are lunch by date like 20240621 and a number like 01 or 02 ...

To lunch migrations you just have to write this command line : php migration.php
