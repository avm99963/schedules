# schedules
Schedule viewer for the Barcelona subway.

## Installation
1. Clone this repository (usually in Apache's publicly accessible folder).
2. Install PHP 7.2+ with the `ZipArchive` and `PDO` classes (specifically install the `PDO_SQLITE` driver)
3. Copy the `config.default.php` file to `config.php` and fill in the details (you can get an API key directly from TMB [here](https://developer.tmb.cat/).
  - In `$conf["databaseFile"]` enter the absolute path of the location where you want to save your database (including the file name). If the website is located in the `/var/www/html/schedules/` folder, you can create a new `files` folder there and set the variable to `/var/www/html/schedules/files/gtfs.sqlite3`.

## Notes
- As I've been able to see when using this app around Barcelona, the schedules provided by TMB are a very vague approximation of the departure times for all lines except for the automated lines. In the case of the automated lines, the timing is precise within a second.
- As of now, the timezone set in the server must be Europe/Madrid (because of the way sqlite3 treats timezones). Otherwise, the app will not work properly.
