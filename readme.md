# Pro-control

Pro-control is a small PHP application for adding, editing, and archiving cabinet and field-device records. It uses PDO to connect to Microsoft SQL Server.

## Project structure

```text
backend/
  Controller/       HTTP actions for device-related requests
  Entity/           Device data model and form mapping
  Service/          Database-backed device operations
  Util/             Database connection and table-name validation
  bootstrap.php     Loads the backend classes
frontend/
  Controller/       Page routing and view rendering
  Components/       Shared navigation and footer
  views/            Shared page templates
public/
  *.php             Public routes and request entrypoints
  assets/
    css/global.css  Shared styles and CSS custom properties
    js/             Compiled browser modules (generated from TypeScript)
    images/         Public images
package.json        TypeScript build scripts and compiler dependency
tsconfig.json       TypeScript compiler configuration
```

Configure the web server's document root to `public/`. Only this folder should be publicly served. Page templates and backend source remain outside the document root.

Cabinet and field edit pages share `frontend/views/edit-device.php`; cabinet and field archive-detail pages share `frontend/views/archive-device.php`. The table name is selected by the page controller, so their presentation and request handling are maintained once.

## Backend request flow

1. A route in `public/` forwards the request to `backend/Controller/DeviceController.php`.
2. The controller validates the request and delegates database work to `backend/Service/DeviceService.php`.
3. The service uses `backend/Util/Database.php` for its PDO connection and `backend/Util/DeviceTable.php` to allow only the two device tables.
4. `backend/Entity/Device.php` maps submitted form fields to database columns.

## Frontend request flow

Page entrypoints in `public/` call `frontend/Controller/PageController.php`, which selects a template from `frontend/views`. Shared navigation and footer markup live in `frontend/Components`. Browser code is written in TypeScript in `frontend/Controller` and `frontend/Service`; compiling it emits standard JavaScript modules into `public/assets/js`, which browsers load.

All pages load styles from `public/assets/css/global.css`. Theme colors, fonts, spacing, and layout values are defined as CSS custom properties under `:root`; use those variables rather than repeating literal values.

## Local setup

1. Install PHP 8.0 or newer with the PDO SQL Server driver (`pdo_sqlsrv`) enabled.
2. Install Node.js and npm, then run `npm install` and `npm run build:typescript` from the project root.
3. Copy `.env.example` to `.env` in the project root. The defaults connect to `(localdb)\MSSQLLocalDB`, database `devices`, using the current Windows account. Ensure that database and the `cabinet_devices` and `field_devices` tables exist in your LocalDB instance.
4. If using SQL Server authentication, set `PROCONTROL_DB_USER` and `PROCONTROL_DB_PASSWORD` in `.env`. Leave them empty for Windows authentication. The `.env` file is ignored by Git; environment variables already set by your system take precedence over values in `.env`.
5. From the project root, start PHP's development server with `php -S localhost:8000 -t public`.
6. Open `http://localhost:8000`.

After changing TypeScript files, run `npm run build:typescript` to regenerate the browser modules. Run `npm run check:typescript` to type-check without writing output.

Database dumps and device/catalog CSVs contain local data and are intentionally excluded from Git. For a fresh checkout, obtain an approved SQL Server schema/import script and any required data through your organization's authorized channel. If you already have the local `database/sqlserver-devices.sql` file, it can be run in SQL Server Management Studio against an empty `devices` database; it stops if either target table already exists.

The root `devices.sql` file is a MariaDB/MySQL export and is not compatible with SQL Server. Do not run it in SQL Server.

## Existing URLs

- `index.php` — home
- `add.php` — add a record
- `Edit.php` — active records
- `archive.php` — archived records
- `edit_single_cabinet.php` and `edit_single_field.php` — edit a record
- `archive_single_cabinet.php` and `archive_single_field.php` — archive/restore record details
- `get_category_data.php`, `get_category_price.php`, and `insert_data.php` — device form endpoints
- `get_instrument_data.php` — legacy alias for the instrument-price endpoint

`archive_single.php` remains as an alias for cabinet archive details. `get_instrument_data.php` remains as a legacy alias for the instrument-price endpoint. `Style.css` remains as a legacy stylesheet alias.

The edit, archive, list, and create pages use the device service for database operations. Keep SQL in backend services when extending the application; page templates should handle presentation, not database connections or queries.
