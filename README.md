<h2>Abstract</h2>
<p>This is a working example for a very simple Document Management System DMS in laravel/Vue</p> <p>The full code for both front and backend pages and controllers as well as all libraries and dependences could be cloned from <a href="https://github.com/yanislavtankov/dms" target="_blank">GitHub</a></p> 

<h2>Requirements</h2> <ul><li><a href="https://www.php.net/" target="_blank">PHP</a> 7.2^</li> <li><a href="https://httpd.apache.org/" target="_blank">Apache web server</a> version Apache/2^ (not neccessary)</li> <li><a href="https://www.postgresql.org/docs/release/" target="_blank">Postgres database</a> version SQL13</li></ul> <h2>Installation</h2> <p>The instalation of project could be made locally or at a web server with apache and php.</p> <h4>Windows installation</h4> <ul><li>Install PHP for Windows from <a href="https://windows.php.net/download/" target="_blank">WindowsPHP</a> website</li> <li>Install PostgresSQL from <a href="https://www.postgresql.org/download/windows/" target="_bnalk">Windows.Postgres</a></li> <li>Intsall Apache web server from <a href="https://httpd.apache.org/docs/2.4/platform/windows.html" target="_blank">Windows.Apache</a> (not neccessary)</li> <li>Set up the database by follwing commands:<br><i>
                        psql<br>
                        create database "name";<br>
                        create user "name" with encrypted password 'pass…';<br>
                        grant all privileges on database "name" to "name";<br></i></li> <li>Clone the project from <a href="https://github.com/yanislavtankov/dms" target="_blank">GitHub</a>. Open a terminal window, select a folder and type <i>git clone https://github.com/yanislavtankov/dms</i></li> <li>Change folder to the newly created one -&gt; "dms". Just type <i>cd dms</i></li> <li>Within the dms folder type <i>composer update</i> to install all dependencies required for PHP</li> <li>Change the file .env in dms folder as followig:<br><strong>
                    DB_CONNECTION=pgsql<br>
                    DB_HOST=127.0.0.1<br>
                    DB_PORT=5432<br>
                    DB_DATABASE="database name"<br>
                    DB_USERNAME="user nam"<br>
                    DB_PASSWORD="your password for the database"<br></strong></li> <li>Type <i>php artisan passport:install</i> to initialize the Passport oAuth engine for Laravel</li> <li>Type <i>php artisan migrate</i> to set up the databases</li> <li>in the terminal window type <i>php artisan serve</i> to start the web server</li> <li>Go to address bar in your browser and type http://localhost:8000 to open the app</li></ul>



<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**

### Community Sponsors

<a href="https://op.gg"><img src="http://opgg-static.akamaized.net/icon/t.rectangle.png" width="150"></a>

- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [云软科技](http://www.yunruan.ltd/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
