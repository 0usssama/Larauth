
# Larauth

A boilerplate of Laravel API authentification using Laravel Passport



## Installation 

1. clone the project with

```bash 
 git clone https://github.com/benounnas/Larauth.git
 cd Larauth
```
2. Run ```bash composer install ```
3. edit your `.env` with the proper database credentials 
4. Install Laravel Passport with ```bash php artisan passport:install ```
5. Migrate your database with ```bash php artisan migrate```
6. Generate your laravel application key with ```bash php artisan key:generate```

Voila !

## API Reference



| Method | Name     | Route                |
| :-------- | :------- | :------------------------- |
| `POST` | `login` | /login |
| `POST` | `register` | /register |
| `POST` | `forgot` | /forgot |
| `POST` | `reset` | /reset |
