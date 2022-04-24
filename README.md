# About Monday Times

# Features
Boards data from monday.com <br/>
Export board data into excel

# Requirements

Linux/Unix, WAMP/XAMP/Laragon or MacOS environment<br/>
PHP >= 8.0<br/>
MySQL >= 5.7.8, MariaDB >= 10.2.2<br/>
Web server (Apache, Nginx or integrated PHP web server for testing)<br/>
If required PHP extensions are missing, composer will tell you about the missing dependencies.<br/>

# Installation

**Follow git instructions on how to clone a repository or you can just download the project as a zip folder extract the zip folder into your host server root**

*Make sure your CLI/bash/terminal is in the project folder*<br/>
*You can use any code editor you like*

To install this application, composer >= 2.1 is required. On the CLI, execute this command for a complete installation including a working setup:

<pre>Composer install</pre>

You will also need to install NPM dependencies for the frontend (make sure you have node installed on your computer)

<pre>npm install && npm run dev</pre>

Create env file. In the .env file add your database credentials then generate an app_key

<pre>cp .env.example .env</pre>

Generate APP_KEY

<pre>php artisan key:generate</pre>

Create a Database in MySQL then add database name/username/password inside your .env that you created
*Note: you can use any database you want, remember to change the database driver in the config/database*

<pre>
DB_CONNECTION=mysql<br/>
DB_HOST=127.0.0.1<br/>
DB_PORT=3306<br/>
DB_DATABASE=monday<br/>
DB_USERNAME=root<br/>
DB_PASSWORD=<br/>
</pre>

Run migration to add tables into the database and seed entries into the database using the following command in your CLI

<pre>php artisan migrate --seed</pre>

Lastly run application

<pre>php artisan serve</pre>

## Security Vulnerabilities

If you discover a security vulnerability within this app, please send an e-mail to Me via www.tafarashamu.co.za. All security vulnerabilities will be addressed.

## License

This Application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
