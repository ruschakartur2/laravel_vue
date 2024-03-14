# Test task


### Installation

```bash
# Clone project from github
git clone 
# Create the Laravel application...
laravel new vue-backend

cd vue-backend

# Install Breeze and dependencies...
composer require laravel/breeze

php artisan breeze:install api
```

Next, ensure that your application's `APP_URL` and `FRONTEND_URL` environment variables are set to `http://localhost:8000` and `http://localhost:3000`, respectively.

After defining the appropriate environment variables, you may serve the Laravel application using the `serve` Artisan command:

```bash
# Serve the application...
php artisan serve
```

Next, clone this repository and install its dependencies with `yarn install` or `npm install`. Then, copy the `.env.example` file to `.env` and supply the URL of your backend:

```
VITE_APP_NAME=Breeze Vue.js 3 Api
VITE_PUBLIC_BACKEND_URL=http://localhost:8000
```

Finally, run the application via `npm run dev`. The application will be available at `http://localhost:3000`:

```
npm run dev
```

> Note: Currently, we recommend using `localhost` during local development of your backend and frontend to avoid CORS "Same-Origin" issues.

## License

Laravel Breeze - Vue.js 3 Edition is open-sourced software licensed under the [MIT license](LICENSE.md).