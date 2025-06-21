<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->

# Simple Todo List Application - Laravel

Aplikasi Todo List sederhana yang dibuat dengan Laravel dan MySQL untuk memenuhi requirements take home test PT Bejana Investidata Globalindo (BIGIO).

## Fitur

✅ **Registrasi** - Username & Password  
✅ **Login & Logout** - Session-based authentication  
✅ **Tambah Tugas** - Menambah todo baru  
✅ **Hapus Tugas** - Menghapus todo  
✅ **Tandai Tugas** - Mark as completed/uncompleted  
✅ **User Isolation** - Setiap user hanya bisa melihat todo miliknya sendiri  

## Teknologi yang Digunakan

- **Backend**: Laravel 12.0 (PHP 8.2)
- **Frontend**: Blade Templates + Tailwind CSS + Font Awesome
- **Database**: MySQL
- **Authentication**: Session

## Cara Instalasi

### Prerequisites
- PHP 8.2 
- Composer
- MySQL
- Git

### Langkah-langkah Instalasi

1. **Clone repository**
```bash
git clone <repository-url>
cd todo-app-laravel
```

2. **Install dependencies**
```bash
composer install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database di file .env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simple_todolist
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. **Buat database MySQL**
```sql
CREATE DATABASE simple_todolist;
```

6. **Jalankan migrasi**
```bash
php artisan migrate
```

7. **Jalankan server**
```bash
php artisan serve
```

8. **Akses aplikasi**
Buka browser dan kunjungi: `http://localhost:8000`

## Struktur Database

### Tabel Users
- `id` (Primary Key)
- `username` (Unique)
- `password` (Hashed)
- `created_at`
- `updated_at`

### Tabel Todos
- `id` (Primary Key)
- `user_id` (Foreign Key ke users.id)
- `title`
- `completed` (Boolean)
- `created_at`
- `updated_at`

## API Endpoints

Aplikasi ini menggunakan web routes, bukan API routes:

- `GET /` - Halaman login
- `GET /register` - Halaman registrasi
- `POST /login` - Proses login
- `POST /register` - Proses registrasi
- `POST /logout` - Logout
- `GET /dashboard` - Dashboard todo (protected)
- `POST /todos` - Tambah todo (protected)
- `PUT /todos/{id}` - Update todo status (protected)
- `DELETE /todos/{id}` - Hapus todo (protected)

## Cara Penggunaan

1. **Registrasi**: Buat akun baru dengan username dan password
2. **Login**: Masuk dengan kredensial yang sudah dibuat
3. **Tambah Todo**: Gunakan form di bagian atas dashboard
4. **Mark Complete**: Klik checkbox di sebelah kiri todo
5. **Hapus Todo**: Klik tombol trash di sebelah kanan todo
6. **Logout**: Klik tombol logout di header

## Fitur Keamanan

- Password di-hash menggunakan bcrypt
- Session-based authentication
- CSRF protection pada semua form
- User isolation (setiap user hanya bisa akses todo miliknya)
- Input validation dan sanitization

<!-- ## Screenshots

### Halaman Login
- Design yang clean dan modern
- Form validation
- Responsive design

### Halaman Registrasi
- Simple form dengan username dan password
- Error handling

### Dashboard
- Statistics cards (Total, Completed, Pending)
- Add todo form
- Todo list dengan checkbox dan delete button
- User-friendly interface -->

## Testing

Untuk testing, Anda bisa:

1. **Manual Testing**:
   - Registrasi user baru
   - Login/logout
   - CRUD operations pada todos
   - Test user isolation (buat 2 user, pastikan tidak bisa lihat todo user lain)

2. **Browser Testing**:
   - Test di berbagai browser
   - Test responsive design

<!-- ## Deployment

Untuk deployment ke production:

1. Set `APP_ENV=production` di .env
2. Set `APP_DEBUG=false`
3. Generate app key yang baru
4. Setup database production
5. Jalankan `php artisan config:cache`
6. Setup web server (Apache/Nginx)

## Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: Database connection
- Pastikan MySQL service berjalan
- Check konfigurasi database di .env
- Pastikan database sudah dibuat

### Error: Permission denied
```bash
chmod -R 775 storage bootstrap/cache
``` -->

## Author

**Kurniawan Alexander**  
Take Home Test - PT Bejana Investidata Globalindo (BIGIO)
