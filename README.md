# Laravel Instagram Clone

This Laravel Instagram Clone is a full-fledged social media platform that replicates the core functionality of Instagram, allowing users to register, create profiles, share posts, follow other users, like and comment on posts, and more. Built using Laravel, a powerful PHP framework, this project offers a robust foundation for building scalable and feature-rich social networking applications.

## Demo Video
[![Demo video](https://img.youtube.com/vi/3LgxKmz5_GE/0.jpg)](https://www.youtube.com/watch?v=3LgxKmz5_GE)

## Features

### User Management
- **Signup and Login:** Users can register with their email, username, and password, and log in securely to access their accounts.
- **Password Management:** Forgot password functionality enables users to reset their passwords via email.
- **Email Verification:** A verification email is sent to new users for email confirmation.

### Profile Management
- **Edit Profile:** Users can update their profile information including name, avatar, bio, gender, and website.
- **Change Password:** Users can change their passwords securely.
- **Profile View Page:** Detailed view of user profiles including followers, following, and posts.
- **Follow/Unfollow:** Users can follow and unfollow other profiles.

### Posts Management
- **Create Posts:** Users can upload images or videos with captions and hashtags.
- **Post View Page:** Detailed view of individual posts with likes, comments, and tags.
- **Like and Comment:** Users can interact with posts by liking and commenting on them.
- **Save Posts:** Users can save posts for later viewing.

### Home Page
- **Feed:** Users can see the latest posts from profiles they follow, with the ability to like and comment.
- **Search:** Users can search for profiles using name or username.

### Tags Page
- **Tagged Posts:** Users can view posts related to a specific tag.

## Installation

To set up the Laravel Instagram Clone locally, follow these steps:

1. Clone the repository: `git clone https://github.com/your_username/instagram-clone.git`
2. Install dependencies: `composer install`
3. Create a copy of the `.env.example` file and rename it to `.env`.
4. Generate application key: `php artisan key:generate`
5. Set up your database in the `.env` file.
6. Migrate the database: `php artisan migrate`
7. Start the local development server: `php artisan serve`

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
