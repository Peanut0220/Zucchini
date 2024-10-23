1. Download three rar file (CouponService, DeliveryService, NgChongJian_LimShiLei_IP_SourceCode)
2. Extract three of the file
3. Open all file (Preferred IDE: PhpStorm 	     for NgChongJian_LimShiLei_IP_SourceCode
		  	         Visual Studio 2022  for CouponService, DeliveryService)
4. For Main Source Code file, Everything inside .env.example file and paste into .env file
5. Open terminal and run command 'composer install'
6. After that, run command 'php artisan migrate' and 'yes' to create database
7. run command 'php artisan migrate:f --seed to run seeder (Initial data)
8. run command 'php artisan serve' to start the server
9. run command 'npm run dev'
10. click on the provided link address to open the website  (Server running on [http://127.0.0.1:8000].)
11. For CouponService, make sure it run on https://localhost:44332/
12. For DeliveryService, make sure it run on https://localhost:44351/
13. Then you are good to go

Admin Account: test@example.com
Password: password

Customer 1 Account: test2@example.com
Password: password

Customer 2 Account: test3@example.com
Password: password

CreditCard Number: 1111111111111111
Expiration Date: 12/20
CVV: 123

CreditCard Number: 2222222222222222
Expiration Date: 11/22
CVV: 321

14. Important! If you are doing something related to email (receiving email), to check, 
go to 'http://127.0.0.1:8000/telescope/mail'.