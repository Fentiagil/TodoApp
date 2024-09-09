## Installation
- Clone the repository
- Run `composer install`
- import file database ke postgreql
- Set up the `.env` file (pastikan nama databasenya sama)
- Run `php artisan migrate --seed`
- Run unit test `php artisan test`
- Serve the application with `php artisan serve`

### Unit test
1. test_create_task: Menguji apakah task berhasil dibuat dengan data yang valid.
2. test_update_task: Menguji apakah task berhasil di-update.
3. test_delete_task: Menguji apakah task berhasil dihapus.
4. test_read_tasks: Menguji apakah list task dapat ditampilkan.

### Dokumentasi API
