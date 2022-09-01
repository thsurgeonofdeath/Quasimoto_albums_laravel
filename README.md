# About Project
Goal was to create a RateYourMusic clone, slightly less complicated

## Run the project locally

To run the project locally, follow the next steps :
- make sure you have wamp server or XAMPP installed
- Download composer https://getcomposer.org/download/ 
- Create a database locally named `quasimoto` utf8_general_ci
- Pull the project from git provider.
- Rename `.env.example` file to `.env` inside your project root and fill the database information. (windows wont let you do it, so you have to open your console cd your project root directory and run mv .env.example .env )
- create an account on mailtrap and fill the mailtrap informations on the `.env` file, use this video for help :  https://www.youtube.com/watch?v=yIoKD8HF5rU&t=1s
- Open the console and cd your project root directory
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate` to create the database tables and relationships
- Run `php artisan db:seed` to run the seeders, this will create the admin acoount and few dummy albums/user that you can delete later
- the credentials for the admin account : Email : `lordquas@mail.com`    /   Password : `123456`
- Run `php artisan serve`
- Open `http://127.0.0.1:8000/` on your browser, you can login as an admin and consult the other generated users and their emails in the dashboard
- all the generated users have `123456` as their password

**if for some reason the project stops working do these**
- `composer install`
- `php artisan migrate`

### Tasks done :
- Styling views with Tailwind
- Authentification system
- CRUD fonctionality for User module
- CRUD fonctionality for Album module
- Add album to favourites feature using Livewire
- User roles: Admin, Writer, User are functional
- User Email Confirmation Required
- Functional Admin User Dashboard
- Guaranteed admin to Block/Unblock or Delete User
- Added User Profile
- Added Tracklist
- easy access to edit albums for admin/writer
- Added user comments/review
- User can Edit / Delete his Review 
- Guaranteed admin to delete any reviews
- cropping pictures using ijaboCropTool plug
- Created a user profile page
- Implemented a star rating system using rateyo library
- Improved admin dashboard
- Functional Admin Inbox
- Albums submitted by writers need to be approved by the admin
- User can share albums to Twitter
- Improved Styling massively using Tailwind
....


### To Do List : 
+ add more informations to user?

--> few screenshots of the web application :


![image](https://user-images.githubusercontent.com/99540220/186942140-8cda8fbb-b824-4613-830b-3e1cf6dca7e0.png)


![image](https://user-images.githubusercontent.com/99540220/187471151-2081b115-9553-47e2-84f4-db1ef985fa86.png)


![image](https://user-images.githubusercontent.com/99540220/185798675-d66371c9-82e1-4796-8510-69fca66edbf2.png)


![image](https://user-images.githubusercontent.com/99540220/186158692-4ae0bf8f-cb0e-4e60-ad3d-c546270508dc.png)


![image](https://user-images.githubusercontent.com/99540220/187696819-a6667250-f1a9-4b43-b659-88fe49863ea8.png)


![image](https://user-images.githubusercontent.com/99540220/186442148-77383a50-64a0-4e0e-a0db-596b5660e6ab.png)


![image](https://user-images.githubusercontent.com/99540220/187696039-a8c0ad82-2b0e-4f41-ae95-0ee72bf90ec1.png)


![image](https://user-images.githubusercontent.com/99540220/187696093-eccc9eda-5f69-42da-ab66-038fda3461ba.png)


![image](https://user-images.githubusercontent.com/99540220/187696171-6e10757f-0990-41c2-94c4-f657d8d9f8a0.png)


![image](https://user-images.githubusercontent.com/99540220/187696287-74dd69aa-ef67-42d8-845b-4d6c87b27902.png)


![image](https://user-images.githubusercontent.com/99540220/187696593-09757373-f256-4e3b-b73b-f1642b693964.png)

