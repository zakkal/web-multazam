<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ustadz;
use App\Models\Santri;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $ustadz1 = Ustadz::create([
            'nama' => 'Ustadz Ahmad Zuhdi, Lc.',
            'jenis_kelamin' => 'L',
            'no_wa' => '081234567801',
            'asal_pondok' => 'PP Gontor',
        ]);

        $ustadz2 = Ustadz::create([
            'nama' => 'Ustadz Muhammad Hasyim, S.Pd.',
            'jenis_kelamin' => 'L',
            'no_wa' => '081234567802',
            'asal_pondok' => 'PP Lirboyo',
        ]);

        $ustadz3 = Ustadz::create([
            'nama' => 'Ustadzah Fatimah Az-Zahra, M.A.',
            'jenis_kelamin' => 'P',
            'no_wa' => '081234567803',
            'asal_pondok' => 'PP Al-Munawwir',
        ]);

        Santri::create([
            'nama' => 'Ahmad Fauzi',
            'jenis_kelamin' => 'L',
            'kelas' => 7,
            'kelas_halaqah' => 'Halaqah A',
            'nisn' => '30000001',
            'ustadz_id' => $ustadz1->id,
            'orangtua' => 'Bpk. Rahmat',
            'wa_orangtua' => '081234567890',
        ]);

        Santri::create([
            'nama' => 'Aisyah Zahra',
            'jenis_kelamin' => 'P',
            'kelas' => 8,
            'kelas_halaqah' => 'Halaqah B',
            'nisn' => '30000002',
            'ustadz_id' => $ustadz3->id,
            'orangtua' => 'Ibu Siti',
            'wa_orangtua' => '081234567891',
        ]);

        Santri::create([
            'nama' => 'Muhammad Rizki',
            'jenis_kelamin' => 'L',
            'kelas' => 9,
            'kelas_halaqah' => 'Halaqah C',
            'nisn' => '30000003',
            'ustadz_id' => $ustadz2->id,
            'orangtua' => 'H. Sulaiman',
            'wa_orangtua' => '081234567892',
        ]);
    }
}
