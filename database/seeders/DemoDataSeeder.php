<?php

namespace Database\Seeders;

use App\Models\DataCamera;
use App\Models\DataKartu;
use App\Models\DataVendor;
use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $this->seedUsers();
            $vendors = $this->seedVendors();
            $kartuList = $this->seedKartu();
            $this->seedCameras($vendors, $kartuList);
            $this->seedPekerjaan($vendors);
        });
    }

    private function seedUsers(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin Utama', 'role' => 'admin', 'password' => 'password'],
        );

        foreach (range(1, 3) as $i) {
            User::updateOrCreate(
                ['email' => "user{$i}@example.com"],
                ['name' => "User Dummy {$i}", 'role' => 'user', 'password' => 'password'],
            );
        }
    }

    /**
     * @return array<int, DataVendor>
     */
    private function seedVendors(): array
    {
        $data = [
            [
                'nama_perusahaan' => 'PT Sinar Teknologi',
                'pic' => 'Budi', 'cp' => '081234567890',
                'provinsi' => 'Bali', 'kota' => 'Denpasar',
                'kecamatan' => 'Kuta', 'kode_pos' => '80361',
                'email_perusahaan' => 'sinar@tek.id',
                'alamat' => 'Jl. Raya Kuta No. 88, Kuta, Badung',
            ],
            [
                'nama_perusahaan' => 'CV Mitra Jaya',
                'pic' => 'Made', 'cp' => '081298765432',
                'provinsi' => 'Bali', 'kota' => 'Badung',
                'kecamatan' => 'Kuta Utara', 'kode_pos' => '80361',
                'email_perusahaan' => 'mitra@jaya.id',
                'alamat' => 'Jl. Sunset Road No. 123, Kuta, Badung',
            ],
            [
                'nama_perusahaan' => 'PT Cipta Mandiri',
                'pic' => 'Wayan', 'cp' => '082112345678',
                'provinsi' => 'Bali', 'kota' => 'Gianyar',
                'kecamatan' => 'Denpasar Barat', 'kode_pos' => '80119',
                'email_perusahaan' => 'cipta@mandiri.id',
                'alamat' => 'Jl. Gatot Subroto Barat No. 45, Denpasar',
            ],
            [
                'nama_perusahaan' => 'CV Bali Elektrik',
                'pic' => 'Ketut', 'cp' => '085711223344',
                'provinsi' => 'Bali', 'kota' => 'Tabanan',
                'kecamatan' => 'Denpasar Selatan', 'kode_pos' => '80222',
                'email_perusahaan' => 'bali@elektrik.id',
                'alamat' => 'Jl. Bypass Ngurah Rai No. 200, Denpasar',
            ],
        ];

        return array_map(
            fn (array $row) => DataVendor::firstOrCreate(
                ['nama_perusahaan' => $row['nama_perusahaan']],
                $row,
            ),
            $data,
        );
    }

    /**
     * @return array<int, DataKartu>
     */
    private function seedKartu(): array
    {
        $data = [
            ['nomor' => '08110001111', 'ip' => '10.0.0.11', 'kuota' => 50, 'sisa_kuota' => 32],
            ['nomor' => '08110002222', 'ip' => '10.0.0.12', 'kuota' => 50, 'sisa_kuota' => 18],
            ['nomor' => '08110003333', 'ip' => '10.0.0.13', 'kuota' => 100, 'sisa_kuota' => 90],
            ['nomor' => '08110004444', 'ip' => '10.0.0.14', 'kuota' => 50, 'sisa_kuota' => 5],
            ['nomor' => '08110005555', 'ip' => '10.0.0.15', 'kuota' => 50, 'sisa_kuota' => 47],
            ['nomor' => '089999999999', 'ip' => '10.0.0.1', 'kuota' => 60, 'sisa_kuota' => 60],
        ];

        return array_map(
            fn (array $row) => DataKartu::firstOrCreate(
                ['nomor' => $row['nomor']],
                array_merge($row, [
                    'subnet' => '255.255.255.0',
                    'gateway' => '10.0.0.1',
                    'dns' => '8.8.8.8',
                ]),
            ),
            $data,
        );
    }

    /**
     * @param  array<int, DataVendor>  $vendors
     * @param  array<int, DataKartu>   $kartuList
     */
    private function seedCameras(array $vendors, array $kartuList): void
    {
        $basePort = 8010;

        $rows = [
            ['mac' => 'AC:CC:8E:00:11:01', 'resolusi' => '4MP',   'channel' => '10', 'kartuIdx' => 0],
            ['mac' => 'AC:CC:8E:00:11:02', 'resolusi' => '1080p', 'channel' => '11', 'kartuIdx' => 1],
            ['mac' => 'AC:CC:8E:00:11:03', 'resolusi' => '4MP',   'channel' => '12', 'kartuIdx' => 2],
            ['mac' => 'AC:CC:8E:00:11:04', 'resolusi' => '2MP',   'channel' => '13', 'kartuIdx' => 3],
            ['mac' => 'AC:CC:8E:00:11:05', 'resolusi' => '4K',    'channel' => '14', 'kartuIdx' => 4],
            ['mac' => 'AC:CC:8E:00:11:06', 'resolusi' => '1080p', 'channel' => '15', 'kartuIdx' => null],
            ['mac' => 'AC:CC:8E:00:11:07', 'resolusi' => '4MP',   'channel' => '16', 'kartuIdx' => null],
            ['mac' => 'AC:CC:8E:00:11:08', 'resolusi' => '2MP',   'channel' => '19', 'kartuIdx' => null],
        ];

        foreach ($rows as $i => $row) {
            DataCamera::firstOrCreate(
                ['mac' => $row['mac']],
                [
                    'ip' => '116.66.205.182',
                    'vendor_id' => $vendors[0]->id,
                    'kartu_id' => $row['kartuIdx'] !== null ? $kartuList[$row['kartuIdx']]->id : null,
                    'rtsp_port' => 554,
                    'http_port' => $basePort + $i,
                    'brand' => 'EZVIZ',
                    'tipe' => 'Dome',
                    'resolusi' => $row['resolusi'],
                    'channel' => $row['channel'],
                    'latitude' => '-8.6628820',
                    'longitude' => '115.2176190',
                ],
            );
        }
    }

    /**
     * @param  array<int, DataVendor>  $vendors
     */
    private function seedPekerjaan(array $vendors): void
    {
        $data = [
            [
                'nama' => 'Pemasangan CCTV Tol Akses Benoa',
                'status' => 'aktif', 'tanggal' => '2026-01-15',
                'vendor_id' => $vendors[0]->id,
                'alamat' => 'KM 1100 Tol Akses Benoa, Denpasar',
                'deskripsi' => 'Pemasangan CCTV pada area tol akses Benoa sepanjang 2km',
            ],
            [
                'nama' => 'Maintenance CCTV KM 1100',
                'status' => 'aktif', 'tanggal' => '2026-03-10',
                'vendor_id' => $vendors[1]->id,
                'alamat' => 'KM 1100 Tol Akses Benoa, Denpasar',
                'deskripsi' => 'Maintenance rutin kamera CCTV di titik KM 1100',
            ],
            [
                'nama' => 'Pengadaan CCTV Simpson',
                'status' => 'pending', 'tanggal' => '2026-06-01',
                'vendor_id' => $vendors[3]->id,
                'alamat' => 'Jl. By Pass Simpson, Denpasar',
                'deskripsi' => 'Pengadaan CCTV baru untuk monitoring simpang',
            ],
        ];

        foreach ($data as $row) {
            Pekerjaan::firstOrCreate(['nama' => $row['nama']], $row);
        }
    }
}
