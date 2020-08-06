<template>
    <div class="container vertical-center mt-5" >
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Abstract</h2>
                <p>This is a working example for a very simple Document Management System DMS in laravel/Vue</p>
                <p>The full code for both front and backend pages and controllers as well as all libraries and dependences could be cloned from <a href="https://github.com/yanislavtankov/dms" target="_blank">GitHub</a></p>
                <h2>Requirements</h2>
                <ul>
                    <li><a href="https://www.php.net/" target="_blank">PHP</a> 7.2^</li>
                    <li><a href="https://httpd.apache.org/" target="_blank">Apache web server</a> version Apache/2^ (not neccessary)</li>
                    <li><a href="https://www.postgresql.org/docs/release/" target="_blank">Postgres database</a> version SQL13</li>
                </ul>
                <h2>Installation</h2>
                <p>The instalation of project could be made locally or at a web server with apache and php.</p>
                <h4>Windows installation</h4>
                <ul>
                    <li>Install PHP for Windows from <a href="https://windows.php.net/download/" target="_blank">WindowsPHP</a> website</li>
                    <li>Install PostgresSQL from <a href="https://www.postgresql.org/download/windows/" target="_bnalk">Windows.Postgres</a></li>
                    <li>Intsall Apache web server from <a href="https://httpd.apache.org/docs/2.4/platform/windows.html" target="_blank">Windows.Apache</a> (not neccessary)</li>
                    <li>Set up the database by follwing commands:<br><i>
                            psql<br>
                            create database "name";<br>
                            create user "name" with encrypted password 'pass…';<br>
                            grant all privileges on database "name" to "name";<br></i>
                    </li>
                    <li>Clone the project from <a href="https://github.com/yanislavtankov/dms" target="_blank">GitHub</a>. Open a terminal window, select a folder and type <i>git clone https://github.com/yanislavtankov/dms</i></li>
                    <li>Change folder to the newly created one -> "dms". Just type <i>cd dms</i></li>
                    <li>Within the dms folder type <i>composer update</i> to install all dependencies required for PHP</li>
                    <li>Change the file .env in dms folder as followig:<br><strong>
                        DB_CONNECTION=pgsql<br>
                        DB_HOST=127.0.0.1<br>
                        DB_PORT=5432<br>
                        DB_DATABASE="database name"<br>
                        DB_USERNAME="user nam"<br>
                        DB_PASSWORD="your password for the database"<br></strong>
                    </li>
                    <li>Type <i>php artisan passport:install</i> to initialize the Passport oAuth engine for Laravel</li>
                    <li>Type <i>php artisan migrate</i> to set up the databases</li>
                    <li>in the terminal window type <i>php artisan serve</i> to start the web server</li>
                    <li>Go to address bar in your browser and type http://localhost:8000 to open the app</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('About page')
        }
    }
</script>
