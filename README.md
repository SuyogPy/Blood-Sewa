# Blood-Sewa (PHP + MySQL)

This repository has been converted to a minimal PHP + MySQL project (HTML/CSS/JS + PHP APIs).

How to run (development):

1. Create a MySQL database and import `schema.sql`:

```sh
mysql -u root -p your_database < schema.sql
```

2. Edit `api/config.php` and set `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`.

3. Start PHP built-in server from repository root:

```sh
php -S localhost:8000
```

4. Open `http://localhost:8000`.

Notes:
- The API endpoints are under `/api/*.php` and return JSON.
- Login uses PHP sessions; fetch calls include credentials.
