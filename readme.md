# QuizApplication 

#Requirements
You must install VirtualBox 5.2
https://www.virtualbox.org/wiki/Downloads

Install Vagrant (2.0.3)
https://www.vagrantup.com/downloads.html 

mkdir homestead
cd homestead
vagrant box add laravel/homestead
vagrant init laravel/homestead

config.vm.network "private_network", ip: "192.168.10.10"
  
vagrant up
sudo nano /etc/hosts
add 192.168.10.10   homestead.test

config.vm.network "forwarded_port", guest: 80, host: 8080


git clone https://github.com/laravel/homestead.git ~/Homestead
cd ~/Homestead
git checkout v7.3.0
bash init.sh
vagrant up



----


1. Clone the repo: git clone git@github.com:menvil/quizapplication.git .
2. Install Laravel: composer install --prefer-dist
3. Rename file .env.example to .env and dit file .env for proper database values (mv .env.example .env)

DB_HOST=127.0.0.1
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=

4. Migrate your database: php artisan migrate
5. Seed your database: php artisan db:seed
6. Make php artisan key:generate
7. View application in the browser!