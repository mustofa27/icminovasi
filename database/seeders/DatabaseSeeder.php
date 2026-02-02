<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Client;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default settings
        Setting::firstOrCreate([], Setting::defaults());

        // Create default admin user
        User::create([
            'name' => 'Admin ICM Inovasi',
            'email' => 'admin@icminovasi.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create editor user
        User::create([
            'name' => 'Editor ICM Inovasi',
            'email' => 'editor@icminovasi.com',
            'password' => bcrypt('editor123'),
            'role' => 'editor',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Keep existing user
        User::factory()->create([
            'name' => 'Ahmad Mustofa',
            'email' => 'mustofaahmad@poltera.ac.id',
            'password' => bcrypt('ZXCasd123!@#'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create clients
        $clients = [
            [
                'name' => 'Politeknik Negeri Madura',
                'company_name' => 'Politeknik Negeri Madura',
                'email' => 'sekretariat@poltera.ac.id',
                'phone' => '081360034040',
                'website' => 'https://www.poltera.ac.id',
                'description' => 'Politeknik Negeri Madura (POLTERA) adalah perguruan tinggi vokasi negeri pertama dan satu-satunya di Pulau Madura, terletak di Camplong, Sampang. Diresmikan sebagai PTN di bawah Kemenristekdikti pada tahun 2012, POLTERA fokus menghasilkan lulusan kompeten, inovatif, dan siap kerja—khususnya sebagai teknopreneur—di bidang teknologi kemaritiman, teknik, dan kesehatan.',
            ],
        ];

        foreach ($clients as $clientData) {
            Client::create($clientData);
        }

        // Create projects
        $projects = [
            [
                'name' => 'Jari Kaki Lima v23',
                'slug' => 'jari-kaki-lima-v23',
                'short_description' => 'Jari Kaki Lima V23 adalah aplikasi inovasi Dinkes Kabupaten Sampang untuk pendampingan dan pemantauan kesehatan ibu hamil dan masyarakat oleh kader. Aplikasi ini membantu bidan dalam pendataan komprehensif guna menurunkan risiko kehamilan.',
                'description' => 'Jari Kaki Lima V23 merupakan aplikasi inovatif yang dikembangkan oleh Dinas Kesehatan Kabupaten Sampang sebagai sarana pendampingan dan pemantauan kesehatan ibu hamil serta masyarakat secara berkelanjutan. Aplikasi ini mendukung peran aktif kader kesehatan dalam melakukan active case finding dan case holding, sehingga setiap kondisi kesehatan dapat terdeteksi lebih dini dan ditindaklanjuti secara tepat.

Melalui versi terbaru ini, Jari Kaki Lima V23 juga memfasilitasi bidan dan tenaga kesehatan dalam melakukan pendataan kesehatan secara komprehensif dan terintegrasi. Data yang dikumpulkan mencakup informasi ibu hamil, kondisi kesehatan, faktor risiko kehamilan, serta hasil pemantauan rutin yang dapat diakses dengan mudah untuk mendukung pengambilan keputusan medis.

Dengan memanfaatkan teknologi digital, aplikasi ini bertujuan untuk meningkatkan kualitas pelayanan kesehatan ibu dan masyarakat, mempercepat alur pelaporan, serta memperkuat kolaborasi antara kader, bidan, dan instansi kesehatan. Kehadiran Jari Kaki Lima V23 diharapkan mampu menurunkan risiko komplikasi kehamilan, meningkatkan kesadaran masyarakat terhadap pentingnya kesehatan ibu dan anak, serta mendorong terciptanya sistem pemantauan kesehatan yang lebih efektif, akurat, dan berkelanjutan di Kabupaten Sampang.',
                'challenges' => '',
                'solutions' => '',
                'results' => '',
                'area_of_expertise' => 'informatics',
                'status' => 'completed',
                'team_size' => null,
                'start_date' => '2023-01-01',
                'end_date' => '2023-12-15',
                'technologies_used' => [],
                'is_featured' => true,
                'is_published' => true,
                'seo_title' => '',
                'seo_description' => '',
                'client_id' => 1,
            ],
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }

        // Create testimonials
        $testimonials = [
            [
                'project_id' => 1,
                'client_id' => 1,
                'client_name' => 'Nadia Dian Rosanti',
                'client_position' => 'Lecturer',
                'testimonial' => 'Jari Kaki Lima V23 adalah aplikasi yang sangat membantu dalam melakukan pendampingan kesehatan ibu hamil. Interface yang user-friendly membuat kader dan bidan dapat dengan mudah melakukan input data dan monitoring kesehatan secara real-time. Aplikasi ini telah terbukti meningkatkan kualitas pelayanan kesehatan dan deteksi dini risiko kehamilan di wilayah kami.',
                'rating' => 5,
                'is_published' => true,
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::create($testimonialData);
        }
    }
}
