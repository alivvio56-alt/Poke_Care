Nama : Ardhis Alivio Rajendra
NIM  : H1H024031
SHIFT AWAL/ SHIFT AKHIR : A/A

PokéCare adalah sistem simulasi web untuk melatih Pokémon Growlithe di PRTC, 
dibangun dengan PHP native tanpa framework. Sistem ini menerapkan empat pilar OOP 
Encapsulation: properti protected dengan getter/setter.
Inheritance: abstract class Pokemon sebagai parent, Growlithe sebagai subclass.
Polymorphism: method specialMove() dan train() dioverride untuk jurus Flamethrower dan peningkatan level/HP khas tipe Api.
Abstraction: method abstract diimplementasikan pada subclass

Aplikasi terdiri dari halaman beranda (info Pokémon + logo), halaman latihan (form kiri,
hasil kanan dengan GIF Growlithe), dan riwayat latihan.

Cara jalankan aplikasi :
Buat folder /var/www/html/pokecare, lalu salin semua file aplikasi ke dalamnya 
(folder classes/, index.php, train.php, history.php). Setelah itu atur izin akses dengan:
sudo chown -R www-data:www-data /var/www/html/pokecare.
Buka aplikasi melalui browser di:
http://localhost/pokecare/index.php.

video simulasi penggunaan aplikasi :
![Screencast from 11-29-2025 09_47_25 AM](https://github.com/user-attachments/assets/2f78540c-6842-4caa-9704-1fa257fda432)
