### **UIC** (Cuban Informatics Union)
This APP was created to manage all the information of the directors of the UIC in Pinar del Rio, Cuba, such as: *clubs*, *courses*, *members*, etc.

#### Screenshot:
![alt text](https://res.cloudinary.com/dombtm0fe/image/upload/v1536087458/screencapture-localhost-uic-pinar-public-admin-2018-09-04-15_03_11.png)

#### How to run:
- Clone: `https://github.com/Belzee10/uic-pinar.git`
- Go to the directory and run: `composer install`
- Copy `.env.example` file to `.env` on the root folder
- Open the `.env` file and change the Database parameters(`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) to whatever you have
- Run `php artisan key:generate`
- Run `php artisan migrate --seed`
- Run `php artisan serve`
- Go to `localhost:8000`


**User:** `admin@email.com`
**Password:** `123`




