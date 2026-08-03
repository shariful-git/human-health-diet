# 🥗 Human Health & Diet

A modern, full-featured web application for tracking nutrition, daily meals, fitness activities, hydration, and diet plans. Built with **Laravel 13**, **Filament v5**, **Tailwind CSS**, and **Alpine.js**.

---

## 🌟 Features

- 📊 **Interactive Dashboard**: Monitor daily caloric & macronutrient progress, hydration levels, active streaks, and earned reward points.
- 🥗 **Meal & Nutrition Tracking**: Log daily meals from a comprehensive food database or custom entries with real-time calorie and macro (protein, carbs, fat) calculations.
- 🏋️ **Fitness & Hydration Tracker**: Log workout sessions, duration, and calories burned alongside daily water intake.
- 📅 **Custom Diet & Workout Plans**: Browse preset diet plans or create personalized multi-day meal plans with custom food assignments and enrollment tracking.
- ✅ **Daily Checklist & Rewards**: Stay consistent with a daily completion checklist, streak counters, and reward points to keep users motivated.
- 📈 **Analytics & Health Reports**: Generate health progress reports with seamless **CSV** and **PDF** export options.
- ⚙️ **Filament Admin Panel**: Powerful administrative backend to manage food databases, exercise catalogs, users, and global diet plans.
- 🔐 **Authentication & User Management**: Secure registration, email verification, and customizable user profile settings powered by Laravel Breeze.

---

## 🛠️ Tech Stack

| Layer | Technology |
| :--- | :--- |
| **Backend Framework** | [Laravel 13](https://laravel.com) (PHP 8.3+) |
| **Admin Panel** | [Filament v5](https://filamentphp.com) |
| **Authentication** | [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) |
| **Frontend Framework** | Blade templates, [Alpine.js](https://alpinejs.dev) |
| **Styling & Assets** | [Tailwind CSS](https://tailwindcss.com), [Vite](https://vitejs.dev) |
| **Database** | MySQL / PostgreSQL / SQLite |
| **Testing & Quality** | PHPUnit, Laravel Pint |

---

## 🚀 Getting Started

### Prerequisites

Ensure your environment meets the following requirements:
- **PHP** `>= 8.3` with required extensions (`mbstring`, `pdo`, `openssl`, `tokenizer`, `xml`, `cURL`)
- **Composer** `>= 2.x`
- **Node.js** `>= 18.x` & **npm**
- **Database**: MySQL, PostgreSQL, or SQLite

---

### Installation Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/shariful-git/human-health-diet.git
   cd human-health-diet
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node dependencies**:
   ```bash
   npm install
   ```

4. **Configure Environment File**:
   Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```
   Generate the application encryption key:
   ```bash
   php artisan key:generate
   ```

5. **Configure Database & Run Migrations**:
   Update your database credentials in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=human_health_diet
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Execute database migrations along with initial seeders (seeds exercise and food catalog data):
   ```bash
   php artisan migrate --seed
   ```

6. **Create an Admin User (Optional for Filament Panel)**:
   ```bash
   php artisan make:filament-user
   ```

---

## 💻 Development & Execution

Run the complete local development environment (Laravel server, Vite asset builder, queue worker, and log listener concurrently):

```bash
composer run dev
```

Alternatively, you can run services individually:

- **Laravel Dev Server**: `php artisan serve`
- **Vite Hot-Reload**: `npm run dev`
- **Queue Listener**: `php artisan queue:listen`
- **Laravel Pail Logs**: `php artisan pail`

### Application URLs

- **User Web Application**: [http://localhost:8000](http://localhost:8000)
- **Filament Admin Panel**: [http://localhost:8000/admin](http://localhost:8000/admin)

---

## 🧪 Testing & Code Quality

Run tests using PHPUnit:
```bash
composer test
```
*or*
```bash
php artisan test
```

Format code using Laravel Pint:
```bash
./vendor/bin/pint
```

---

## 📁 Key Project Structure

```text
human-health-diet/
├── app/
│   ├── Filament/        # Filament admin panel resources, pages, and widgets
│   ├── Http/
│   │   └── Controllers/ # Application controllers (Meals, Fitness, Plans, Reports, etc.)
│   ├── Models/          # Eloquent models (User, Profile, Food, MealLog, Exercise, Plan, etc.)
│   └── Services/        # Business logic services
├── database/
│   ├── migrations/      # Database table schema definitions
│   └── seeders/         # Food & Exercise default data seeders
├── resources/
│   ├── views/           # Blade templates and dashboard layouts
│   └── css/             # Tailwind CSS styles
├── routes/
│   ├── web.php          # Web routes & authentication endpoints
│   └── auth.php         # Breeze authentication routes
└── tests/               # Feature and Unit test suites
```

---

## 📄 License

This application is open-source software licensed under the [MIT License](LICENSE).
