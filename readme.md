# Project Documentation

## Installation and Setup

### Installing XAMPP

#### Download XAMPP:
- Go to the [XAMPP official website](https://www.apachefriends.org/index.html).
- Download the version of XAMPP suitable for your operating system (Windows, macOS, or Linux).

#### Install XAMPP:
- Run the downloaded installer.
- Follow the installation prompts. It’s usually recommended to install XAMPP in the default directory (`C:\xampp` on Windows).

#### Start XAMPP:
- Open the XAMPP Control Panel. You can find it in the XAMPP installation directory or via a shortcut on your desktop.
- In the XAMPP Control Panel, click the “Start” button next to Apache to start the Apache server.

### Configuring Apache Server

#### Access Apache Configuration:
- In the XAMPP Control Panel, click on the “Config” button next to Apache.
- Select “Apache (httpd.conf)” to open the Apache configuration file in a text editor.

#### Check Document Root:
- Locate the line `DocumentRoot "C:/xampp/htdocs"`. This is the directory where Apache serves your files from.
- Ensure this path points to the `htdocs` folder in your XAMPP installation directory.

#### Restart Apache:
- After making any configuration changes, restart Apache by clicking the “Stop” button and then the “Start” button in the XAMPP Control Panel.

### Using Localhost

#### Accessing Your Project:
- Place your project files inside the `htdocs` directory located in your XAMPP installation directory (`C:\xampp\htdocs`).
- For example, if your project folder is named `my_project`, place it in `htdocs` so the path becomes `C:\xampp\htdocs\my_project`.

#### Viewing Your Project:
- Open a web browser and go to `http://localhost/my_project/` to view your project. Replace `my_project` with the actual folder name of your project.

### File Location

#### HTML/PHP Files:
- Your HTML and PHP files should be placed inside the `htdocs` directory or a subdirectory within `htdocs`.
- Example file structure: `C:\xampp\htdocs\my_project\form_entry.php`, `C:\xampp\htdocs\my_project\form_preview.php`.
# Steps to Create a Database in phpMyAdmin

## 1. Open XAMPP Control Panel
Launch the XAMPP Control Panel and start the following services:
- **Apache**
- **MySQL**

## 2. Access phpMyAdmin
- Open your web browser.
- Enter `http://localhost/phpmyadmin` in the address bar.
- This will open the phpMyAdmin interface.

## 3. Create a New Database
- Once inside phpMyAdmin, look at the top of the interface, and you will find the **"Databases"** tab. Click on it.
- Under **"Create database"**, enter a name for your new database (eg., `train_details`).
- Select the collation (optional, default is `utf8mb4_general_ci`).
- Click **"Create"**.

## 4. Create Tables in Your Database
- After creating the database, you will be taken to a page where you can add tables to it.
- Enter a table name and specify the number of columns.
- Define the fields for each column, including `Name`, `Type` (e.g., `INT`, `VARCHAR`), and other attributes.
- Click **"Save"** to create the table.

## 5. Confirm Database Creation
- Once your database and tables are created, you can view them under the left sidebar in phpMyAdmin.
- Your newly created database should appear, and you can manage it from there.
