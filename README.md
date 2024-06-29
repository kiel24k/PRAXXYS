<h1>Installation proccess</h1>


<p>download and install composer ( https://getcomposer.org/download/ )</p>
<br>
<p>download and install node ( https://nodejs.org/en )</p>
<br>
<p>download and install xampp( php 8.2.12 ) ( https://www.apachefriends.org/ )</p>
<br>
<p>Open command prompt</p>
<br>
<p>Add this command to your current path of your terminal => git clone https://github.com/kiel24k/PRAXXYS.git</p>
<br>
<p>Open the folder where you installed the repository( PRAXXYS ) in your cmd path earlier and open it to code editor( VS code,Sublime,Atom etc )</p>
<br>
<p>inside the Folder open the terminal and paste this command:</p>
    <p>=> composer install</p>
    <p>=> php artisan storage:link</p>
    <p>=> php artisan key:generate</p>
    <p>=> php artisan db:seed</p>
    <p>=> php artisan db:seed --class=ProductSeeder</p>
    <p>=> npm install</p>
    <br>
<p>at your folder(PRAXXYS) find ( .env.example ) file and change the name to .env</p>
<br>
<p>inside the .env remove the ( DB_CONNECTION=sqlite ) then paste this code:</p>
      <p>DB_CONNECTION=mysql</p>
      <p>DB_HOST=127.0.0.1</p>
      <p>DB_PORT=3306</p>
      <p>DB_DATABASE=praxxysdb</p>
      <p>DB_USERNAME=root</p>
      <p>DB_PASSWORD=</p>
<p>at your current code editor create 2 command prompt and paste this per command prompt</p>
    <p>=> php artisan serve</p>
    <p>=> npm run dev</p>
<br>
<p>add this your web browser ( http://127.0.0.1:8000 ) //this is the default localhost</p>
<p>login with:</p>
    <p>email: admin or admin@gmail.com</p>
    <p>password: 123456</p>


      
    

