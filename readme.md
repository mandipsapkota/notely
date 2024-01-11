# NOTELY

## Whats Notely
This is a simple note keeping webapp that is made using html, css, php and mySQL . Its features are :

### Login and signup system
It has a login , signup and logout system that properly functions .

### User Restriction
Only logged in users are allowed on dashboard .

### Password Hashing
Passwords are hashed and safe .

## Important stuff !!
Three sql tables are used in this project , names are not exact but the structure is specified here . :

### Users Table
It contains users info.

### Note table
It contains notes and is connected to users table with a foreign key. ON DELETE CASCADE is used to create parent child relationship betweer users and note table .

### Contact table
Stores info on submitting contact form .
