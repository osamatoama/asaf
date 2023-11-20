<?php

namespace Database\Seeders;

use App\Models\Category;
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
                'name'              => 'كوبن توباكو',
                'url'               => 'https://laverne.com/ar/jYqGpy',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/jFqbTiFmPgQnUBhqGV7PCUk6ttugcMhGTB2PFW8V.png',
                'category_url'      => 'https://laverne.com/category/yajOz',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'بيانكو',
                'url'               => 'https://laverne.com/ar/qWQYyO',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/7eFeWDM676ldtdJKRc8cL1E2PPFmH8u9Lyayv5UQ.png',
                'category_url'      => 'https://laverne.com/category/yajOz',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'توباكو',
                'url'               => 'https://laverne.com/ar/oOKrVB',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/D5a9jhLheYCtTcCw6j8R2JjW0nOcDmc6qCgEh3ZN.png',
                'category_url'      => 'https://laverne.com/category/yajOz',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'فانتوم',
                'url'               => 'https://laverne.com/ar/xjojVg',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/AnEtsjhsMyGfRqOYWB1Qb1kwQ3P7d5RMOfULeO6w.png',
                'category_url'      => 'https://laverne.com/category/yajOz',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'آي واز هير',
                'url'               => 'https://laverne.com/ar/BAylBR',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/lXwLU77zAr70xR2s9ondvTb7LZV7aGK018R2jIZa.png',
                'category_url'      => 'https://laverne.com/category/yajOz',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'صحارى',
                'url'               => 'https://laverne.com/ar/jZampKg',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/AbxIPQ2GWocwd3LANCIQlx4WQCK02yxjjzI8VTJC.png',
                'category_url'      => 'https://laverne.com/category/yajOz',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'ميموري',
                'url'               => 'https://laverne.com/ar/ZYRaoPp',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/T8KLDWwVABwCil8f5fD1qpcPeVguL0uSzwcENoEV.png',
                'category_url'      => 'https://laverne.com/category/yajOz',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'بوكيه',
                'url'               => 'https://laverne.com/ar/YgYpDrW',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/nR3OiRKk8CMzlxSsC260On8YiD9J621l4tI4t6xp.jpg',
                'category_url'      => 'https://laverne.com/category/yajOz',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'لومينوس',
                'url'               => 'https://laverne.com/ar/pnxdmA',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/TqtuO7J3YtaLmZa7AEbdTf0fumZJxfCbbPttnJEp.png',
                'category_url'      => 'https://laverne.com/category/aewqrD',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'اللور',
                'url'               => 'https://laverne.com/ar/lGboNdB',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/EzwvhJsRqHUHnIWgjGzb8JiPrLOdQrAWlr2rU3rA.png',
                'category_url'      => 'https://laverne.com/category/aewqrD',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'فوربدن',
                'url'               => 'https://laverne.com/ar/onQYNGp',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/ZJOhtf7cwc48m9eUeaVfsPjMc6BHbwmnqgho661Y.png',
                'category_url'      => 'https://laverne.com/category/aewqrD',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'مس لافيرن',
                'url'               => 'https://laverne.com/ar/gZQqbXv',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/JUkZ8xp7QwgAiyMy49tWpYMiMdQEaLhUGUIHxn1y.png',
                'category_url'      => 'https://laverne.com/category/aewqrD',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'ليدي روز',
                'url'               => 'https://laverne.com/ar/YvGRxn',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/bGlU1HWwuYhv80C7D2H8g7Ll9VevfZwdEZl3LJxf.jpg',
                'category_url'      => 'https://laverne.com/category/aewqrD',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'مسك باتشولي',
                'url'               => 'https://laverne.com/ar/eDQqGR',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/mw0UVZkyYrxq6X1RympaOx3VsGgSZz12lbUas6lf.png',
                'category_url'      => 'https://laverne.com/category/aewqrD',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'بلانكا',
                'url'               => 'https://laverne.com/ar/AzPnRgp',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/n35uNzVxyOobcZzf1wZVqB4lPMnmOhyWpfvbFiCp.png',
                'category_url'      => 'https://laverne.com/category/aewqrD',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'بلو لافيرن بخور- 200 مل',
                'url'               => 'https://laverne.com/ar/KjjRvDy',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/zB5h8hq1UviMXhMLHY9KAxYOGFJjmArkoFCCvnSR.png',
                'category_url'      => 'https://laverne.com/ar/category/xvVZqY',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'بلو لافيرن',
                'url'               => 'https://laverne.com/ar/VwYOxW',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/TPKRh7vnade10W7pcjTXBat5dSPzvrewOM7cYJ4R.png',
                'category_url'      => 'https://laverne.com/ar/category/xvVZqY',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'بلو لافيرن سبورت - 200 مل',
                'url'               => 'https://laverne.com/ar/bRjdjqx',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/QRRp8elvrtBEzr3hvsNxhjOnrPcVIDAtMz5pRLIb.png',
                'category_url'      => 'https://laverne.com/ar/category/xvVZqY',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'بلو لافيرن تايقر',
                'url'               => 'https://laverne.com/ar/zvzbXNE',
                'image_url'         => 'https://cdn.salla.sa/XzOPD/dX4J7y8JPRdRFv2qZvuFRHM3mZxWLbDscMsJjK9j.png',
                'category_url'      => 'https://laverne.com/ar/category/xvVZqY',
                'created_at'        => $now,
                'updated_at'        => $now,
            ]
        ]);
    }
}
