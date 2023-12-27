<?php

return [
    'accepted'                       => 'يجب قبول  :attribute.',
    'active_url'                     => 'هذا  :attribute  ليس رابط صالحا.',
    'after'                          => 'يجب أن يكون :attribute تاريخا بعد :date.',
    'after_or_equal'                 => 'يجب أن يكون :attribute تاريخا بعد أو يساوي :date.',
    'alpha'                          => 'قد يحتوي :attribute على أحرف فقط.',
    'alpha_dash'                     => 'قد تحتوي ال :attribute  على أحرف وأرقام وشرطات فقط.',
    'alpha_num'                      => 'قد تحتوي ال :attribute  على أحرف وأرقام  فقط.',
    'latin'                          => ':attribute قد تحتوي فقط على أحرف أبجدية لاتينية أساسية ISO.',
    'latin_dash_space'               => ':attribute  قد تحتوي فقط ISO الأساسية الأبجدية اللاتينية الحروف والأرقام، شرطات، الواصلات والمسافات.',
    'array'                          => ':attribute  يجب ان تكون مصفوفة',
    'before'                         => 'يجب أن يكون :attribute تاريخا قبل :date.',
    'before_or_equal'                => 'يجب أن يكون :attribute تاريخا قبل أو يساوي :date.',
    'between'                        => [
        'numeric' => 'يجب أن يكون :attribute بين  :min و  :max  .',
        'file'    => 'يجب أن يكون :attribute بين  :min و  :max  كيلو بايت.',
        'string'  => 'يجب أن يكون :attribute بين  :min و  :max  حرف.',
        'array'   => 'يجب أن يكون :attribute بين  :min و  :max  نوع.',
    ],
    'boolean'                        => 'يجب أن يكون :attribute صح او خطأ',
    'confirmed'                      => 'تأكيد :attribute لا يطابق.',
    'date'                           => ':attribute  ليست تاريخا صالحا.',
    'date_equals'                    => ':attribute يجب ان تكون مساوية ل  :date.',
    'date_format'                    => ':attribute لايتطابق مع الصيغة :format.',
    'different'                      => 'يجب أن يختلف  :attribute عن :الاخرين.',
    'digits'                         => ':attribute يجب ان يكون :digits ارقام.',
    'digits_between'                 => 'هذايجب ان يكون بين :min و :max ارقام.',
    'dimensions'                     => 'هذه :attribute ذات ابعاد خاطئة.',
    'distinct'                       => 'هذا :attribute الحقل موجود مسبقا',
    'email'                          => 'هذا :attribute يجب ان يكون بريد الكتروني صالح',
    'ends_with'                      => ':attribute يجب أن ينتهي بواحد مما يلي: :قيم.',
    'exists'                         => 'الحقل المختار :attribute غير صالح',
    'file'                           => 'هذا :attribute يجب ان يكون ملف',
    'filled'                         => 'هذا :attribute الحقل مطلوب.',
    'gt'                             => [
        'numeric' => 'يجب أن يكون :attribute أكبر من :value  .',
        'file'    => 'يجب أن يكون :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أكبر من :value  .',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من: value عناصر .',
    ],
    'gte'                            => [
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي  :value.',
        'file'    => ':attribute يجب أن يكون أكبر من أو يساوي  :value كيلوبايت.',
        'string'  => ':attribute يجب أن يكون أكبر من أو يساوي :value احرف.',
        'array'   => ':attribute يجب ان يملك  :value من العناصر أو أكثر.',
    ],
    'image'                          => ':attribute يجب ان تكون صورة',
    'in'                             => 'قيمة  :attribute المختارة غير صالحة.',
    'in_array'                       => 'حقل :attribute غير موجود فى :other.',
    'integer'                        => 'حقل :attribute يجب ان يكون رقم.',
    'ip'                             => ':attribute يجب ان يكون عنوان IP صالح.',
    'ipv4'                           => ':attribute يجب أن يكون عنوان IPv4 صالحًا .',
    'ipv6'                           => ':attribute يجب أن يكون عنوان IPv6 صالحًا .',
    'json'                           => ':attribute  يجب ان يكون في صيغة  JSON.',
    'lt'                             => [
        'numeric' => ':attribute  يجب أن يكون أقل من  :value.',
        'file'    => ':attribute  يجب أن يكون أقل من :value كيلوبايت.',
        'string'  => ':attribute  يجب أن يكون أقل من  :value احرف.',
        'array'   => ':attribute يجب أن يكون أقل من  :value العناصر.',
    ],
    'lte'                            => [
        'numeric' => ':attribute يجب أن يكون أصغر من أو يساوي  :value.',
        'file'    => ':attribute يجب أن يكون أصغر من أو يساوي  :value كيلوبايت.',
        'string'  => ':attribute يجب أن يكون أصغر من أو يساوي  :value احرف.',
        'array'   => ':attribute يجب ألا يحتوي على أكثر من  :value العناصر.',
    ],
    'max'                            => [
        'numeric' => ':attribute  قد لا يكون أكبر من  :max.',
        'file'    => ':attribute قد لا يكون أكبر من  :max كيلوبايت.',
        'string'  => ':attribute  قد لا يكون أكبر من  :max احرف.',
        'array'   => ':attribute قد لا يكون أكثر من  :max العناصر.',
    ],
    'mimes'                          => ':attribute يجب أن يكون ملف  type: :values.',
    'mimetypes'                      => ':attribute يجب أن يكون ملف  type: :values.',
    'min'                            => [
        'numeric' => ':attribute لا بد أن يكون على الأقل  :min.',
        'file'    => ':attribute لا بد أن يكون على الأقل :min كيلوبايت.',
        'string'  => ':attribute لا بد أن يكون على الأقل :min احرف.',
        'array'   => ':attribute يجب أن يكون على الأقل  :min items.',
    ],
    'not_in'                         => 'المختار :attribute غير صالح .',
    'not_regex'                      => ':attribute شكل غير صالح.',
    'numeric'                        => ':attribute يجب أن يكون رقما.',
    'password'                       => 'كلمة مرور خاطئة',
    'present'                        => ':attribute يجب أن يكون الحقل الحالي.',
    'regex'                          => ':attribute التنسيق غير صالح.',
    'required'                       => 'حقل :attribute مطلوب',
    'required_if'                    => ':attribute الحقل مطلوب عندما  :other يكون :value.',
    'required_unless'                => ':attribute الحقل مطلوب ما لم يكن :other في داخل  :values.',
    'required_with'                  => ':attribute الحقل مطلوب عندما  :values حاضر.',
    'required_with_all'              => ':attribute الحقل مطلوب عندما :values حاضر.',
    'required_without'               => ':attribute الحقل مطلوب عندما :values غير موجود.',
    'required_without_all'           => ':attribute الحقل مطلوبًا في حالة عدم وجود أي من  :values حاضر.',
    'same'                           => ':attribute و :other يجب أن تتطابق.',
    'size'                           => [
        'numeric' => ':attribute يجب أن يكون  :size.',
        'file'    => ':attribute يجب أن يكون  :size كيلوبايت.',
        'string'  => ':attribute يجب أن يكون  :size احرف.',
        'array'   => ':attribute يجب أن يحتوي على :size العناصر.',
    ],
    'starts_with'                    => ':attribute يجب أن تبدأ بأحد  following: :values.',
    'string'                         => ':attribute يجب ان يكون احرف',
    'timezone'                       => ':attribute يجب أن تكون منطقة صالحة.',
    'unique'                         => ':attribute مأخوذ من قبل',
    'uploaded'                       => 'فشل التحميل :attribute .',
    'url'                            => ':attribute نوعة غير صحيح',
    'uuid'                           => ':attribute يجب أن يكون UUID صالحًا.',
    'custom'                         => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'reserved_word'                  => ':attribute  يحتوي على كلمة محجوزة',
    'dont_allow_first_letter_number' => 'حقل الادخال \":input\" لايمكن ان يكون اول خانة رقم',
    'exceeds_maximum_number'         => ' :attribute وصل الحد الاقصى للمودل',
    'db_column'                      => ' :attribute يمكن ان يحتوى فقط على ترميز الايزو للاحراف اللاتينية وارقام وعلامة الداش ولايمكن ان يبدأ برقم',
    'attributes'                     => [
        'email'                   => 'البريد الإلكتروني',
        'name'                    => 'الاسم',
        'phone'                   => 'الهاتف',
        'city_id'                 => 'المدينة',
        'address'                 => 'العنوان',
        'title_tag_ar'            => 'وسم العنوان بالعربية',
        'title_tag_en'            => 'وسم العنوان بالانجليزية',
        'description_ar'          => 'الوصف بالعربية',
        'description_en'          => 'الوصف بالانجليزية',
        'meta_description_ar'     => 'ميتا الوصف بالعربية',
        'meta_description_en'     => 'ميتا الوصف بالانجليزية',
        'google_product_category' => 'تصنيف جوجل للمنتج',
        'name_ar'                 => 'الاسم بالعربية',
        'name_en'                 => 'الاسم بالانجليزية',
        'from'                    => 'من',
        'to'                      => 'الي',
    ],
    'register_image'                 => ' :name jpg, png, jpeg. يجب ان تكون صورة من نوع ',
    'phone'                          => 'رقم الهاتف غير صالح',

];
