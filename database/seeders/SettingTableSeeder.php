<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => 'Pemesanan Tiket Konser',
            'email' => 'pemesanantiketkonser@gmail.com',
            'address' => 'Bandung, Jawa Barat Indonesia',
            'phone' => '6281234624572',
            'meta_keyword' => 'Pemesanan Tiket Konser',
            'meta_description' => 'Pemesanan Tiket Konser adalah situs web informasi mengenai  pemesanan tiket konser',
            'author' => 'Admin',
            'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsa, voluptatem! Molestias adipisci cum, excepturi officia quidem similique id impedit culpa animi debitis? Magnam aliquam a facere repellendus nisi corrupti amet tempora molestiae dolorum odit nam, nobis voluptatem impedit consequuntur dolorem dolore. Quis impedit eligendi quas quod vel consequuntur placeat doloremque rem itaque necessitatibus modi, suscipit iusto id quos velit autem nam, blanditiis quo quia quae error totam voluptatibus! Quibusdam rerum sunt pariatur maxime exercitationem! Reiciendis repellat, rem quidem at tenetur harum atque quaerat sequi ratione neque nulla iste ipsa modi libero accusantium? Sed cumque error tenetur officiis magni quis suscipit.'
        ]);
    }
}
