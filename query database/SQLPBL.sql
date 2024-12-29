CREATE DATABASE PBLDB;


CREATE TABLE users (
    id INT PRIMARY KEY IDENTITY(1,1),
    NIM VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'mahasiswa'
);

-- Membuat tabel laporan_pelanggaran
CREATE TABLE laporan_pelanggaran (
    id INT PRIMARY KEY IDENTITY(1,1), -- Auto Increment
    name NVARCHAR(255) NOT NULL, -- Nama pelanggar
    date DATE NOT NULL, -- Tanggal pelanggaran
    description NVARCHAR(MAX) NOT NULL, -- Deskripsi pelanggaran
    proof NVARCHAR(255) NOT NULL, -- Bukti pelanggaran
    status VARCHAR(20) DEFAULT 'pending' -- Status pelanggaran
);

-- Membuat tabel Sanksi
CREATE TABLE Sanksi (
    ID INT PRIMARY KEY IDENTITY(1,1), -- Auto Increment
    TingkatPelanggaran NVARCHAR(50) NULL, -- Tingkat pelanggaran
    Deskripsi NVARCHAR(MAX) NULL, -- Deskripsi sanksi
    AkumulasiSanksi NVARCHAR(MAX) NULL -- Akumulasi sanksi
);

-- Tabel dbo.TataTertib
CREATE TABLE TataTertib (
    id INT NOT NULL PRIMARY KEY,
    deskripsi_pelanggaran NVARCHAR(255) NULL,
    tingkat_pelanggaran NVARCHAR(50) NULL
);



INSERT INTO Sanksi (TingkatPelanggaran, Deskripsi, AkumulasiSanksi)
VALUES
-- Tingkat V
('Tingkat V', 
 'Teguran lisan disertai dengan surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa yang bersangkutan dan DPA.', 
 'Apabila dilakukan 3 kali, klasifikasi pelanggaran ditingkatkan menjadi Tingkat IV.'),

-- Tingkat IV
('Tingkat IV', 
 'Teguran tertulis disertai dengan surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa yang bersangkutan dan DPA.', 
 'Apabila dilakukan 3 kali, klasifikasi pelanggaran ditingkatkan menjadi Tingkat III.'),

-- Tingkat III
('Tingkat III', 
 'a. Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa yang bersangkutan dan DPA.' + 
 CHAR(13) + 'b. Melakukan tugas khusus, misalnya bertanggung jawab untuk memperbaiki atau membersihkan kembali, dan tugas-tugas lainnya.', 
 'Apabila dilakukan 3 kali, klasifikasi pelanggaran ditingkatkan menjadi Tingkat II.'),

-- Tingkat II
('Tingkat II', 
 'a. Dikenakan penggantian kerugian atau penggantian benda/barang semacamnya dan/atau;' + 
 CHAR(13) + 'b. Melakukan tugas layanan sosial dalam jangka waktu tertentu dan/atau;' + 
 CHAR(13) + 'c. Diberikan nilai D pada mata kuliah terkait saat melakukan pelanggaran.', 
 'Apabila dilakukan 3 kali, klasifikasi pelanggaran ditingkatkan menjadi Tingkat I.'),

-- Tingkat I
('Tingkat I', 
 'a. Dinonaktifkan (Cuti Akademik/Terminal) selama dua semester dan/atau;' + 
 CHAR(13) + 'b. Diberhentikan sebagai mahasiswa.', 
 'Sanksi tertinggi, tidak ada akumulasi lebih lanjut.');

 INSERT INTO TataTertib (deskripsi_pelanggaran, tingkat_pelanggaran) VALUES
('Berkomunikasi dengan tidak sopan, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, karyawan, atau orang lain', 'V'),
('Berbusana tidak sopan dan tidak rapi. Yaitu antara lain adalah: berpakaian ketat, transparan, memakai t-shirt (baju kaos tidak berkerah), tank top, hipster, you can see, rok mini, backless, celana pendek, celana tiga per empat, legging, model celana atau baju koyak, sandal, sepatu sandal di lingkungan kampus', 'IV'),
('Mahasiswa Laki-laki berambut tidak rapi, gondrong yaitu panjang rambutnya melewati batas alis mata di bagian depan, telinga di bagian samping atau menyentuh kerah baju di bagian leher', 'IV'),
('Mahasiswa berambut dengan model punk, dicat selain hitam dan/atau skinned', 'IV'),
('Makan, atau minum di dalam ruang kuliah, laboratorium, bengkel', 'IV'),
('Melanggar peraturan / ketentuan yang berlaku di Polinema baik di Jurusan / Program Studi', 'III'),
('Tidak menjaga kebersihan di seluruh area Polinema', 'III'),
('Membuat kegaduhan yang mengganggu pelaksanaan perkuliahan atau praktikum yang sedang berlangsung', 'III'),
('Merokok di luar area kawasan merokok', 'III'),
('Bermain kartu, game online di area kampus', 'III'),
('Mengotori atau mencoret-coret meja, kursi, tembok, dan lain-lain di lingkungan Polinema', 'III'),
('Bertingkah laku kasar atau tidak sopan kepada mahasiswa, dosen, dan atau karyawan', 'III'),
('Merusak sarana dan prasarana yang ada di area Polinema', 'II'),
('Tidak menjaga ketertiban dan keamanan di seluruh area Polinema (misalnya: parkir tidak pada tempatnya, konvoi selebrasi wisuda dll)', 'II'),
('Melakukan pengotoran / pengrusakan barang milik orang lain termasuk milik Politeknik Negeri Malang', 'II'),
('Mengakses materi pornografi di kelas atau area kampus', 'II'),
('Membawa dan atau menggunakan senjata tajam dan atau senjata api untuk hal kriminal', 'II'),
('Melakukan perkelahian, serta membentuk geng / kelompok yang bertujuan negatif', 'II'),
('Melakukan kegiatan politik praktis di dalam kampus', 'II'),
('Melakukan tindakan kekerasan atau perkelahian di dalam kampus', 'II'),
('Melakukan penyalahgunaan identitas untuk perbuatan negatif', 'II'),
('Mengancam, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, dan atau karyawan', 'II'),
('Mencuri dalam bentuk apapun', 'I/II'),
('Melakukan kecurangan dalam bidang akademik, administratif, dan keuangan', 'I/II'),
('Melakukan pemerasan dan atau penipuan', 'I/II'),
('Melakukan pelecehan dan atau tindakan asusila dalam segala bentuk di dalam dan di luar kampus', 'I/II'),
('Berjudi, mengkonsumsi minum-minuman keras, dan atau bermabuk-mabukan di lingkungan dan di luar lingkungan Kampus Polinema', 'I/II'),
('Mengikuti organisasi dan atau menyebarkan faham-faham yang dilarang oleh Pemerintah', 'I/II'),
('Melakukan pemalsuan data / dokumen / tanda tangan', 'I/II'),
('Melakukan plagiasi (copy paste) dalam tugas-tugas atau karya ilmiah', 'I/II'),
('Tidak menjaga nama baik Polinema di masyarakat dan atau mencemarkan nama baik Polinema melalui media apapun', 'I'),
('Melakukan kegiatan atau sejenisnya yang dapat menurunkan kehormatan atau martabat Negara, Bangsa dan Polinema', 'I'),
('Menggunakan barang-barang psikotropika dan atau zat-zat Adiktif lainnya', 'I'),
('Mengedarkan serta menjual barang-barang psikotropika dan atau zat-zat Adiktif lainnya', 'I'),
('Terlibat dalam tindakan kriminal dan dinyatakan bersalah oleh Pengadilan', 'I');




CREATE TABLE users (
    id INT PRIMARY KEY IDENTITY(1,1),
    NIM VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'mahasiswa'
);

ALTER TABLE users ADD nama VARCHAR(50) NOT NULL;

INSERT INTO users (NIM, nama, password, role)
VALUES
 ('2341760000', 'Mahasiswa', '$2y$10$cn.fzOgcYK2.jPkOszEe4.BgZuUzr89dbn744fX9CRJXj370bZMmq', 'mahasiswa'),
 ('1234567890', 'Admin', '$2y$10$vP.LeOOTbAfjKTxOxFeBIegH1FC3rD1n.POCriHC4WA.zDjuEvz.S', 'admin'),
 ('0987654321', 'Dosen', '$2y$10$A2Kzr27si.MxnkHJ727mx.0Cdz76GF6vABZJj0cwlrx1rW0Y8d9.y', 'dosen');

 ALTER TABLE laporan_pelanggaran ADD NIM VARCHAR(50) CONSTRAINT FK_laporan_pelanggaran FOREIGN KEY (NIM) REFERENCES users(NIM);





 SELECT deskripsi_pelanggaran FROM TataTertib WHERE deskripsi_pelanggaran = 'Merusak sarana dan prasarana yang ada di area Polinema';


 Merusak sarana dan prasarana yang ada di area Polinema
