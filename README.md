# 🌍 WaspadaLokal

## 📺 Video Demo Aplikasi
[![WaspadaLokal Demo](https://img.shields.io/badge/Google%20Drive-Watch%20Demo-blue?style=for-the-badge&logo=googledrive)](https://drive.google.com/file/d/1fjsHZowOnAmU-eP6VHkyoUMOvyPR_4He/view?usp=sharing)

> **"Small Apps for Big Preparedness: Solusi Digital Berbasis AI untuk Kesiapsiagaan Bencana"**

WaspadaLokal adalah aplikasi web kesiapsiagaan bencana real-time yang cerdas. Dengan menggabungkan kekuatan teknologi web modern dan *Deep Learning*, aplikasi ini memberikan penilaian risiko lokal dan informasi penyelamatan jiwa langsung ke layar Anda. Proyek ini berdiri sebagai solusi digital yang inovatif dan sadar konteks, menjembatani AI tingkat lanjut dengan ketahanan masyarakat.

---

## ⚡ Fitur Utama

*   🎯 **Deteksi Risiko AI Real-time:** Menggunakan geolokasi pengguna untuk mengambil data meteorologi *real-time* (via OpenWeather) dan memprediksi status risiko saat ini (Aman, Waspada, Bahaya).
*   🗺️ **Peta Bencana Nasional Interaktif:** Peta Leaflet.js dinamis yang memberikan pandangan menyeluruh tentang status bencana dengan penanda denyut (pulse) status yang beranimasi.
*   📡 **Integrasi Peringatan Dini BMKG:** Mengambil data feeds XML/RSS resmi dari BMKG (Badan Meteorologi, Klimatologi, dan Geofisika) secara langsung untuk menampilkan peringatan cuaca yang terverifikasi dan terbaru.
*   📈 **Grafik Prakiraan Cuaca 24 Jam Dinamis:** Tren cuaca yang divisualisasikan menggunakan Chart.js untuk membantu pengguna mengantisipasi perubahan kondisi.
*   🛡️ **Panduan Keselamatan Berdasarkan Konteks:** Protokol keselamatan yang dapat ditindaklanjuti dan spesifik sesuai dengan situasi, didikte oleh tingkat risiko yang dinilai oleh AI.

> ⚠️ **PENTING:** *Aplikasi ini beroperasi menggunakan **data REAL-TIME** yang bersumber langsung dari OpenWeather dan feeds resmi BMKG. Kami tidak menggunakan data dummy atau data tiruan untuk prediksi risiko aktif.*

---

## 🛠️ Tech Stack

### Aplikasi Web (Frontend & Backend)
*   **Backend:** [Laravel 12](https://laravel.com/) (PHP Framework)
*   **Frontend:** [Tailwind CSS](https://tailwindcss.com/) untuk UI yang modern dan responsif
*   **Peta & Visual:** [Leaflet.js](https://leafletjs.com/) & [Chart.js](https://www.chartjs.org/)

### Microservice Artificial Intelligence
*   **API Layer:** [FastAPI](https://fastapi.tiangolo.com/) (Python)
*   **Model Deep Learning:** Keras / TensorFlow
    *   *Data Pelatihan:* Dilatih menggunakan data cuaca historis Jakarta selama 5 tahun (43.824 baris).
    *   *Input:* Suhu (Temperature), Kelembapan (Humidity), dan Curah Hujan (Rainfall).
    *   *Output:* Klasifikasi Risiko (Aman, Waspada, Bahaya).

---

## 🧠 Cara Kerja: Jembatan Laravel dan FastAPI

WaspadaLokal menggunakan arsitektur *microservice* untuk memisahkan logika aplikasi web dari komputasi *machine learning* yang berat:

1.  **Permintaan Pengguna:** Pengguna memberikan izin akses geolokasi di frontend Laravel.
2.  **Pengambilan Data Eksternal:** Laravel mengambil metrik cuaca real-time (Suhu, Kelembapan, Curah Hujan) untuk koordinat spesifik tersebut dari API OpenWeather.
3.  **Jembatan ke AI:** Laravel mengirimkan metrik saat ini melalui permintaan HTTP POST yang aman ke **microservice FastAPI** Python.
4.  **Inferensi AI:** Layanan FastAPI memasukkan data ke dalam model Deep Learning TensorFlow yang telah dilatih sebelumnya. Model menghitung probabilitas risiko dan mengembalikan respons klasifikasi terstandarisasi.
5.  **Penyampaian ke Pengguna:** Laravel menerima prediksi dari AI dan merender UI dashboard yang sesuai—lengkap dengan grafik cuaca dan panduan keselamatan spesifik konteks.

---

## 🚀 Instalasi & Menjalankan Secara Lokal

Untuk menjalankan WaspadaLokal secara lokal, Anda perlu menjalankan aplikasi web Laravel dan microservice FastAPI.

### Prasyarat
*   PHP 8.2+ & Composer
*   Python 3.9+ & pip
*   Node.js & npm
*   API Key OpenWeather (Atur di `.env` Laravel)

### 1. Backend & Web (Laravel)
```bash
# Clone repositori dan masuk ke direktori web
cd waspadalokal-web

# Install dependensi PHP dan Node
composer install
npm install

# Setup environment variables
cp .env.example .env
php artisan key:generate

# Build aset frontend dan jalankan server Laravel
npm run build
php artisan serve
```

### 2. Microservice AI (FastAPI)
```bash
# Masuk ke direktori layanan AI (sesuaikan path jika perlu)
cd ../waspadalokal-ai

# Buat virtual environment dan aktifkan
python -m venv venv
source venv/bin/activate  # Untuk Windows gunakan: venv\Scripts\activate

# Install dependensi Python
pip install -r requirements.txt

# Jalankan server FastAPI (default di port 8000)
uvicorn main:app --reload
```
*Catatan: Pastikan `.env` Laravel Anda mengarahkan URL layanan AI ke instance FastAPI yang sedang berjalan (contoh: `AI_API_URL=http://localhost:8000/predict`).*

---

## � Panduan Penggunaan (Untuk Evaluasi Juri)

Setelah kedua *server* (Laravel backend dan FastAPI) berjalan, ikuti langkah-langkah berikut untuk menguji keseluruhan fitur aplikasi:

1. **Akses Aplikasi:** Buka *browser* dan pergi ke alamat lokal Laravel Anda (umumnya `http://127.0.0.1:8000` jika menggunakan `php artisan serve`).
2. **Izinkan Lokasi (Geolokasi):** Saat pertama kali diakses, *browser* akan meminta izin lokasi. **Wajib klik "Allow" (Izinkan)** agar sistem mengambil koordinat lokasi Juri dan mengirimkannya ke AI API untuk prediksi risiko *real-time*.
3. **Eksplorasi Dashboard (Beranda):**
   - **Kartu Status: AI akan** menampilkan hasil komputasi *Deep Learning* mengenai probabilitas status bencana di lokasi Anda saat ini (Aman/Waspada/Bahaya).
   - **Grafik Cuaca:** Gulir ke bawah untuk melihat visualisasi Tren Cuaca 24 Jam (Suhu, Kelembapan, dan Hujan).
   - **Panduan Cerdas:** Perhatikan *Safety Guidelines* yang akan berubah otomatis sesuai dengan teks status yang dikeluarkan model AI.
4. **Peta Bencana Nasional:** Akses navigasi Peta untuk melihat sebaran informasi geospasial dengan animasi pin berdenyut (*pulse marker*).
5. **Peringatan Dini BMKG:** Masuk ke menu "Peringatan" untuk melihat daftar peringatan bahaya resmi (seperti waspada level Oranye) yang digeneralisasi langsung dari *feed* peringatan Dini XML BMKG tanpa manipulasi data. 

---

## �💡 Nilai Bisnis & Dampak

Sejalan dengan kriteria tantangan Dicoding, WaspadaLokal membawa nilai yang substansial:

*   🚀 **Inovasi:** Bergerak melampaui aplikasi cuaca statis dengan menggunakan model *Deep Learning* yang secara khusus dilatih dengan dataset lokal yang masif (data historis Jakarta) untuk memberikan wawasan yang terlokalisasi dan prediktif, bukan sekadar pelaporan reaktif.
*   ✨ **Kebaruan:** Mengintegrasikan beberapa aliran data *real-time* (Geolokasi, OpenWeather, XML BMKG) ke dalam satu UI yang mulus dan tidak mengganggu (*non-intrusive*). Arsitektur Laravel/FastAPI yang terpisah (*decoupled*) menunjukkan rekayasa tingkat *enterprise* yang skalabel.
*   🤝 **Manfaat bagi Masyarakat:** Mengubah data meteorologi dan prediksi ML yang kompleks menjadi status risiko yang mudah dipahami (Aman, Waspada, Bahaya) serta panduan keselamatan yang dapat ditindaklanjuti, secara langsung memberdayakan masyarakat untuk membuat keputusan yang terinformasi dan menyelamatkan jiwa.

---

## 📄 Lisensi

Proyek ini adalah perangkat lunak *open-source* yang dilisensikan di bawah [MIT License](LICENSE).

---

*Dibuat dengan ❤️ untuk Indonesia yang lebih aman dan tangguh.*
