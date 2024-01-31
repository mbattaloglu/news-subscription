# Subscribe newsletter form

This project is for trying to understand how to use the [PHPMailer](https://github.com/PHPMailer/PHPMailer)

## Requirements

### Backend

1. Local server `XAMPP, WAMP, MAMP, etc.` (For Windows, I recommend XAMPP)
2. Composer

## How to use

1. Clone this repository
2. Copy the backend folder to your local server(for XAMPP, copy to htdocs folder)
3. Run `composer install`
4. Go your database management system (phpmyadmin, adminer, etc.)
5. Create a database named `news_subscription`
6. Import the `news_subscription.sql` file to the database
7. Open the `subscribe/index.php` file and change the database credentials.
8. Open the `sendEmail/credentials.php` file and change the SMTP Server credentials.

- App uses Outlook SMTP Server. You can change it to your SMTP Server. You can find the SMTP Server credentials in your email account settings.

After that, you can run the `frontend/public/index.html` file in your browser. You will see a form. Fill the form and submit. You will see the success message if the email is sent successfully. You can check the database to see the email address you submitted.

_**NOTE:** You can directly run the `frontend/public/index.html` file in your browser without running backend. But, you will not see the success message. Because you need to run the in a PHP server for full functionality._
