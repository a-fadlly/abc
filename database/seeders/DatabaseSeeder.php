<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use App\Models\Lampiran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::create([
            'id' => 5,
            'product_nu' => 'CEP0101004',
            'name' => 'CEPEZET 100',
            'price' => 45000
        ]);

        \App\Models\Product::create([
            'id' => 2,
            'product_nu' => 'ELX0101001',
            'name' => 'ELXION 10',
            'price' => 346500
        ]);

        \App\Models\Product::create([
            'id' => 3,
            'product_nu' => 'FOR1301001',
            'name' => 'FORMENING',
            'price' => 179250
        ]);

        \App\Models\Doctor::create([
            'id' => 1,
            'doctor_nu' => '13',
            'name' => 'Nirwan Sumargo',
            'address' => 'Jl.Koblem No 11 Sby'
        ]);

        \App\Models\Doctor::create([
            'id' => 2,
            'doctor_nu' => '17713',
            'name' => 'Rizkidarwati',
            'address' => 'Kopelma Darussalam no. 12'
        ]);

        \App\Models\Doctor::create([
            'id' => 3,
            'doctor_nu' => '17715',
            'name' => 'Tuti Hernawati Suwirno',
            'address' => 'Jln. Alam Elok VIII/BB 14 Pondok Pinang'
        ]);

        \App\Models\Outlet::create([
            'id' => 1,
            'outlet_nu' => 'OT000001',
            'name' => 'MALAKA BARU, APT',
            'address' => 'JL.PONDOK KOPI RAYA RUKO MALAK   JAKARTA TIMUR'
        ]);

        \App\Models\Outlet::create([
            'id' => 2,
            'outlet_nu' => 'OT000006',
            'name' => 'PAHALA, APT',
            'address' => 'JL. PISANGAN LAMA III NO.3 RT.002 RW.007  JAKARTA TIMUR TELP. 021-4723369'
        ]);

        \App\Models\Outlet::create([
            'id' => 3,
            'outlet_nu' => 'OT000010',
            'name' => 'ASTA NUGRAHA, APT',
            'address' => 'JL.DARMAGA BLK K 3 NO.1 KLENDER'
        ]);

        \App\Models\User::create([
            'id' => 1,
            'name' => 'Kasbandi',
            'username' => '3800000000',
            'email' => 'kasbandi@test.com',
            'password' => '$2y$10$OY93W.JrpBbgyqg08ZnNeOuZ4i/C4xVbWk20GA6OFmaCCTCGmVj7S',
            'role_id' => 4,
            'is_active' => 1
        ]);

        \App\Models\User::create([
            'id' => 2,
            'name' => 'Bambang Suprijatno',
            'username' => '3100000000',
            'email' => 'bambang@test.com',
            'password' => '$2y$10$OY93W.JrpBbgyqg08ZnNeOuZ4i/C4xVbWk20GA6OFmaCCTCGmVj7S',
            'role_id' => 3,
            'reporting_manager' => 1,
            'is_active' => 1
        ]);

        \App\Models\User::create([
            'id' => 3,
            'name' => 'Rahmatullah',
            'username' => '3110000000',
            'email' => 'rahmatullah@test.com',
            'password' => '$2y$10$OY93W.JrpBbgyqg08ZnNeOuZ4i/C4xVbWk20GA6OFmaCCTCGmVj7S',
            'role_id' => 2,
            'reporting_manager' => 2,
            'is_active' => 1
        ]);

        \App\Models\User::create([
            'id' => 4,
            'name' => 'M. Taufik',
            'username' => '3110800000',
            'email' => 'mtaufik@test.com',
            'password' => '$2y$10$OY93W.JrpBbgyqg08ZnNeOuZ4i/C4xVbWk20GA6OFmaCCTCGmVj7S',
            'role_id' => 1,
            'reporting_manager' => 3,
            'is_active' => 1
        ]);

        \App\Models\User::create([
            'id' => 5,
            'name' => 'Suwarno Adi Prayitno',
            'username' => '3110910000',
            'email' => 'suwarno@test.com',
            'password' => '$2y$10$OY93W.JrpBbgyqg08ZnNeOuZ4i/C4xVbWk20GA6OFmaCCTCGmVj7S',
            'role_id' => 1,
            'reporting_manager' => 3,
            'is_active' => 1
        ]);

        \App\Models\Role::create([
            'id' => 1,
            'name' => 'District Manager'
        ]);
        \App\Models\Role::create([
            'id' => 2,
            'name' => 'Regional Manager'
        ]);
        \App\Models\Role::create([
            'id' => 3,
            'name' => 'Marketing Manager'
        ]);
        \App\Models\Role::create([
            'id' => 4,
            'name' => 'Deputy Marketing Director'
        ]);

        $userIds = \App\Models\User::pluck('id')->toArray();
        $doctorIds = \App\Models\Doctor::pluck('doctor_nu')->toArray();
        $outletIds = \App\Models\Outlet::pluck('outlet_nu')->toArray();
        $productIds = \App\Models\Product::pluck('product_nu')->toArray();


        for ($i = 1; $i <= 10; $i++) {
            $lampiranId = Lampiran::create([
                'lampiran_nu' => rand(1, 10),
                'user_id' => rand(4, 5),
                'status' => rand(0, 1) ? 4 : 1,
                'periode' => Carbon::now(),
                'percent' => rand(3, 10),
                'sales' => rand(1000000, 5000000),
                'doctor_nu' => '13',
                'outlet_nu' => 'OT000001',
                'product_nu' => 'ELX0101001',
                'quantity' => rand(10, 30),
                'created_by' => 1,
            ])->id;

            $createdBy = $userIds[array_rand($userIds)];
            $doctorNu = $doctorIds[array_rand($doctorIds)];
            $outletNu = $outletIds[array_rand($outletIds)];
            $productNu = $productIds[array_rand($productIds)];

            Lampiran::where('id', $lampiranId)->update([
                'doctor_nu' => $doctorNu,
                'outlet_nu' => $outletNu,
                'product_nu' => $productNu,
                'created_by' => $createdBy,
            ]);
        }
    }
}
