<?php

namespace Database\Seeders;

use App\Models\Product;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        $now = now();
        Product::insert([
            [
                'name'              => 'عطر وايلد كولت - 200 مل', // 7
                'url'               => 'https://3saf.com/ar/Wll/p1370701860',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/iGve0Pnb6ZrG9u2vhJ0VghdbWWArqe3pcHa62CzL.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر نوماد 200 مل', // 7
                'url'               => 'https://3saf.com/ar/nom/p558544826',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/28MfdnnG19OlSr26L2NsUkvB1Yt5GTYZJwlpYZoN.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر مس ساكورا - 200 مل', // 0
                'url'               => 'https://3saf.com/ar/s0d/p71799739',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/cOnw6s2S4wGmzTcFWKtFkRxoaFgWmyr5lbuCh3RG.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر يوني سبريت -200مل', // 3
                'url'               => 'https://3saf.com/ar/yon/p427598918',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/TLs7uk9aUdVHLbPcUxH9U0FU8yFqKHmhbVticXru.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر بنك ليدي - 200مل', // 3
                'url'               => 'https://3saf.com/ar/wli/p726698752',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/PbC4OlSEhSL9A7WIlbQnwSI5PwDrtyAWi1ag36qj.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر توباكو باشا', // 5
                'url'               => 'https://3saf.com/ar/RUFRD/p1353979568',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/DByJYgFtUHr4Vcmxrsrh4FLS3AV0vp09Uh9mVKQ4.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر روفان بلو سبورت', // 5
                'url'               => 'https://3saf.com/ar/RU/p714740184',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/RsNMOVuxNemQbIf8VEkB2XL6M80boCWeEzlq8649.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر ليدي', // 4
                'url'               => 'https://3saf.com/ar/lad/p987595079',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/K8y388R3ovjxGLqY4S6Xsd2O6YeSJbF5mfgqjFPj.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر جريس اريك - 200مل', // 4
                'url'               => 'https://3saf.com/ar/GR/p1491376332',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/7WaH5HrtcWuqyMK6bPXM7Y6Q9folYZUUu7QQUWl9.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر الكبرياء والغرور 200 مل', // 7
                'url'               => 'https://3saf.com/ar/igo/p2025988140',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/TQTvL4ozzESLhwHkL7sNGY5Z7YvxjQ8VdSuskaD5.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر وايلد سموكي 200 مل', // 5
                'url'               => 'https://3saf.com/ar/smok/p95857200',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/ACHntxWPn7tKOFK2Tqvalm7LpdLLy3d3jwZ33Ojj.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر كنق', // 2
                'url'               => 'https://3saf.com/ar/KI/p513693717',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/lL8Y8ddWNJ8UQV95Y9w1u5bBMLmyb3VhB5j4pAIv.png',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر سماء وبحر', // 1
                'url'               => 'https://3saf.com/ar/SA/p1467822237',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/VXNBd7KDoD1NooTOmAYTX8oDzuoFggujS8Kg9plF.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر فرانكل', // 6
                'url'               => 'https://3saf.com/ar/Frankl/p1479518088',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/czEoM2IAjt85dktQkU3vp0W5YnlXvHgymB8d0o0n.png',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر نوبل 200 مل', // 8
                'url'               => 'https://3saf.com/ar/NOB/p1362089002',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/p2SRIB0xocAVR8zm01z3gDAk3SqJWK9tHX0PXbdD.jpg',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ]);
    }
}
