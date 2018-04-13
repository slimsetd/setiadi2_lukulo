# Recaptcha V2

Pada pembaharuan pertanggal 13 April 2018, pengembangan Setiadi telah menyisipkan fitur **Recaptcha vers 2**. Fitur ini berfungsi untuk melindungi Setiadi anda dari *spammer*   yang berusaha untuk masuk kedalam sistem anda secara terus-menerus yang akan berdampak pada kinerja peladen anda.

Untuk menggunakan fitur ini anda perlu menyisipkan kunci *API* yang bisa anda dapat kan dari pranala berikut [https://www.google.com/recaptcha](https://www.google.com/recaptcha) dengan prasyarat bahwa anda telah memiliki akun surel gmail untuk proses *logIn*. 

Namun, untuk pengguna yang beraktifitas menggunakan pelanden lokal sepeti *localhost* anda tidak perlu mendapatkan kunci *API*. Pengembang Setiadi sudah menyertakan kunci *API* yang dapat digunakan secara lokal saja.

Untuk pengguna yang menjalankan Setiadi secara daring, anda perlu memperbaharui kunci *API* anda pada pranala diatas.

Langkah-langkah mendapatkan kunci *API* dari google :

1. Kunjungi laman berikut [https://www.google.com/recaptcha](https://www.google.com/recaptcha)
2. Pada pojok kanan atas tekan tombol *Get reCAPTCHA*
3. Setelah itu anda diminta untuk memasukan akun surel gmail anda.
4. Pada bagian *Register a new site* terdapat sub bagian yang tertulis Label dan dibawahnya terdapat kotak teks, maka isikan nama label dari *API*
yang akan anda gunakan.
5. Setelah itu centang pada bagian yang tertulis reCAPTCHA v2.
6. Setelah itu muncul bagian yang tertulis *Domains*.
7. Terdapat kotak teks, isikan nama domain atau IP yang anda gunakan untuk menjalankan Setiadi anda. Jadi, reCaptcha ini dapat digunakan pada jaringan lokal ditempat anda, apabila peladen anda tidak dapat dipanggil secara daring dari luar jaringan lokal namun hanya bisa melalui jaringan lokal dan terkoneksi internet anda dapat menyertakan IP dari peladen lokal anda.
8. Lalu tekan kotak yang disebelahnya terdapat teks *Accept the re...*.
9. Lalu klik register.
10. Setelah itu akan muncul beberapa daftar, sorot pada bagian yang bertulis **Keys**
11. Salin tempel **Site Key** dan **Secret Key** pada modul sistem
sistem > pengaturan sistem > Recaptcha API Key , tekan tombol bergambar kunci.
12. Sisipkan **Site Key** pada kotak teks di bawah **PublicKey**
13. Sisipkan **Secret Key** pada kotak teks di bawah **PrivateKey**
14. Klik simpan, lalu ubah pengaturan Recaptcha Admin menjadi **Dimungkinkan** untuk mengaktifkan fitur ini pada halaman masuk Admin.
15. Klik simpan, lalu ubah pengaturan Recaptcha Member menjadi **Dimungkinkan** untuk mengaktifkan fitur ini pada halaman masuk Member.
