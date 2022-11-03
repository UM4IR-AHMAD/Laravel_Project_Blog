<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Project view and features

### Blog
<img src="https://user-images.githubusercontent.com/93633549/199653493-1a80fd9f-7868-425d-9e4e-ca7baf41dd61.png" alt="blog-managment" width="300"/>
Features

- Latest blog show in carousel/slider.
- Top post.
- Check posts list based on
    - categories.
    - Author/Writer.
- Search posts based on
    - Title
    - Author/Writer
    

### Blog Managment
<img src="https://user-images.githubusercontent.com/93633549/199653720-557c4994-35cb-4c9f-ae5b-0fa97ba3a477.png" alt="blog-managment" width="800"/>
Features

- Authentication.
- Authorization with three roles
    - Super Admin.
    - Admin.
    - Author.
- Login, trying limitation and remember me.
- Email verfication or link for
    - First login.
    - Email Address update.
    - Password update.
    - Forget Password.
- Profile update
- Dashboard tab for overall blog statistics.
- Posts CRUD and view 
    - Write posts with editor and check preview.
- Categories CRUD.
- Members CRUD.

## Set-up Project
 - clone the project.
 - open the project VScode and enter commands.
 - command: cp .env.example .env
 - open .env file
    - set the database details.
    - optional: set the mail details if you want to use email verification and password change. 
 - command: composer install.
 - command: php artisan key:generate
 - command: php artisan migrate:fresh --seed
 - command: php artisan serve
 
 ## Manage the blog
 url for blog: http://127.0.0.1:8000
 
 url for blog managment: http://127.0.0.1:8000/admin/login
 ### Credentials for login
  - Super Admin
    - username: jhon
    - password: 12345678
  - Admin
    - username: kate
    - password: 12345678  
  - Author
    - username: warran
    - password: 12345678

