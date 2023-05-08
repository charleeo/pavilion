To configure and run this application, the following steps should be followed:

## PHP 8 is required
## MySQL Database 
## NPM or Yarn for JavaScript Libraries management

Start by creating a .env file in the project root directory and copy the .example.env file contents into the .env file. 
After then, configure the .env file with the neccessary details.
For sending Mail, I used maitrap.io, you can use any SMTP provider for this. When you are done setting up the .env file, please run the following commands:
# 'composer update' to install all the PHP related dependencies
# 'npm install /yarn add' install to install all JavaScript related data 
# 'php artisan migrate' to create all the database structure
# 'php artisan db:seed' to create some master data
# 'npm run dev' for local environment or 'npm run build' for deployment to an external environment
# 'php artisan serve' to run the php locally if on a local environment
For the profile upload reminder, you can simply create a crontab on your server to execute the command every three days. But if you are testing locally, run this artisan command
# php artisan profile:upload

Happy testing
