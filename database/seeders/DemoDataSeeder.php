<?php

namespace Database\Seeders;

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
            $this->seedPekerjaanVendorKartu();
        });
    }

    private function seedUsers(): void
    {
        User::updateOrCreate(
            ["email" => "admin@example.com"],
            ["name" => "Admin Utama", "role" => "admin", "password" => "password"],
        );

        foreach (range(1, 3) as $i) {
            User::updateOrCreate(
                ["email" => "user{$i}@example.com"],
                ["name" => "User Dummy {$i}", "role" => "user", "password" => "password"],
            );
        }
    }

    private function seedPekerjaanVendorKartu(): void
    {
        $vendors = collect([
            DataVendor::create([
                "nama_perusahaan" => "PT Sinar Teknologi",
                "pic" => "Budi", "cp" => "081234567890",
                "provinsi" => "Bali", "kota" => "Denpasar",
                "email_perusahaan" => "sinar@tek.id",
            ]),
            DataVendor::create([
                "nama_perusahaan" => "CV Mitra Jaya",
                "pic" => "Made", "cp" => "081298765432",
                "provinsi" => "Bali", "kota" => "Badung",
                "email_perusahaan" => "mitra@jaya.id",
            ]),
            DataVendor::create([
                "nama_perusahaan" => "PT Cipta Mandiri",
                "pic" => "Wayan", "cp" => "082112345678",
                "provinsi" => "Bali", "kota" => "Gianyar",
                "email_perusahaan" => "cipta@mandiri.id",
            ]),
            DataVendor::create([
                "nama_perusahaan" => "CV Bali Elektrik",
                "pic" => "Ketut", "cp" => "085711223344",
                "provinsi" => "Bali", "kota" => "Tabanan",
                "email_perusahaan" => "bali@elektrik.id",
            ]),
        ]);

        Pekerjaan::create([
            "nama" => "Pemasangan CCTV Tol Akses Benoa",
            "status" => "aktif",
            "tanggal" => "2026-01-15",
            "vendor_id" => $vendors[0]->id,
        ]);
        Pekerjaan::create([
            "nama" => "Maintenance CCTV KM 1100",
            "status" => "aktif",
            "tanggal" => "2026-03-10",
            "vendor_id" => $vendors[1]->id,
        ]);
        Pekerjaan::create([
            "nama" => "Pengadaan CCTV Simpson",
            "status" => "draft",
            "tanggal" => "2026-06-01",
            "vendor_id" => $vendors[2]->id,
        ]);

        DataKartu::create(["nomor" => "08110001111", "ip" => "10.0.0.11", "kuota" => 50, "sisa_kuota" => 32]);
        DataKartu::create(["nomor" => "08110002222", "ip" => "10.0.0.12", "kuota" => 50, "sisa_kuota" => 18]);
        DataKartu::create(["nomor" => "08110003333", "ip" => "10.0.0.13", "kuota" => 100, "sisa_kuota" => 90]);
        DataKartu::create(["nomor" => "08110004444", "ip" => "10.0.0.14", "kuota" => 50, "sisa_kuota" => 5]);
        DataKartu::create(["nomor" => "08110005555", "ip" => "10.0.0.15", "kuota" => 50, "sisa_kuota" => 47]);
    }
}
