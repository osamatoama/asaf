<?php

namespace Database\Seeders;

use App\Models\Gender;
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
        $gendersCount = Gender::count();

        if ($gendersCount <= 0) {
            $this->call(GenderTableSeeder::class);
        }

        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        $now = now();
        Product::insert([
            [
                'gender_id'         => Gender::UNISEX_ID,
                'name'              => 'عطر وايلد كولت',
                'url'               => 'https://3saf.com/ar/Wll/p1370701860',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/iGve0Pnb6ZrG9u2vhJ0VghdbWWArqe3pcHa62CzL.jpg',
                'description'       => 'هنا نقدم لك عطر وايلد كولت لنجعل جميع الأضواء حولك، وتكون به شخصية واثقة متفردة عن الجميع، تكشف تركيبته عن روح تختار تسعى لأن تثبت نفسها.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::MALE_ID,
                'name'              => 'عطر وايلد سموكي',
                'url'               => 'https://3saf.com/ar/smok/p95857200',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/ACHntxWPn7tKOFK2Tqvalm7LpdLLy3d3jwZ33Ojj.jpg',
                'description'       => 'عطر يتميز برائحة مدخنة تصنع منك شخصية تعشق التقدم والتحليّ بالثقة أمام الجميع، تكشف تركيبته عن روح تختار تسعى لأن تثبت نفسها.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::MALE_ID,
                'name'              => 'عطر وايلد توباكو',
                'url'               => 'https://3saf.com/ar/TOBA/p657617994',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/R00zIqtrRsKGfMM2wsXGm8ykF35S47mhQLn4jfpF.jpg',
                'description'       => 'عطر وايلد كولت توباكو للشخصيات التي تسعى أن تكون الفخامة عنوانها. رائحة تبغية تصنع منك شخصية مميزة مختلفة عن الجميع، تكشف تركيبته عن روح تختار تسعى لأن تثبت نفسها.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::UNISEX_ID,
                'name'              => 'عطر وايلد سبورت',
                'url'               => 'https://3saf.com/ar/wisp/p1411590135',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/QftKlM6DOwP0QhyYj8YY1eCW8hsXedi4X4bVyQjX.jpg',
                'description'       => 'عطر وايلد كولت سبورت عطر الشخصية المُنفردة والواثقة. تكشف تركيبته عن شخصية رياضية منفردة ومشعة، وعن روح وطاقة إيجابية تختار تسعى لأن تثبت نفسها. تم استوحى اسم العطر من التوحش حيث انه يُشعر الآخرين بوجودك في الحلبة حتى لو لم تتكلم اطلاقًا.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::FEMALE_ID,
                'name'              => 'عطر وانتد ليدي',
                'url'               => 'https://3saf.com/ar/Fran/p1302622137',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/i62LcCO26CTqZL9JTwJqHeKYkicSVGtmSGrieQTJ.png',
                'description'       => 'صنع العطر لتكون به الأنثى محور الانتباه، وتضفي أثر حميمي على هالتها الفاتنة، لتتفتح زهور العطر مع كل من تسعى لأن تكون الجاذبية هي شخصيتها.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::FEMALE_ID,
                'name'              => 'عطر ليدي MMM',
                'url'               => 'https://3saf.com/ar/WIN/p1745594089',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/m0cYejLOI9i13WatgsQnvzt4ZeuF0yX0xJBpwV7B.jpg',
                'description'       => 'أتى العطر ليكون جزء من الأنثى الرقيقة، رائحة زهرية أنثوية تتميز بالإغراء، ولإمرأة تتحلى شخصيتها بالفضول المطلق.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::FEMALE_ID,
                'name'              => 'عطر ليدي 12ِAM',
                'url'               => 'https://3saf.com/ar/WIN/p1624060733',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/wFmghwQELPY3FXnNeH4uX1kei6NgEmb4XxSBXr7W.jpg',
                'description'       => 'صُمم ليكون عطرك النسائي الأفضل، حيث تتفتح نفحات رائحته في ليلة حالكة الظلام لتكون به الأنثى الرقيقة في أبهى حلة.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::UNISEX_ID,
                'name'              => 'عطر ايقو',
                'url'               => 'https://3saf.com/ar/igo/p2025988140',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/TQTvL4ozzESLhwHkL7sNGY5Z7YvxjQ8VdSuskaD5.jpg',
                'description'       => 'نقدم عطر ايقو الشخصيات التي لطالما جعلت الكبرياء دافع طموحاتها، عطر ايقو هو نفحات من الكبرياء الأنيق الذي يتزيّن بك ويجعلك شخصية استثنائية في عالمك الخاص.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::UNISEX_ID,
                'name'              => 'عطر نوماد',
                'url'               => 'https://3saf.com/ar/nom/p558544826',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/28MfdnnG19OlSr26L2NsUkvB1Yt5GTYZJwlpYZoN.jpg',
                'description'       => 'نقدم عطر نوماد إلى عشاق الحضور الطاغي، تركيبة العطر تعطي شعور باللامحدودية والحضور الطاغي.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::UNISEX_ID,
                'name'              => 'عطر جريس اريك',
                'url'               => 'https://3saf.com/ar/GR/p1491376332',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/7WaH5HrtcWuqyMK6bPXM7Y6Q9folYZUUu7QQUWl9.jpg',
                'description'       => 'أكثر من مجرد عطر، نقدم لك جريس ايريك، تعبير شمي عن الاحتفالات والأيام الصاخبة المميزة في حياتك!',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::FEMALE_ID,
                'name'              => 'عطر بينك ليدي',
                'url'               => 'https://3saf.com/ar/wli/p726698752',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/PbC4OlSEhSL9A7WIlbQnwSI5PwDrtyAWi1ag36qj.jpg',
                'description'       => 'نقدم لك بينك ليدي، عطر يمتلك أثر حميمي أنثوي يدوم طويلاً، يتميز بنفحات مثيرة لا نهاية لها تجمع بين طابع رومانسي وشقي.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::FEMALE_ID,
                'name'              => 'عطر مس ساكورا',
                'url'               => 'https://3saf.com/ar/s0d/p71799739',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/cOnw6s2S4wGmzTcFWKtFkRxoaFgWmyr5lbuCh3RG.jpg',
                'description'       => 'في عسَّاف نقدم لك مس ساكورا، عطر قادر على أن يترجم مشاعرك، بنفحات من أزهار الكرز.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'gender_id'         => Gender::FEMALE_ID,
                'name'              => 'عطر يوني سبريت',
                'url'               => 'https://3saf.com/ar/yon/p427598918',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/TLs7uk9aUdVHLbPcUxH9U0FU8yFqKHmhbVticXru.jpg',
                'description'       => 'عطر صُمم للشخصيات المتألقة التي تسعى لتنثر الإبداع في كل مكان تخطو فيه.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ]);
    }
}
