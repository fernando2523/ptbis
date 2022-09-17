<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\AssetHistory;
use App\Models\Fueltake_stocker;
use App\Models\Fueltake_sender;
use App\Models\Fueltake_receiver;
use App\Models\FuelRefill;
use App\Models\FuelTake;
use App\Models\Vehicle;
use App\Models\Vehicle_history;
use App\Models\Location;
use App\Models\LandOwner;
use App\Models\User;
use App\Models\Ritase;
use App\Models\Preparation;
use App\Models\Hourmeter;
use App\Models\Stock_dom;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use FuelStock;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ADMIN',
            'email' => 'admin',
            'password' => Hash::make('asdqwe123'),
            'role' => 'SUPER-ADMIN',
        ]);

        // Preparation::create([
        //     'id_prepp' => 'PREP-220629001',
        //     'location' => 'PIT - 1',
        //     'sample_mining' => 'SM-01',
        //     'increment' => '20',
        //     'ni' => '0',
        //     'fe' => '0',
        //     'status' => 'PROGRESS',
        //     'users' => 'ADMIN  ',
        //     'device' => 'LAPTOP',
        //     'server' => 'ONLINE',
        // ]);

        // Preparation::create([
        //     'id_prepp' => 'PREP-220629002',
        //     'location' => 'PIT - 1',
        //     'sample_mining' => 'SM-02',
        //     'increment' => '20',
        //     'ni' => '0',
        //     'fe' => '0',
        //     'status' => 'PROGRESS',
        //     'users' => 'ADMIN  ',
        //     'device' => 'LAPTOP',
        //     'server' => 'ONLINE',
        // ]);

        // Preparation::create([
        //     'id_prepp' => 'PREP-220629003',
        //     'location' => 'PIT - 1',
        //     'sample_mining' => 'SM-03',
        //     'increment' => '20',
        //     'ni' => '0',
        //     'fe' => '0',
        //     'status' => 'PROGRESS',
        //     'users' => 'ADMIN  ',
        //     'device' => 'LAPTOP',
        //     'server' => 'ONLINE',
        // ]);

        // Preparation::create([
        //     'id_prepp' => 'PREP-220629004',
        //     'location' => 'PIT - 1',
        //     'sample_mining' => 'SM-04',
        //     'increment' => '20',
        //     'ni' => '0',
        //     'fe' => '0',
        //     'status' => 'PROGRESS',
        //     'users' => 'ADMIN  ',
        //     'device' => 'LAPTOP',
        //     'server' => 'ONLINE',
        // ]);

        // Preparation::create([
        //     'id_prepp' => 'PREP-220629005',
        //     'location' => 'PIT - 1',
        //     'sample_mining' => 'SM-05',
        //     'increment' => '20',
        //     'ni' => '0',
        //     'fe' => '0',
        //     'status' => 'PROGRESS',
        //     'users' => 'ADMIN  ',
        //     'device' => 'LAPTOP',
        //     'server' => 'ONLINE',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629002',
        //     'departure_ts' => '2022-06-29 16:33:00',
        //     'arrival_ts' => '2022-06-29 17:33:00',
        //     'identify' => 'DT02',
        //     'model_unit' => 'PC200',
        //     'operator' => 'FAJRI',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '11',
        //     'type_activity' => 'HAULING',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629003',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        // ]);

        // Hourmeter::create([
        //     'id_hm' => 'HM22730001',
        //     'date' => '2022-07-03',
        //     'vehicle_unit' => 'Komatsu',
        //     'identify' => 'EX-01',
        //     'operator' => 'Sudirman',
        //     'type_unit' => 'PC 200',
        //     'hm_start' => '1030.8',
        //     'hm_finish' => '1042.0',
        //     'hm_total' => '12.2',
        //     'activity' => 'Clean up & Stripping OB',
        //     'location' => 'PIT - 1',
        //     'start' => '2022-07-06 12:42:59',
        //     'finish' => '2022-07-06 14:20:15',
        //     'users' => 'ADMIN',
        //     'device' => 'ANDROID AP',
        //     'server' => 'ONLINE',
        // ]);

        // Hourmeter::create([
        //     'id_hm' => 'HM22730001',
        //     'date' => '2022-07-03',
        //     'vehicle_unit' => 'Komatsu',
        //     'identify' => 'EX-01',
        //     'operator' => 'Sudirman',
        //     'type_unit' => 'PC 200',
        //     'hm_start' => '1030.8',
        //     'hm_finish' => '1042.0',
        //     'hm_total' => '12.2',
        //     'activity' => 'Clean up & Stripping OB',
        //     'location' => 'PIT - 1',
        //     'start' => '2022-07-06 12:42:59',
        //     'finish' => '2022-07-06 14:20:15',
        //     'users' => 'ADMIN',
        //     'device' => 'ANDROID AP',
        //     'server' => 'ONLINE',
        // ]);

        // Hourmeter::create([
        //     'id_hm' => 'HM22730001',
        //     'date' => '2022-07-03',
        //     'vehicle_unit' => 'Komatsu',
        //     'identify' => 'EX-02',
        //     'operator' => 'Sudirman',
        //     'type_unit' => 'PC 200',
        //     'hm_start' => '1030.8',
        //     'hm_finish' => '1042.0',
        //     'hm_total' => '12.2',
        //     'activity' => 'Clean up & Stripping OB',
        //     'location' => 'PIT - 1',
        //     'start' => '2022-07-06 12:42:59',
        //     'finish' => '2022-07-06 14:20:15',
        //     'users' => 'ADMIN',
        //     'device' => 'ANDROID AP',
        //     'server' => 'ONLINE',
        // ]);

        // Hourmeter::create([
        //     'id_hm' => 'HM22730001',
        //     'date' => '2022-07-03',
        //     'vehicle_unit' => 'Komatsu',
        //     'identify' => 'EX-02',
        //     'operator' => 'Sudirman',
        //     'type_unit' => 'PC 200',
        //     'hm_start' => '1030.8',
        //     'hm_finish' => '1042.0',
        //     'hm_total' => '12.2',
        //     'activity' => 'Clean up & Stripping OB',
        //     'location' => 'PIT - 1',
        //     'start' => '2022-07-06 12:42:59',
        //     'finish' => '2022-07-06 14:20:15',
        //     'users' => 'ADMIN',
        //     'device' => 'ANDROID AP',
        //     'server' => 'ONLINE',
        // ]);

        // Hourmeter::create([
        //     'id_hm' => 'HM22730001',
        //     'date' => '2022-07-03',
        //     'vehicle_unit' => 'Komatsu',
        //     'identify' => 'EX-03',
        //     'operator' => 'Sudirman',
        //     'type_unit' => 'PC 200',
        //     'hm_start' => '1030.8',
        //     'hm_finish' => '1042.0',
        //     'hm_total' => '12.2',
        //     'activity' => 'Clean up & Stripping OB',
        //     'location' => 'PIT - 1',
        //     'start' => '2022-07-06 12:42:59',
        //     'finish' => '2022-07-06 14:20:15',
        //     'users' => 'ADMIN',
        //     'device' => 'ANDROID AP',
        //     'server' => 'ONLINE',
        // ]);

        // Hourmeter::create([
        //     'id_hm' => 'HM22730001',
        //     'date' => '2022-07-03',
        //     'vehicle_unit' => 'Komatsu',
        //     'identify' => 'EX-03',
        //     'operator' => 'Sudirman',
        //     'type_unit' => 'PC 200',
        //     'hm_start' => '1030.8',
        //     'hm_finish' => '1042.0',
        //     'hm_total' => '12.2',
        //     'activity' => 'Clean up & Stripping OB',
        //     'location' => 'PIT - 1',
        //     'start' => '2022-07-06 12:42:59',
        //     'finish' => '2022-07-06 14:20:15',
        //     'users' => 'ADMIN',
        //     'device' => 'ANDROID AP',
        //     'server' => 'ONLINE',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629003',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-1',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629004',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-1',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629005',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-1',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629006',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-1',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629007',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-1',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629008',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-1',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629009',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-2',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629010',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-2',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629011',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-2',
        // ]);

        // Ritase::create([
        //     'id_ritase' => 'RIT-220629012',
        //     'departure_ts' => '2022-06-29 17:44:00',
        //     'arrival_ts' => '2022-06-29 18:44:00',
        //     'identify' => 'DT-03',
        //     'model_unit' => 'PC200',
        //     'operator' => 'UDIN',
        //     'material' => 'ORE',
        //     'departure_location' => 'PIT - 1',
        //     'arrival_location' => 'STOCKPILE KOLONO',
        //     'bucket' => '10',
        //     'type_activity' => 'HAULING',
        //     'origin' => 'PIT - 2',
        //     'id_form' => '0001',
        //     'id_barg' => 'BARG-2',
        // ]);

        // Stock_dom::create([
        //     'id_dom' => 'dome-22062901',
        //     'date' => '2022-07-17',
        //     'code_sample' => 'SM-01',
        //     'id_location' => 'loc-1001',
        //     'location' => 'PIT - 1',
        //     'total_incrament' => '20',
        //     'bucket' => '14',
        //     'volume_mt' => '11.2',
        //     'ni' => '1.9',
        //     'fe' => '22',
        //     'flag_code' => 'test',
        //     'device' => 'laptop',
        //     'users' => 'admin',
        //     'server' => 'ONLINE',
        // ]);

        // Stock_dom::create([
        //     'id_dom' => 'dome-22062902',
        //     'date' => '2022-07-17',
        //     'code_sample' => 'SM-02',
        //     'id_location' => 'loc-1001',
        //     'location' => 'PIT - 1',
        //     'total_incrament' => '20',
        //     'bucket' => '14',
        //     'volume_mt' => '11.2',
        //     'ni' => '0',
        //     'fe' => '0',
        //     'flag_code' => 'test',
        //     'device' => 'laptop',
        //     'users' => 'admin',
        //     'server' => 'ONLINE',
        // ]);

        // Stock_dom::create([
        //     'id_dom' => 'dome-22062903',
        //     'date' => '2022-07-17',
        //     'code_sample' => 'SM-03',
        //     'id_location' => 'loc-1001',
        //     'location' => 'PIT - 1',
        //     'total_incrament' => '20',
        //     'bucket' => '14',
        //     'volume_mt' => '11.2',
        //     'ni' => '0',
        //     'fe' => '0',
        //     'flag_code' => 'test',
        //     'device' => 'laptop',
        //     'users' => 'admin',
        //     'server' => 'ONLINE',
        // ]);

        // Stock_dom::create([
        //     'id_dom' => 'dome-22062904',
        //     'date' => '2022-07-17',
        //     'code_sample' => 'SM-04',
        //     'id_location' => 'loc-1001',
        //     'location' => 'PIT - 1',
        //     'total_incrament' => '20',
        //     'bucket' => '14',
        //     'volume_mt' => '11.2',
        //     'ni' => '0',
        //     'fe' => '0',
        //     'flag_code' => 'test',
        //     'device' => 'laptop',
        //     'users' => 'admin',
        //     'server' => 'ONLINE',
        // ]);

        // Stock_dom::create([
        //     'id_dom' => 'dome-22062905',
        //     'date' => '2022-07-17',
        //     'code_sample' => 'SM-05',
        //     'id_location' => 'loc-1001',
        //     'location' => 'PIT - 1',
        //     'total_incrament' => '20',
        //     'bucket' => '14',
        //     'volume_mt' => '11.2',
        //     'ni' => '0',
        //     'fe' => '0',
        //     'flag_code' => 'test',
        //     'device' => 'laptop',
        //     'users' => 'admin',
        //     'server' => 'ONLINE',
        // ]);

        // Vendor::create([
        //     'id_vendor' => 'ven_1001',
        //     'vendor' => 'CV NILAM BASTEM MUSTADIR',
        //     'address' => 'Jl, Paccerakan Desa,Tarramatekken Kab,Palopo',
        //     'pic_vendor' => 'Salmon Sewang',
        //     'type_vendor' => 'Excavator',
        //     'name_product' => 'Excavator Sany SY 215c',
        //     'contract' => 'Hour Meter',
        //     'contract_agreement' => '200 jam',
        //     'qty' => '2',
        //     'amount' => '55000000',
        //     'total_amount' => '110000000',
        //     'start_days' => '2022-08-28',
        //     'end_days' => '2022-09-28',
        //     'status' => 'ACTIVE',
        //     'payment' => null,
        //     'path' => null,
        // ]);

        // Vendor::create([
        //     'id_vendor' => 'ven_1002',
        //     'vendor' => 'CV ADHI',
        //     'address' => 'Jl, Paccerakan Desa,Tarramatekken Kab,Palopo',
        //     'pic_vendor' => 'Adhi',
        //     'type_vendor' => 'Dump Truck',
        //     'name_product' => 'Hino 500',
        //     'contract' => 'Ritase',
        //     'contract_agreement' => 'Rp 500.000 / per ritase',
        //     'qty' => '5',
        //     'amount' => '500000',
        //     'total_amount' => null,
        //     'start_days' => '2022-08-28',
        //     'end_days' => '2022-09-28',
        //     'status' => 'EXPIRED',
        //     'payment' => null,
        //     'path' => null,
        // ]);

        // Vendor::create([
        //     'id_vendor' => 'ven_1003',
        //     'vendor' => 'WAHYUDIN',
        //     'address' => 'Desa Kolono',
        //     'pic_vendor' => 'Wahyudin',
        //     'type_vendor' => 'Land',
        //     'name_product' => 'Lahan PIT-3',
        //     'contract' => 'Expired Days',
        //     'contract_agreement' => 'Royalty $1 per ton',
        //     'qty' => null,
        //     'amount' => '14500',
        //     'total_amount' => null,
        //     'start_days' => '2022-08-28',
        //     'end_days' => '2022-09-28',
        //     'status' => 'ACTIVE',
        //     'payment' => 'PAID',
        //     'path' => null,
        // ]);
    }
}
