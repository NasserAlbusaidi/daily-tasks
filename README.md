
### Step-by-Step Guide to Installing the Project with XAMPP, Composer, etc.

#### Step 1: Prerequisites
- Make sure you have XAMPP installed on your system. If not, you can download it from [here](https://www.apachefriends.org/index.html).
- Install Composer, the PHP dependency manager. If you don't have it, get it from [here](https://getcomposer.org/).

#### Step 2: Clone the Repository
- Open your terminal or command prompt.
- Navigate to the directory where you want to clone the project.
- Run the following command:
  ```
  git clone https://github.com/NasserAlbusaidi/daily-tasks.git
  ```

#### Step 3: Start XAMPP
- Open XAMPP and start the Apache and MySQL services.

#### Step 4: Install Project Dependencies
- Navigate to the project directory.
- Run the following command to install the required dependencies:
  ```
  composer install
  ```

#### Step 5: Migrate the Tables
- Open the `.env` file and set up your database connection details.
- Run the following command to migrate the tables:
  ```
  php artisan migrate --seed
  ```

#### Step 6: Link Storage
- Run the following command to link the storage folder:
  ```
  php artisan storage:link
  ```

#### Step 7: Run the Project
- Finally, run the following command to start the project:
  ```
  php artisan serve
  ```
- Open your web browser and navigate to `http://localhost:8000`.
