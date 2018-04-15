## Makna pesan galat (*error*)

"**Error Connecting to Database, Please check your configuration!**"

Pesan galat diatas berikut memiliki arti bahwa ada kesalahan data yang anda masukan pada form isian *Database Connection Information* seperti isian *Database Hostname, Database Name, Database Username, dan Database Password*. Untuk mengatasinya pastikan isi-isian yang dimasukan sudah benar.

"**AJAX Reload Error! Make sure your installer isn't corrupted. checkDep.php file isn't exist or missing.**"

Pesan galat diatas berikut memiliki arti bahwa terdapat file-file yang bermasalah, baik file tersebut hilang, terdapat kode yang salah pada file tersebut atau peladen mengalami gangguan. Untuk mengatasinya pastikan isi dari folder install tidak ada yang kurang dengan cara membandingkan dengan folder yang ada di repositori github kami.

"**Folder db_config isn't writeable! please make sure it writeable or not.**"

Pesan galat diatas berikut memiliki arti bahwa, folder db_config pada folder Setiadi anda tidak dapat ditulis oleh php, hal ini sering terjadi pada sistem operasi GNU/Linux untuk pengguna Windows dan pengguna CPanel belum ada laporan galat yang terjadi ketika proses pemasangan berlangsung. Untuk mengatasinya anda bisa mengikuti langkah-langkah berikut:

**Pengguna GNU/Linux**

1. Pastikan folder setiadi anda dimiliki oleh user www-data atau apache, 
2. jika anda menggunakan sistem operasi berbasis Debian GNU/Linux seperti Ubuntu dan turunannya dengan menggunakan perintah **sudo chown www-data -R folder_setiadi** 
3. untuk Fedora, RHEL(*Red Hat Enterprise Linux*) dan turunannya seperti CentOS menggunakan perintah **sudo chown apache -R folder_setiadi**