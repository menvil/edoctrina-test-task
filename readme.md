# QuizApplication 

# Requirements

You must install VirtualBox 5.2
https://www.virtualbox.org/wiki/Downloads

Install Vagrant (2.0.3)
https://www.vagrantup.com/downloads.html 
=======
1. vagrant box add laravel/homestead 

During dialog select option 3 (virtualbox) 

2. sudo nano /etc/hosts
 add hosts there 
    192.168.10.10   homestead.test
3. git clone https://github.com/laravel/homestead.git ~/Homestead
4. cd ~/Homestead
5. git checkout v7.3.0
6. bash init.sh
7. vagrant up
8. vagrant ssh
9. mkdir /home/vagrant/code
10. cd /home/vagrant/code
11. Clone the repo: git clone git@github.com:menvil/quizapplication.git .
12. Install Laravel: composer install --prefer-dist
13. Rename file .env.example to .env and dit file .env for proper database values 

you can make 
mv .env.example .env

14. Migrate your database: php artisan migrate
15. Make php artisan key:generate

16. npm install
17. node socket.js
18. View application in the browser via link http://homestead.test