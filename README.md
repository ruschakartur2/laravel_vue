# Test task


### Installation

```bash
# Clone project from github
git clone https://github.com/ruschakartur2/laravel_vue_testtask
```

Next, ensure that your application's `APP_URL` and `FRONTEND_URL` environment variables are set to `http://localhost:8000` and `http://localhost:3000`, respectively.

After defining the appropriate environment variables, you may serve the Laravel application using the `serve` Artisan command:

```bash
# Go to backend folder
cd backend

# Install composer dependencies
composer install

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Run seeder
php artisan db:seed

# Serve the application...
php artisan serve

```

Next, install frontend dependencies with `yarn install` or `npm install` in root folder. Then, copy the `.env.example` file to `.env` and supply the URL of your backend:

```
VITE_APP_NAME=TestTask
VITE_PUBLIC_BACKEND_URL=http://localhost:8000
```

Finally, run the application via `npm run dev`. The application will be available at `http://localhost:3000`:

```
npm run dev
```
