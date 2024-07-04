Git

1. git clone link github
2. git init,
3. git add nama_file/*,
4. git commit -m "percobaan" (untuk comment/deskripsi),
5. git push -u origin (untuk dorong file dari directory lokal laptop ke repository github),
6. git pull origin main (untuk ambil dari repo github ke directory lokal).

cara menjalankan aplikasi:

1. buka folder panasonic/projek 
2. setelah itu 'composer install'/'composer update' di command prompt directory project-app
3. env.example copas dan jadikan .env
4. 'php artisan key:generate' di command prompt directory project-app
5. 'php artisan storage:link' di command prompt directory project-app (buat kode ini dilakukan saat gambar tidak muncul atau ganti foto pertama dan tidak muncul fotonya)
6. 'php artisan migrate' di command prompt directory project-app
7. hidupkan apache dan mysql
8. 'php artisan serve' di command prompt directory project-app
9. jalankan link php yang telah muncul pada terminal.
