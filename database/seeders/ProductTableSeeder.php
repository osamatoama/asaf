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
                'description'       => 'هنا نقدم لك عطر وايلد كولت لنجعل جميع الأضواء حولك، وتكون به شخصية واثقة متفردة عن الجميع، تكشف تركيبته عن روح تختار تسعى لأن تثبت نفسها.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر نوماد 200 مل', // 7
                'url'               => 'https://3saf.com/ar/nom/p558544826',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/28MfdnnG19OlSr26L2NsUkvB1Yt5GTYZJwlpYZoN.jpg',
                'description'       => 'نقدم عطر ايقو إلى عشاق الحضور الطاغي، تركيبة العطر تعطي شعور باللامحدودية والحضور الطاغي.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر مس ساكورا - 200 مل', // 0
                'url'               => 'https://3saf.com/ar/s0d/p71799739',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/cOnw6s2S4wGmzTcFWKtFkRxoaFgWmyr5lbuCh3RG.jpg',
                'description'       => 'في عسَّاف نقدم لك مس ساكورا، عطر قادر على أن يترجم مشاعرك، بنفحات من أزهار الكرز.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر يوني سبريت -200مل', // 3
                'url'               => 'https://3saf.com/ar/yon/p427598918',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/TLs7uk9aUdVHLbPcUxH9U0FU8yFqKHmhbVticXru.jpg',
                'description'       => 'عطر صُمم للشخصيات المتألقة التي تسعى لتنثر الإبداع في كل مكان تخطو فيه.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر بنك ليدي - 200مل', // 3
                'url'               => 'https://3saf.com/ar/wli/p726698752',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/PbC4OlSEhSL9A7WIlbQnwSI5PwDrtyAWi1ag36qj.jpg',
                'description'       => 'نقدم لك بينك ليدي، عطر يمتلك أثر حميمي انثوي يدوم طويلاً، يتميز بنفحات مثيرة لا نهاية لها تجمع بين طابع رومانسي وشقي.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر توباكو باشا', // 5
                'url'               => 'https://3saf.com/ar/RUFRD/p1353979568',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/DByJYgFtUHr4Vcmxrsrh4FLS3AV0vp09Uh9mVKQ4.jpg',
                'description'       => 'عطر عطر توباكو باشا للشخصيات التي تسعى أن تكون الفخامة عنوانها. رائحة تبغية تصنع منك شخصية مميزة مختلفة عن الجميع، تكشف تركيبته عن روح تختار تسعى لأن تثبت نفسها.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر روفان بلو سبورت', // 5
                'url'               => 'https://3saf.com/ar/RU/p714740184',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/RsNMOVuxNemQbIf8VEkB2XL6M80boCWeEzlq8649.jpg',
                'description'       => 'عطر روفان بلو سبورت عطر الشخصية المُنفردة والواثقة. تكشف تركيبته عن شخصية رياضية منفردة ومشعة، وعن روح وطاقة إيجابية تختار تسعى لأن تثبت نفسها. تم استوحى اسم العطر من التوحش حيث انه يُشعر الآخرين بوجودك في الحلبة حتى لو لم تتكلم اطلاقًا.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر ليدي', // 4
                'url'               => 'https://3saf.com/ar/lad/p987595079',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/K8y388R3ovjxGLqY4S6Xsd2O6YeSJbF5mfgqjFPj.jpg',
                'description'       => 'صنع العطر لتكون به الأنثى محور الانتباه، وتضفي أثر حميمي على هالتها الفاتنة، لتتفتح زهور العطر مع كل من تسعى لأن تكون الجاذبية هي شخصيتها. ',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر جريس اريك - 200مل', // 4
                'url'               => 'https://3saf.com/ar/GR/p1491376332',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/7WaH5HrtcWuqyMK6bPXM7Y6Q9folYZUUu7QQUWl9.jpg',
                'description'       => 'أكثر من مجرد عطر، نقدم لك قريس ايريك، تعبير شمي عن الاحتفالات والأيام الصاخبة المميزة في حياتك!',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر الكبرياء والغرور 200 مل', // 7
                'url'               => 'https://3saf.com/ar/igo/p2025988140',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/TQTvL4ozzESLhwHkL7sNGY5Z7YvxjQ8VdSuskaD5.jpg',
                'description'       => 'نقدم عطر ايقو الشخصيات التي لطالما جعلت الكبرياء دافع طموحاتها، عطر ايقو هو نفحات من الكبرياء الأنيق الذي يتزيّن بك ويجعلك شخصية استثنائية في عالمك الخاص.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر وايلد سموكي 200 مل', // 5
                'url'               => 'https://3saf.com/ar/smok/p95857200',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/ACHntxWPn7tKOFK2Tqvalm7LpdLLy3d3jwZ33Ojj.jpg',
                'description'       => 'عطر يتميز برائحة مدخنة تصنع منك شخصية تعشق التقدم والتحليّ بالثقة أمام الجميع، تكشف تركيبته عن روح تختار تسعى لأن تثبت نفسها.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر كنق', // 2
                'url'               => 'https://3saf.com/ar/KI/p513693717',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/lL8Y8ddWNJ8UQV95Y9w1u5bBMLmyb3VhB5j4pAIv.png',
                'description'       => 'عطر شرقي زهري للرجال، يحمل الطابع الفاخر والحضور القوي للملوك، ويرمز للخلود والبقاء في الذاكرة للأبد، في تركيبة مسببة للإدمان والرائحة تضفي السهولة والنبل على الأجواء الاحتفالية والمتناغمة للملكية.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر سماء وبحر', // 1
                'url'               => 'https://3saf.com/ar/SA/p1467822237',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/VXNBd7KDoD1NooTOmAYTX8oDzuoFggujS8Kg9plF.jpg',
                'description'       => 'عطر صُنع لأن يجعلك بين شامخًا نسمات البحر، مزيج من البرتقال والحمضيات المنوعة ليكون لك شخصيتك الشامخة أمام نفحات السماء ونسيم البحر. عطر البحر والسماء، عطر الشخصية الهادئة و الواقفة أمام الصِعَّاب',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر فرانكل', // 6
                'url'               => 'https://3saf.com/ar/Frankl/p1479518088',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/czEoM2IAjt85dktQkU3vp0W5YnlXvHgymB8d0o0n.png',
                'description'       => 'عطر فرانكل عطر الرجل الذي يضع القواعد ولا يعمد إلى كسرها. وتكشف تركيبته عن شخصية تفرض نفسها بالاستقلالية، وعن روح رجل يختار مصيره بنفسه.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'عطر نوبل 200 مل', // 8
                'url'               => 'https://3saf.com/ar/NOB/p1362089002',
                'image_url'         => 'https://cdn.salla.sa/yrlRO/p2SRIB0xocAVR8zm01z3gDAk3SqJWK9tHX0PXbdD.jpg',
                'description'       => 'اسمحي لنفسك بالانجراف في دوّامة عطر نوبل. يُعتبر ماء العطر هذا غنّي بشذا الأزهار المدهش، توازنٌ غير متوقّع يدهش الحواس باستمرار. مجموعة من الروائح، تدفئها خلاصة الفانيليا، وتبرز فيها خلاصة الياسمين الفريد والمتميّز وخلاصة السوسن، بشكلٍ أوضح. إنّه لتناغمٌ غامضٌ يبرز من خلال حدّة درجات المسك الأبيض.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ]);
    }
}
