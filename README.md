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
<p>Open the folder where you installed the clone(PRAXXYS) in your cmd path earlier and open it to code editor(VS code,Sublime,Atom etc)</p>
<br>
<p>inside the Folder open the terminal and paste this command:</p>
    <p>=> composer install</p>
    <p>=> php artisan storage:link</p>
    <p>=> php artisan key:generate</p>
    <p>=> php artisan db:seed</p>
    <p>=> php artisan db:seed --class=ProductSeeder</p>
    <p>=> npm install</p>
  
- at your folder(PRAXXYS) find ( .env.example ) file and change the name to .env
- 
- inside the .env remove the ( DB_CONNECTION=sqlite ) then paste this code:
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=praxxysdb
      DB_USERNAME=root
      DB_PASSWORD=
-at your terminal paste this:
    => php artisan serve
    => npm run dev
  
- add this your web browser ( http://127.0.0.1:8000 ) //this is the default localhost
- 
- login with:
    email: admin or admin@gmail.com
    password: 123456


      
    

