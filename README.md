# crm-yii2

This is a small CRM project I developed using Yii2 framework as part of my self-learning. You can use it at your own risk.

# Installation
* Install composer
* Install composer asset plugin by executing console command `composer global require "fxp/composer-asset-plugin:^1.2.0"`
* Clone the project and install Yii2 packages by executing command `composer update`
* You might get errors regarding **GitHub OAuth token**. Create a token (**public_repo** permission is sufficient) as described on **https://help.github.com/en/github/authenticating-to-github/creating-a-personal-access-token-for-the-command-line** and retry following prompts. Same for API limit errors. 
* Open `web/server-configuration.php` for server name and environment definitions. Pick the environment you want to run the application and either update your web server's configuration or the environment setting for the server name you want to use. 
* Based on the environment you chose, update `config/db[-prod/stage].php` for database settings.
* Run migrations by executing command `yii migrate`
* Once all migrations are executed successfully, open application in your browser and use credentials in the seeder `migrations/m151102_000902_seed_users_table.php`
* If you get some error messages related to **AppDbManager** class, it means framework updates are incompatible with the modified `helpers\AppDbManager.php` caching component. You can quickly solve this by editing `config/web.php` so that uncomment line 75, comment lines 77 & 78. It should look like this:
```
      'class' => 'yii\rbac\DbManager',
      // superchaching below: 60 second timeout + per request caching
      //'class' => 'app\helpers\AppDbManager',
      //'cache' => 'yii\caching\FileCache'
```

# Features
* Application is fully responsive
* There are 3 configuration options for development, staging and production environments. Environment detection happens on the fly.
* A transparent decal on the top-left corner will be visible to reveal environment type when the application is running in development or staging mode 
* Application is based on Yii2's Basic Application Template. However it is updated to allow DB driven user registration, password recovery and RBAC management
* An enhanced DBManager component is added which handles DB query caching for RBAC and AppHelper queries.
* Application uses some JQuery plugins for date/datetime selection.
* Application has 3 types of visualisation for reports: i) Bar chart, ii) Pie chart & iii) 3D-Donut. They are generated using D3 (Data-Driven Documents) JavaScript library. See screenshots.
* Lead conversion is available
* Contacts can have pictures
* Contacts and Accounts can have social media links
* Object updates are stored per field basis and they can be accessed using *View Update History* links with the user performed the update + update timestamps
* Dropdown lists can be managed by admin user
* User accounts can be managed by admin user
* Screenshots can be checked quickly to get an idea of application features

