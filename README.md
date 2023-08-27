# Refmini CMS 

[![Code Review](https://github.com/AmolKumarGupta/Ref-Mini/actions/workflows/static_analysis.yml/badge.svg)](https://github.com/AmolKumarGupta/Ref-Mini/actions/workflows/static_analysis.yml)
![Phpstan level](https://img.shields.io/badge/PHPStan-level%205-brightgreen.svg?style=flat)

A Personal Website is a versatile platform that allows you to manage your data. It comes equipped with a habit tracker tool to help me stay on top of my daily goals and routines. It allows you to showcase your repositories on your website 

1. Single User
2. Github Integration
3. Can select repos for Showcase
4. Habit Tracker
5. Menu Management

### Requirements For Github (Optional)

Need Github token with read:user and gists scope. It will be saved in profile page under gist token.

### Installation

clone the repository from gitub
```
git clone https://github.com/AmolKumarGupta/Ref-Mini.git
```

install composer packages 

```
composer install
```

copy `.env.example` to `.env` and setup your database.
if APP_KEY is not preset then generate it
```
php artisan key:generate --ansi
```

Now run setup command, it will run migrations and seeds
```
php artisan refmini:install
```

## ScreenShot

<div align="center" style="display:flex; gap: 1rem;">
    <img src="https://github.com/AmolKumarGupta/Ref-Mini/assets/88397611/597900f7-bca3-440e-8a9b-8b4b0e5c012f" alt="daskboard" width="400">
    <img src="https://user-images.githubusercontent.com/88397611/223205122-9bc87b5a-6e72-43ae-aab4-a4a968f74bf1.png" alt="menu" width="400">
    <img src="https://github.com/AmolKumarGupta/Ref-Mini/assets/88397611/816c0138-fd5f-4f99-b257-4ee77d85dcf1" alt="repos" width="400">
</div>
