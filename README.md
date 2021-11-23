# Description

This is a simple frontend intended for displaying data contained in a specific MySQL database and schema.

**SECURITY CONSIDERATIONS WERE NOT TAKEN INTO ACCOUNT** due to this project being intended for demonstration purposes only.

# Setup

Requirements:
Apache (or another web server),
MySQL,
PHP

1. **REQUIRED:** The contents of [/www/html](/www/html) must be moved/copied into your webserver's root, or the webserver must be configured to serve the contents of [/www/html](/www/html).
2. **REQUIRED:** To set up the MySQL database, run [/setup-mysql.sql](setup-mysql.sql) in a MySQL shell.
3. **REQUIRED:** To set up required environment variables, make a copy of [/www/html/.env.example](/www/html/.env.example) and rename it `.env`. Configure the `.env` file as needed.
    - MySQL credentials **must** be configured.
4. Setup and configuration complete!

## Author(s)

All author(s) are students at San Francisco State University, San Francisco, California.
This project was created as part of a group project for CSC 0675-01 Introduction to Database Systems Fall 2021.

* **Olivier Chan Sion Moy**

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
