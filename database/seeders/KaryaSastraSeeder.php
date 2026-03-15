<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KaryaSastra;

class KaryaSastraSeeder extends Seeder
{
    public function run(): void
    {
        KaryaSastra::truncate();

        // ═══════════════════════════
        //  PUISI
        // ═══════════════════════════
        $puisis = [
            ['judul'=>'Hujan di Negeri Melayu','jenis'=>'Puisi Lirik','deskripsi'=>'Hujan menjadi simbol kerinduan dan kenangan yang mengaliri tanah Melayu dengan cerita yang tak terhapus oleh waktu.',
             'konten'=>[['Hujan turun membasahi bumi,','memeluk tanah yang lama rindu.'],['Di sini aku berdiri sendiri,','mengeja nama dalam gerimis yang syahdu.'],['Akar pohon sungkai menjalar,','seperti ingatan yang tak mau pergi.'],['Angin sungai berbisik keras,','tentang masa yang telah berlari.'],['Biarlah hujan mencuci luka,','dan embun malam menyembuhkan duka.'],['Sebab negeri ini menyimpan cerita,','di setiap tetes, di setiap kata.']],
             'makna'=>'Puisi ini menggambarkan kerinduan mendalam seorang perantau pada kampung halamannya di Riau. Hujan menjadi metafora untuk kenangan yang terus-menerus membasahi ingatan.',
             'metadata'=>['majas'=>['Personifikasi','Metafora','Imaji alam']]],

            ['judul'=>'Sungai Siak Bercerita','jenis'=>'Puisi Naratif','deskripsi'=>'Sungai Siak sebagai saksi bisu peradaban Melayu — dari kejayaan masa lampau hingga semangat yang tetap mengalir.',
             'konten'=>[['Sungai Siak mengalir tenang,','membawa kisah dari hulu ke hilir.'],['Di tepiannya para nelayan bertahang,','menunggu rezeki yang tak pernah terlambat tiba.'],['O, Siak — saksi bisu peradaban,','di airmu tersimpan sejarah Melayu.'],['Istana berdiri penuh keanggunan,','mengingatkan kita: bangsa yang berbudaya tidak layu.'],['Biarlah arus ini terus mengalir,','membawa semangat hingga ke laut lepas.'],['Kami anak Riau tak akan lupa,','dari mana akar dan tunas ditanam dalam deras.']],
             'makna'=>'Puisi ini merayakan Sungai Siak sebagai urat nadi peradaban Melayu.',
             'metadata'=>['majas'=>['Apostrophe','Simbol','Imaji visual']]],

            ['judul'=>'Ibu','jenis'=>'Puisi Elegi','deskripsi'=>'Sebuah persembahan kata kepada ibu — sosok yang tangannya kasar oleh waktu namun cintanya selalu hangat tanpa batas.',
             'konten'=>[['Tanganmu kasar oleh waktu,','namun sentuhannya selalu hangat.'],['Di setiap kerutan kutemu cinta,','yang tak pernah mengenal kata batas.'],['Ibu, doamu adalah langit,','menaungi aku dari hujan dan badai.'],['Namamu kusebut ketika tersesat,','dan jalan pulang selalu terbuka kembali.'],['Di surga doa-doamu mengetuk pintu,','memohonkan anak yang jauh agar selalu terlindung.'],['Ibu, kasihmu adalah laut,','dalam tanpa tepi, nyata tanpa syarat.']],
             'makna'=>'Puisi sederhana namun menyentuh ini mengekspresikan rasa syukur dan cinta seorang anak kepada ibunya.',
             'metadata'=>['majas'=>['Simile','Metafora','Hiperbola']]],

            ['judul'=>'Hutan Rimba Riau','jenis'=>'Puisi Alam','deskripsi'=>'Sebuah seruan untuk menjaga rimba Riau — warisan alam yang tak ternilai bagi anak cucu.',
             'konten'=>[['Di rimba raya kau berdiri megah,','pohon-pohon tua menjaga rahasia.'],['Burung hinggap tanpa rasa lelah,','bernyanyi untuk semesta yang bahagia.'],['Lindungi kami, wahai rimba,','dengan naungan daun yang rindang.'],['Kau warisan yang tak ternilai harganya,','bagi anak cucu yang akan datang.'],['Jangan biarkan kapak menebang cerita,','yang telah ditulis selama ribuan tahun.'],['Karena ketika rimba sirna tanpa kata,','maka hilang pula napas bumi yang bersahutan.']],
             'makna'=>'Puisi ini adalah seruan penyair kepada alam dan manusia untuk menjaga hutan Riau.',
             'metadata'=>['majas'=>['Apostrophe','Personifikasi','Hiperbola']]],

            ['judul'=>'Malam di Pekanbaru','jenis'=>'Puisi Kontemporer','deskripsi'=>'Pekanbaru di malam hari — kota yang berdenyut dengan kehidupan modern namun masih menyimpan jiwa Melayu yang tenang.',
             'konten'=>[['Lampu-lampu kota berkelip seperti bintang,','Pekanbaru menari dalam gemerlapnya malam.'],['Di balik gedung tinggi dan jalan yang panjang,','masih terdengar adzan dari masjid tua yang tenang.'],['Aku berdiri di persimpangan zaman,','antara modern dan melayu yang masih setia.'],['Kota ini tumbuh namun tak kehilangan badan,','akarnya hijau, dahan-dahannya menjulang bebas merdeka.']],
             'makna'=>'Pekanbaru digambarkan sebagai kota yang berhasil menyeimbangkan modernitas dan identitas Melayu.',
             'metadata'=>['majas'=>['Personifikasi','Metafora','Antitesis']]],

            ['judul'=>'Sepucuk Surat untuk Riau','jenis'=>'Puisi Epistolari','deskripsi'=>'Sebuah surat dalam bentuk puisi — curahan hati sang penyair untuk negeri Riau yang dicintai.',
             'konten'=>[['Riau, negeri tempat aku lahir dan besar,','kutulis surat ini dari kejauhan yang dalam.'],['Kuingat pasir tepimu yang putih bersih,','dan senyum orang-orangmu yang tulus ikhlas.'],['Meski jauh kaki melangkah ke negeri asing,','hatiku tinggal di sini, di bumi yang rindang.'],['Jaga dirimu, Riau — jaga adat dan bahasamu,','karena dari sanalah kami memperoleh jiwa.'],['Suatu hari aku akan pulang ke pangkuanmu,','membawa secupak cerita dari tanah seberang.']],
             'makna'=>'Puisi berbentuk surat ini mengungkapkan rasa cinta dan tanggung jawab seorang anak Riau terhadap tanah kelahirannya.',
             'metadata'=>['majas'=>['Apostrophe','Simile','Imaji sensoris']]],
        ];

        foreach ($puisis as $i => $p) {
            KaryaSastra::create(array_merge($p, ['tipe'=>'puisi','penulis'=>'Penyair Riau','is_published'=>true,'sort_order'=>$i+1]));
        }

        // ═══════════════════════════
        //  CERPEN
        // ═══════════════════════════
        $cerpens = [
            ['judul'=>'Perahu Kertas di Sungai Kenangan','jenis'=>'Tradisi & Budaya','durasi_baca'=>'± 5 menit','deskripsi'=>'Mak Cik Rohani dan tradisi melepas perahu kertas ke sungai setiap sore — sebuah cara mengirim doa.',
             'konten'=>['Setiap sore, Mak Cik Rohani duduk di tepi sungai itu. Tangannya yang keriput selalu memegang selembar kertas — kertas yang akan segera ia lipat menjadi perahu kecil, lalu dilepas ke arus yang tenang.',
                        '"Untuk siapa perahu itu, Mak Cik?" tanya Amir, bocah tujuh tahun yang selalu menemaninya.',
                        'Mak Cik Rohani tersenyum. Kerut di wajahnya seolah menyimpan ribuan cerita. "Untuk abangmu yang jauh di rantau, Nak. Kata orang, kalau kita kirim doa lewat air yang mengalir, ia akan sampai ke mana saja hati bermukim."',
                        'Amir memandang perahu kertas itu berlayar pelan, berputar dua kali sebelum akhirnya menepi di balik akar pohon nipah. Ia tidak mengerti sepenuhnya, tapi ada perasaan hangat yang menjalari dadanya.',
                        'Sore itu, Amir pun meminta selembar kertas kepada Mak Cik. Ia melipat seperahu dengan tangan mungilnya, menuliskan nama abangnya, lalu melepaskannya ke sungai.',
                        '"Mak Cik, kalau perahu itu tenggelam bagaimana?" tanya Amir dengan serius.',
                        '"Tidak apa-apa, Nak," jawab Mak Cik sambil mengusap kepala Amir. "Doa yang sungguh-sungguh selalu sampai, walau lewat jalan yang tak kita sangka-sangka."'],
             'makna'=>'Cerpen ini menyampaikan nilai-nilai kearifan lokal Melayu tentang doa, pengharapan, dan ikatan keluarga.',
             'metadata'=>['tema'=>['Keluarga','Tradisi','Rindu']]],

            ['judul'=>'Gelang Perak Nenek','jenis'=>'Keluarga','durasi_baca'=>'± 4 menit','deskripsi'=>'Sebuah gelang perak tua yang menyimpan janji pernikahan setengah abad dan pelajaran tentang keteguhan.',
             'konten'=>['Gelang perak itu selalu ada di pergelangan tangan Nenek. Tidak pernah dilepas sejak hari pernikahan, lima puluh tahun yang lalu. Hingga suatu pagi yang redup, Nenek memanggilku ke sisi ranjangnya.',
                        '"Putri, gelang ini bukan sekadar perhiasan," katanya dengan suara yang sudah mulai goyah. "Di sini tersimpan janji yang paling sakral antara aku dan kakekmu."',
                        'Aku menggenggam tangan Nenek erat. Gelang itu dingin di sentuhanku, tapi ada kehangatan yang tak bisa kujelaskan memancar dari sana.',
                        '"Sekarang giliran kamu yang menjaganya, Putri. Jadilah perempuan yang teguh seperti perak ini — dipanaskan pun tidak melebur, dihantam pun tidak retak."',
                        'Dengan mata berkaca-kaca, aku melingkarkan gelang itu di pergelangan tanganku. Rasanya berat, tapi bukan berat benda — berat sebuah amanah yang lebih besar dari diri sendiri.',
                        'Sejak hari itu, aku tak pernah melepas gelang itu. Dan setiap kali aku hampir menyerah pada kerasnya hidup, dinginnya perak di kulitku mengingatkan: ada janji yang lebih kuat dari rasa lelah.'],
             'makna'=>'Cerpen ini menunjukkan bagaimana warisan bukan sekadar benda, melainkan nilai dan kekuatan yang diwariskan lintas generasi.',
             'metadata'=>['tema'=>['Warisan','Keteguhan','Pernikahan']]],

            ['judul'=>'Pedagang Kain di Pasar Pagi','jenis'=>'Kehidupan Sosial','durasi_baca'=>'± 4 menit','deskripsi'=>'Pak Daud dan lapak kain songket-nya mengajarkan bahwa ada hal-hal yang nilainya melampaui angka.',
             'konten'=>['Pak Daud membuka lapaknya sebelum ayam berkokok. Kain-kain songket dan tenun Melayu ia tata dengan penuh cinta, seolah setiap lembar adalah bagian dari dirinya sendiri.',
                        '"Ini bukan sekadar kain, Bu," ujarnya kepada seorang pembeli yang menawar terlalu murah. "Di setiap benangnya ada keringat penenun dari Siak sana."',
                        'Pembeli itu terdiam. Lalu perlahan, ia mengulurkan uang sesuai harga yang diminta — bahkan sedikit lebih.',
                        'Pak Daud tersenyum dengan mata yang berkaca. Bukan karena uangnya, tapi karena ada seseorang yang akhirnya mengerti.',
                        '"Nak," kata Pak Daud sambil melipat kain dengan hati-hati, "di sini aku tidak hanya menjual kain. Aku menjaga cerita. Selama ada satu orang yang masih mau mendengarkan cerita itu, aku akan terus di sini."'],
             'makna'=>'Cerpen ini merayakan nilai kearifan lokal dan usaha melestarikan budaya Melayu dalam derasnya modernisasi.',
             'metadata'=>['tema'=>['Budaya','Ketekunan','Ekonomi Lokal']]],

            ['judul'=>'Anak Lanun dari Selat Malaka','jenis'=>'Sejarah & Petualangan','durasi_baca'=>'± 6 menit','deskripsi'=>'Kisah seorang bocah pesisir yang mewarisi semangat berlayar leluhur dan belajar bahwa keberanian bukan absennya rasa takut.',
             'konten'=>['Namanya Rafi. Dua belas tahun, anak bungsu seorang nelayan di pesisir Riau. Setiap malam ia duduk di dermaga sambil menatap bintang-bintang yang sama yang dilihat oleh para pelaut leluhurnya ratusan tahun lalu.',
                        '"Ayah, apakah leluhur kita benar-benar pernah berlayar sampai ke negeri Cina?" tanyanya suatu malam.',
                        'Ayahnya tersenyum sambil memperbaiki jaring. "Bukan hanya ke Cina. Ke India, ke Arab, ke mana angin membawa. Orang Melayu sudah lama bersahabat dengan laut."',
                        '"Tapi laut itu menakutkan," kata Rafi.',
                        '"Memang. Tapi yang membuat leluhur kita besar bukan karena mereka tidak takut. Keberanian sejati, Nak, adalah melangkah meski lutut gemetar."',
                        'Keesokan harinya, untuk pertama kali, Rafi ikut melaut bersama ayahnya. Ketika ombak besar pertama menghantam perahu kecil mereka, jantungnya hampir copot.',
                        'Tapi ia ingat kata ayahnya. Ia pegang dayung itu kuat-kuat, dan ia mendayung.',
                        'Matahari terbenam ketika mereka pulang dengan penuh ikan. Rafi tidak berkata apa-apa. Tapi senyumnya berbicara lebih dari seribu kata.'],
             'makna'=>'Cerpen ini menggambarkan proses pendewasaan dan pewarisan semangat bahari leluhur kepada generasi berikutnya.',
             'metadata'=>['tema'=>['Keberanian','Bahari','Ayah & Anak']]],
        ];

        foreach ($cerpens as $i => $c) {
            KaryaSastra::create(array_merge($c, ['tipe'=>'cerpen','penulis'=>'Penulis Riau','is_published'=>true,'sort_order'=>$i+1]));
        }

        // ═══════════════════════════
        //  PANTUN
        // ═══════════════════════════
        $pantuns = [
            ['judul'=>'Buah Cempedak di Luar Pagar','tema'=>'Nasihat','deskripsi'=>'Pantun nasihat yang mengajarkan rendah hati dan terbuka menerima masukan.',
             'konten'=>['Buah cempedak di luar pagar,','ambil galah tolong jolokkan;','Saya budak baru belajar,','kalau salah tolong tunjukkan.'],
             'makna'=>'Pantun ini mengajarkan sikap rendah hati. Seseorang yang baru belajar hendaklah terbuka menerima kritik dan koreksi.'],
            ['judul'=>'Kalau Ada Sumur di Ladang','tema'=>'Pertemuan','deskripsi'=>'Pantun perpisahan yang penuh harap akan pertemuan kembali di masa mendatang.',
             'konten'=>['Kalau ada sumur di ladang,','boleh kita menumpang mandi;','Kalau ada umur yang panjang,','boleh kita berjumpa lagi.'],
             'makna'=>'Pantun ini adalah ungkapan doa dan harapan saat berpisah.'],
            ['judul'=>'Ke Mana Hendak Ku Tuju','tema'=>'Cinta','deskripsi'=>'Pantun cinta yang mengungkapkan kesetiaan hati kepada satu orang yang dicintai.',
             'konten'=>['Ke mana hendak ku tuju,','ke mana hendak ku berlabuh;','Hatiku hanya untukmu,','dalam setiap nafas dan kalbuku.'],
             'makna'=>'Pantun ini meluapkan isi hati seorang pencinta yang telah menentukan pilihan.'],
            ['judul'=>'Anak Ayam Turun Sepuluh','tema'=>'Semangat','deskripsi'=>'Pantun yang memberi semangat untuk terus menuntut ilmu meski menghadapi rintangan.',
             'konten'=>['Anak ayam turun sepuluh,','mati satu tinggal sembilan;','Bangun pagi menuntut ilmu,','biar pun lelah terus berjalan.'],
             'makna'=>'Melalui gambaran anak ayam, pantun ini mendorong semangat pantang menyerah.'],
            ['judul'=>'Pohon Kelapa Tumbuh Condong','tema'=>'Hormat','deskripsi'=>'Pantun nasihat tentang menghormati orang tua selagi mereka masih ada.',
             'konten'=>['Pohon kelapa tumbuh condong,','akarnya kuat menghujam tanah;','Kepada orang tua kita mendong,','hormati selagi masih ada.'],
             'makna'=>'Akar kelapa yang kuat melambangkan pondasi adat dan budi pekerti.'],
            ['judul'=>'Bunga Melur Bunga Cempaka','tema'=>'Rindu','deskripsi'=>'Pantun kerinduan yang memperlihatkan bahwa jarak tidak memisahkan rasa.',
             'konten'=>['Bunga melur bunga cempaka,','harum baunya semerbak wangi;','Jauh di mata jauh di mata,','namun tetap dekat di hati.'],
             'makna'=>'Seperti harum bunga yang menyebar jauh, rasa sayang pun tak terhalang jarak.'],
        ];

        foreach ($pantuns as $i => $p) {
            KaryaSastra::create(array_merge($p, ['tipe'=>'pantun','penulis'=>'Pantun Melayu Tradisional','is_published'=>true,'sort_order'=>$i+1,'metadata'=>[]]));
        }

        // ═══════════════════════════
        //  SYAIR
        // ═══════════════════════════
        $syairs = [
            ['judul'=>'Syair Nasihat kepada Anak','tema'=>'Nasihat','deskripsi'=>'Syair nasihat berisi pesan moral untuk berbakti, berilmu, dan berakhlak mulia.',
             'konten'=>[['Wahai ananda dengarlah pesan,','hidup di dunia penuh rintangan;','Ilmu dan amal jadikan tumpuan,','agar hati teguh dalam keimanan.'],['Hormat kepada ibu dan bapak,','janganlah berlaku kasar dan lancang;','Ridha ilahi di sana terletak,','bila hati orang tua senang dan terancang.'],['Bergaul dengan orang yang saleh,','jauhkan diri dari yang sesat;','Apabila hati terjaga bersih,','niscaya hidup penuh berkah dan nikmat.']],
             'makna'=>'Syair ini adalah pesan seorang bijaksana kepada generasi muda tentang tiga pilar: ilmu & iman, bakti kepada orang tua, dan menjaga pergaulan.'],
            ['judul'=>'Syair Tanah Melayu','tema'=>'Patriotik','deskripsi'=>'Syair kebangsaan yang mengajak generasi muda menjaga warisan budaya Melayu.',
             'konten'=>[['Di bumi Melayu kita berpijak,','adat dan budaya jangan diabaikan;','Pusaka leluhur jangan dipecah,','generasi muda wajib meneruskan.'],['Sungai Siak mengalir tenang,','membawa cerita zaman berzaman;','Tegakkan yang hak jangan gusar pun ragu,','kebenaran itu pasti menang.'],['Bahasa Melayu mahkota bangsa,','jaga dan junjung sepanjang masa;','Dengan bahasa kita berasa,','itulah jati diri yang mulia.']],
             'makna'=>'Syair patriotik ini mengingatkan setiap orang Melayu akan identitas dan warisan leluhurnya.'],
            ['judul'=>'Syair Pemuda Beriman','tema'=>'Religi','deskripsi'=>'Syair yang memotivasi pemuda untuk mengutamakan iman dan akhlak dalam kehidupan modern.',
             'konten'=>[['Pemuda pemudi harapan bangsa,','tanamkan iman di dada jiwa;','Jangan tersesat di jalan yang sia,','selamat dunia akhirat adalah cita.'],['Sekolah tinggi taklah berguna,','bila akhlak dan budi diabaikan;','Ilmu tanpa iman umpama pedang,','tajam namun melukai diri sendiri pula.'],['Bangun subuh sambut fajar,','sujud syukur kepada Yang Maha Esa;','Dengan iman hati takkan layu,','menghadapi dunia dengan jiwa yang besar.']],
             'makna'=>'Syair ini ditujukan untuk pemuda yang hidup di era modern. Iman adalah landasan agar ilmu digunakan untuk kebaikan.'],
            ['judul'=>'Syair Keindahan Alam Riau','tema'=>'Alam','deskripsi'=>'Syair yang merayakan keindahan alam Riau sekaligus mengajak untuk menjaga kelestariannya.',
             'konten'=>[['Rimba Riau hijau membentang,','kicau burung mengisi pagi;','Di sanalah kita berpanjang-panjang,','merasakan nikmat sang Pencipta Sejati.'],['Jaga hutan jaga sungai kita,','anak cucu berhak warisan;','Bila alam rusak binasa semua,','tanggungjawab ada di bahu kita bersama.'],['Riau bumi yang kaya raya,','anugerah Tuhan tiada terkira;','Syukuri dengan menjaganya,','itulah amanah untuk kita semua.']],
             'makna'=>'Alam Riau yang hijau adalah anugerah yang harus dijaga demi generasi mendatang.'],
        ];

        foreach ($syairs as $i => $s) {
            KaryaSastra::create(array_merge($s, ['tipe'=>'syair','penulis'=>'Penulis Riau','is_published'=>true,'sort_order'=>$i+1,'metadata'=>[]]));
        }

        $this->command->info('✅  KaryaSastra seeded: '.KaryaSastra::count().' karya berhasil dimasukkan.');
    }
}
