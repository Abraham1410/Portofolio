<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================
        // ✏️  EDIT BAGIAN INI SESUAI DATA KAMU
        // ============================================

        // Admin user
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@portfolio.com',
            'password' => Hash::make('password'),
        ]);

        // Profile kamu
        Profile::create([
            'name'     => 'Nama Kamu',          // ← Ganti ini
            'title'    => 'Full Stack Developer', // ← Ganti ini
            'tagline'  => 'Saya membangun website yang elegan & powerful',
            'about'    => 'Halo! Saya adalah seorang developer dengan pengalaman 3+ tahun dalam membangun aplikasi web modern. Saya passionate dalam menciptakan solusi digital yang tidak hanya fungsional tapi juga indah secara visual. Saya percaya bahwa kode yang baik adalah seni.',
            'email'    => 'kamu@email.com',      // ← Ganti ini
            'phone'    => '+62 812-3456-7890',
            'location' => 'Jakarta, Indonesia',
            'github'   => 'https://github.com/username',
            'linkedin' => 'https://linkedin.com/in/username',
            'instagram'=> 'https://instagram.com/username',
            'skills'   => json_encode([
                ['name' => 'Laravel',    'level' => 90, 'icon' => '⚙️'],
                ['name' => 'Vue.js',     'level' => 85, 'icon' => '💚'],
                ['name' => 'React',      'level' => 75, 'icon' => '⚛️'],
                ['name' => 'MySQL',      'level' => 85, 'icon' => '🗄️'],
                ['name' => 'Tailwind',   'level' => 90, 'icon' => '🎨'],
                ['name' => 'Docker',     'level' => 70, 'icon' => '🐳'],
                ['name' => 'Git',        'level' => 90, 'icon' => '🌿'],
                ['name' => 'Node.js',    'level' => 75, 'icon' => '🟢'],
            ]),
            'services' => json_encode([
                ['icon' => '🌐', 'title' => 'Web Development',    'desc' => 'Membangun website modern, responsif, dan berkinerja tinggi'],
                ['icon' => '📱', 'title' => 'Mobile App',         'desc' => 'Aplikasi mobile cross-platform dengan React Native'],
                ['icon' => '🎨', 'title' => 'UI/UX Design',       'desc' => 'Desain antarmuka yang intuitif dan menarik secara visual'],
                ['icon' => '🚀', 'title' => 'API Development',    'desc' => 'RESTful API yang scalable dan terdokumentasi dengan baik'],
            ]),
        ]);

        // Sample projects
        $projects = [
            [
                'title'            => 'E-Commerce Platform',
                'slug'             => 'e-commerce-platform',
                'description'      => 'Platform e-commerce lengkap dengan fitur payment gateway, manajemen stok, dan dashboard analytics.',
                'long_description' => 'Membangun platform e-commerce dari nol dengan fitur lengkap: multi-payment gateway (Midtrans, Xendit), real-time inventory management, analitik penjualan, dan sistem notifikasi otomatis.',
                'category'         => 'Web App',
                'tech_stack'       => json_encode(['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS', 'Midtrans']),
                'url_live'         => 'https://example.com',
                'url_github'       => 'https://github.com/username/project',
                'featured'         => true,
                'order'            => 1,
            ],
            [
                'title'            => 'Dashboard Analytics',
                'slug'             => 'dashboard-analytics',
                'description'      => 'Dashboard real-time untuk monitoring bisnis dengan visualisasi data interaktif dan laporan otomatis.',
                'long_description' => 'Dashboard analytics yang powerful dengan grafik real-time, laporan PDF otomatis, filter data advanced, dan sistem alert ketika KPI tidak tercapai.',
                'category'         => 'Web App',
                'tech_stack'       => json_encode(['Laravel', 'React', 'Chart.js', 'PostgreSQL', 'Redis']),
                'url_live'         => null,
                'url_github'       => 'https://github.com/username/project2',
                'featured'         => true,
                'order'            => 2,
            ],
            [
                'title'            => 'Sistem Manajemen Sekolah',
                'slug'             => 'sistem-manajemen-sekolah',
                'description'      => 'Aplikasi SIS (School Information System) untuk manajemen siswa, guru, jadwal, dan nilai secara digital.',
                'long_description' => 'Sistem informasi sekolah komprehensif yang mencakup absensi QR code, penilaian online, komunikasi orang tua-guru, dan laporan akademik otomatis.',
                'category'         => 'Web App',
                'tech_stack'       => json_encode(['Laravel', 'Alpine.js', 'MySQL', 'Livewire', 'Tailwind CSS']),
                'url_live'         => 'https://example2.com',
                'url_github'       => null,
                'featured'         => false,
                'order'            => 3,
            ],
            [
                'title'            => 'Mobile Delivery App',
                'slug'             => 'mobile-delivery-app',
                'description'      => 'Aplikasi delivery makanan dengan fitur tracking real-time, rating driver, dan pembayaran in-app.',
                'long_description' => null,
                'category'         => 'Mobile App',
                'tech_stack'       => json_encode(['React Native', 'Laravel API', 'Firebase', 'Google Maps']),
                'url_live'         => null,
                'url_github'       => 'https://github.com/username/project3',
                'featured'         => false,
                'order'            => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
