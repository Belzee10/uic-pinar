### **UIC** (Union de informaticos de Cuba)
#### Official website of the Union of the Cuban Informatics (UIC).

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




