# Tech Blog Project

Our Tech blog is a simple blogging platform developed using Laravel. It allows users to create and manage blog posts, as well as add comments to the posts.

Authors: Dillon Reilly, Josef Zemlicka
Group: SD2b
Due date: 14/05/2023

## Features

- User registration and authentication system.
- Create, edit, and delete blog posts.
- Add comments to blog posts.
- View blog posts and comments.
- Responsive design for optimal viewing on different devices.

## Installation

1. Clone the repository:

   ```shell
   git clone https://github.com/almezj/ssdev-blog.git

This repository is linked to [this youtube video](https://www.youtube.com/watch?v=HKJDLXsTr8A&t=4710s) where I show you how to create a complete blog in Laravel 8 using best practices.

2. Navigate to the project directory:
    ```
    cd ssdev-blog
    ```
    
3. Install the dependencies using Composer:
    ```
    composer install
    ```
    
4. Copy the .env.example file to .env:
    ```
    cp .env.example .env
    ```
    
5. Generate an application key:
    ```
    php artisan key:generate
    ```
    
6. Configure the database connection in the .env file:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
 
7. Run the database migrations:
    ```
    php artisan migrate
    ```

8. Start the development server:
    ```
    php artisan serve
    ```
    
## Usage
- Register a new user account or log in with an existing account.
- Create new blog posts by clicking on the "New Post" button.
- View all blog posts on the homepage and click on a post to see its details.
- Add comments to blog posts by filling out the comment form and submitting it.
- Like comments by pressing the like button next to each comment
- Edit or delete your own blog posts by clicking on the respective buttons on the post page.
- Add a post to your favorite posts list by clicking on the yellow star on the post page.


## Contributing
•	Forked template from: [Code With Dary ](https://github.com/codewithdary/laravel-8-complete-blog)
