<?php

use Illuminate\Database\Seeder;
use App\Governorate;
use App\City;
class CitiesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Governorate::create( [
            'id'=>1,
            'governorate_name'=>'القاهرة',
            'governorate_name_en'=>'Cairo'
        ] );

        Governorate::create( [
            'id'=>2,
            'governorate_name'=>'الجيزة',
            'governorate_name_en'=>'Giza'
        ] );

        Governorate::create( [
            'id'=>3,
            'governorate_name'=>'الأسكندرية',
            'governorate_name_en'=>'Alexandria'
        ] );

        Governorate::create( [
            'id'=>4,
            'governorate_name'=>'الدقهلية',
            'governorate_name_en'=>'Dakahlia'
        ] );

        Governorate::create( [
            'id'=>5,
            'governorate_name'=>'البحر الأحمر',
            'governorate_name_en'=>'Red Sea'
        ] );

        Governorate::create( [
            'id'=>6,
            'governorate_name'=>'البحيرة',
            'governorate_name_en'=>'Beheira'
        ] );

        Governorate::create( [
            'id'=>7,
            'governorate_name'=>'الفيوم',
            'governorate_name_en'=>'Fayoum'
        ] );

        Governorate::create( [
            'id'=>8,
            'governorate_name'=>'الغربية',
            'governorate_name_en'=>'Gharbiya'
        ] );

        Governorate::create( [
            'id'=>9,
            'governorate_name'=>'الإسماعلية',
            'governorate_name_en'=>'Ismailia'
        ] );

        Governorate::create( [
            'id'=>10,
            'governorate_name'=>'المنوفية',
            'governorate_name_en'=>'Monofia'
        ] );

        Governorate::create( [
            'id'=>11,
            'governorate_name'=>'المنيا',
            'governorate_name_en'=>'Minya'
        ] );

        Governorate::create( [
            'id'=>12,
            'governorate_name'=>'القليوبية',
            'governorate_name_en'=>'Qaliubiya'
        ] );

        Governorate::create( [
            'id'=>13,
            'governorate_name'=>'الوادي الجديد',
            'governorate_name_en'=>'New Valley'
        ] );

        Governorate::create( [
            'id'=>14,
            'governorate_name'=>'السويس',
            'governorate_name_en'=>'Suez'
        ] );

        Governorate::create( [
            'id'=>15,
            'governorate_name'=>'اسوان',
            'governorate_name_en'=>'Aswan'
        ] );

        Governorate::create( [
            'id'=>16,
            'governorate_name'=>'اسيوط',
            'governorate_name_en'=>'Assiut'
        ] );

        Governorate::create( [
            'id'=>17,
            'governorate_name'=>'بني سويف',
            'governorate_name_en'=>'Beni Suef'
        ] );

        Governorate::create( [
            'id'=>18,
            'governorate_name'=>'بورسعيد',
            'governorate_name_en'=>'Port Said'
        ] );

        Governorate::create( [
            'id'=>19,
            'governorate_name'=>'دمياط',
            'governorate_name_en'=>'Damietta'
        ] );

        Governorate::create( [
            'id'=>20,
            'governorate_name'=>'الشرقية',
            'governorate_name_en'=>'Sharkia'
        ] );

        Governorate::create( [
            'id'=>21,
            'governorate_name'=>'جنوب سيناء',
            'governorate_name_en'=>'South Sinai'
        ] );

        Governorate::create( [
            'id'=>22,
            'governorate_name'=>'كفر الشيخ',
            'governorate_name_en'=>'Kafr Al sheikh'
        ] );

        Governorate::create( [
            'id'=>23,
            'governorate_name'=>'مطروح',
            'governorate_name_en'=>'Matrouh'
        ] );

        Governorate::create( [
            'id'=>24,
            'governorate_name'=>'الأقصر',
            'governorate_name_en'=>'Luxor'
        ] );

        Governorate::create( [
            'id'=>25,
            'governorate_name'=>'قنا',
            'governorate_name_en'=>'Qena'
        ] );

        Governorate::create( [
            'id'=>26,
            'governorate_name'=>'شمال سيناء',
            'governorate_name_en'=>'North Sinai'
        ] );

        Governorate::create( [
            'id'=>27,
            'governorate_name'=>'سوهاج',
            'governorate_name_en'=>'Sohag'
        ] );

        City::create( [
            'id'=>1,
            'gov_id'=>1,
            'city_name'=>'القاهره',
            'city_name_en'=>'Cairo'
        ] );



        City::create( [
            'id'=>2,
            'gov_id'=>2,
            'city_name'=>'الجيزة',
            'city_name_en'=>'Giza'
        ] );



        City::create( [
            'id'=>3,
            'gov_id'=>2,
            'city_name'=>'السادس من أكتوبر',
            'city_name_en'=>'Sixth of October'
        ] );



        City::create( [
            'id'=>4,
            'gov_id'=>2,
            'city_name'=>'الشيخ زايد\n',
            'city_name_en'=>'Cheikh Zayed'
        ] );



        City::create( [
            'id'=>5,
            'gov_id'=>2,
            'city_name'=>'الحوامدية',
            'city_name_en'=>'Hawamdiyah'
        ] );



        City::create( [
            'id'=>6,
            'gov_id'=>2,
            'city_name'=>'البدرشين',
            'city_name_en'=>'Al Badrasheen'
        ] );



        City::create( [
            'id'=>7,
            'gov_id'=>2,
            'city_name'=>'الصف',
            'city_name_en'=>'Saf'
        ] );



        City::create( [
            'id'=>8,
            'gov_id'=>2,
            'city_name'=>'أطفيح',
            'city_name_en'=>'Atfih'
        ] );



        City::create( [
            'id'=>9,
            'gov_id'=>2,
            'city_name'=>'العياط',
            'city_name_en'=>'Al Ayat'
        ] );



        City::create( [
            'id'=>10,
            'gov_id'=>2,
            'city_name'=>'الباويطي',
            'city_name_en'=>'Al-Bawaiti'
        ] );



        City::create( [
            'id'=>11,
            'gov_id'=>2,
            'city_name'=>'منشأة القناطر',
            'city_name_en'=>'ManshiyetAl Qanater'
        ] );



        City::create( [
            'id'=>12,
            'gov_id'=>2,
            'city_name'=>'أوسيم',
            'city_name_en'=>'Oaseem'
        ] );



        City::create( [
            'id'=>13,
            'gov_id'=>2,
            'city_name'=>'كرداسة',
            'city_name_en'=>'Kerdasa'
        ] );



        City::create( [
            'id'=>14,
            'gov_id'=>2,
            'city_name'=>'أبو النمرس',
            'city_name_en'=>'Abu Nomros'
        ] );



        City::create( [
            'id'=>15,
            'gov_id'=>2,
            'city_name'=>'كفر غطاطي',
            'city_name_en'=>'Kafr Ghati'
        ] );



        City::create( [
            'id'=>16,
            'gov_id'=>2,
            'city_name'=>'منشأة البكاري',
            'city_name_en'=>'Manshiyet Al Bakari'
        ] );



        City::create( [
            'id'=>17,
            'gov_id'=>3,
            'city_name'=>'الأسكندرية',
            'city_name_en'=>'Alexandria'
        ] );



        City::create( [
            'id'=>18,
            'gov_id'=>3,
            'city_name'=>'برج العرب',
            'city_name_en'=>'Burj Al Arab'
        ] );



        City::create( [
            'id'=>19,
            'gov_id'=>3,
            'city_name'=>'برج العرب الجديدة',
            'city_name_en'=>'New Burj Al Arab'
        ] );



        City::create( [
            'id'=>20,
            'gov_id'=>12,
            'city_name'=>'بنها',
            'city_name_en'=>'Banha'
        ] );



        City::create( [
            'id'=>21,
            'gov_id'=>12,
            'city_name'=>'قليوب',
            'city_name_en'=>'Qalyub'
        ] );



        City::create( [
            'id'=>22,
            'gov_id'=>12,
            'city_name'=>'شبرا الخيمة',
            'city_name_en'=>'Shubra Al Khaimah'
        ] );



        City::create( [
            'id'=>23,
            'gov_id'=>12,
            'city_name'=>'القناطر الخيرية',
            'city_name_en'=>'Al Qanater Charity'
        ] );



        City::create( [
            'id'=>24,
            'gov_id'=>12,
            'city_name'=>'الخانكة',
            'city_name_en'=>'Khanka'
        ] );



        City::create( [
            'id'=>25,
            'gov_id'=>12,
            'city_name'=>'كفر شكر',
            'city_name_en'=>'Kafr Shukr'
        ] );



        City::create( [
            'id'=>26,
            'gov_id'=>12,
            'city_name'=>'طوخ',
            'city_name_en'=>'Tukh'
        ] );



        City::create( [
            'id'=>27,
            'gov_id'=>12,
            'city_name'=>'قها',
            'city_name_en'=>'Qaha'
        ] );



        City::create( [
            'id'=>28,
            'gov_id'=>12,
            'city_name'=>'العبور',
            'city_name_en'=>'Obour'
        ] );



        City::create( [
            'id'=>29,
            'gov_id'=>12,
            'city_name'=>'الخصوص',
            'city_name_en'=>'Khosous'
        ] );



        City::create( [
            'id'=>30,
            'gov_id'=>12,
            'city_name'=>'شبين القناطر',
            'city_name_en'=>'Shibin Al Qanater'
        ] );



        City::create( [
            'id'=>31,
            'gov_id'=>6,
            'city_name'=>'دمنهور',
            'city_name_en'=>'Damanhour'
        ] );



        City::create( [
            'id'=>32,
            'gov_id'=>6,
            'city_name'=>'كفر الدوار',
            'city_name_en'=>'Kafr El Dawar'
        ] );



        City::create( [
            'id'=>33,
            'gov_id'=>6,
            'city_name'=>'رشيد',
            'city_name_en'=>'Rashid'
        ] );



        City::create( [
            'id'=>34,
            'gov_id'=>6,
            'city_name'=>'إدكو',
            'city_name_en'=>'Edco'
        ] );



        City::create( [
            'id'=>35,
            'gov_id'=>6,
            'city_name'=>'أبو المطامير',
            'city_name_en'=>'Abu al-Matamir'
        ] );



        City::create( [
            'id'=>36,
            'gov_id'=>6,
            'city_name'=>'أبو حمص',
            'city_name_en'=>'Abu Homs'
        ] );



        City::create( [
            'id'=>37,
            'gov_id'=>6,
            'city_name'=>'الدلنجات',
            'city_name_en'=>'Delengat'
        ] );



        City::create( [
            'id'=>38,
            'gov_id'=>6,
            'city_name'=>'المحمودية',
            'city_name_en'=>'Mahmoudiyah'
        ] );



        City::create( [
            'id'=>39,
            'gov_id'=>6,
            'city_name'=>'الرحمانية',
            'city_name_en'=>'Rahmaniyah'
        ] );



        City::create( [
            'id'=>40,
            'gov_id'=>6,
            'city_name'=>'إيتاي البارود',
            'city_name_en'=>'Itai Baroud'
        ] );



        City::create( [
            'id'=>41,
            'gov_id'=>6,
            'city_name'=>'حوش عيسى',
            'city_name_en'=>'Housh Eissa'
        ] );



        City::create( [
            'id'=>42,
            'gov_id'=>6,
            'city_name'=>'شبراخيت',
            'city_name_en'=>'Shubrakhit'
        ] );



        City::create( [
            'id'=>43,
            'gov_id'=>6,
            'city_name'=>'كوم حمادة',
            'city_name_en'=>'Kom Hamada'
        ] );



        City::create( [
            'id'=>44,
            'gov_id'=>6,
            'city_name'=>'بدر',
            'city_name_en'=>'Badr'
        ] );



        City::create( [
            'id'=>45,
            'gov_id'=>6,
            'city_name'=>'وادي النطرون',
            'city_name_en'=>'Wadi Natrun'
        ] );



        City::create( [
            'id'=>46,
            'gov_id'=>6,
            'city_name'=>'النوبارية الجديدة',
            'city_name_en'=>'New Nubaria'
        ] );



        City::create( [
            'id'=>47,
            'gov_id'=>23,
            'city_name'=>'مرسى مطروح',
            'city_name_en'=>'Marsa Matrouh'
        ] );



        City::create( [
            'id'=>48,
            'gov_id'=>23,
            'city_name'=>'الحمام',
            'city_name_en'=>'El Hamam'
        ] );



        City::create( [
            'id'=>49,
            'gov_id'=>23,
            'city_name'=>'العلمين',
            'city_name_en'=>'Alamein'
        ] );



        City::create( [
            'id'=>50,
            'gov_id'=>23,
            'city_name'=>'الضبعة',
            'city_name_en'=>'Dabaa'
        ] );



        City::create( [
            'id'=>51,
            'gov_id'=>23,
            'city_name'=>'النجيلة',
            'city_name_en'=>'Al-Nagila'
        ] );



        City::create( [
            'id'=>52,
            'gov_id'=>23,
            'city_name'=>'سيدي براني',
            'city_name_en'=>'Sidi Brani'
        ] );



        City::create( [
            'id'=>53,
            'gov_id'=>23,
            'city_name'=>'السلوم',
            'city_name_en'=>'Salloum'
        ] );



        City::create( [
            'id'=>54,
            'gov_id'=>23,
            'city_name'=>'سيوة',
            'city_name_en'=>'Siwa'
        ] );



        City::create( [
            'id'=>55,
            'gov_id'=>19,
            'city_name'=>'دمياط',
            'city_name_en'=>'Damietta'
        ] );



        City::create( [
            'id'=>56,
            'gov_id'=>19,
            'city_name'=>'دمياط الجديدة',
            'city_name_en'=>'New Damietta'
        ] );



        City::create( [
            'id'=>57,
            'gov_id'=>19,
            'city_name'=>'رأس البر',
            'city_name_en'=>'Ras El Bar'
        ] );



        City::create( [
            'id'=>58,
            'gov_id'=>19,
            'city_name'=>'فارسكور',
            'city_name_en'=>'Faraskour'
        ] );



        City::create( [
            'id'=>59,
            'gov_id'=>19,
            'city_name'=>'الزرقا',
            'city_name_en'=>'Zarqa'
        ] );



        City::create( [
            'id'=>60,
            'gov_id'=>19,
            'city_name'=>'السرو',
            'city_name_en'=>'alsaru'
        ] );



        City::create( [
            'id'=>61,
            'gov_id'=>19,
            'city_name'=>'الروضة',
            'city_name_en'=>'alruwda'
        ] );



        City::create( [
            'id'=>62,
            'gov_id'=>19,
            'city_name'=>'كفر البطيخ',
            'city_name_en'=>'Kafr El-Batikh'
        ] );



        City::create( [
            'id'=>63,
            'gov_id'=>19,
            'city_name'=>'عزبة البرج',
            'city_name_en'=>'Azbet Al Burg'
        ] );



        City::create( [
            'id'=>64,
            'gov_id'=>19,
            'city_name'=>'ميت أبو غالب',
            'city_name_en'=>'Meet Abou Ghalib'
        ] );



        City::create( [
            'id'=>65,
            'gov_id'=>19,
            'city_name'=>'كفر سعد',
            'city_name_en'=>'Kafr Saad'
        ] );



        City::create( [
            'id'=>66,
            'gov_id'=>4,
            'city_name'=>'المنصورة',
            'city_name_en'=>'Mansoura'
        ] );



        City::create( [
            'id'=>67,
            'gov_id'=>4,
            'city_name'=>'طلخا',
            'city_name_en'=>'Talkha'
        ] );



        City::create( [
            'id'=>68,
            'gov_id'=>4,
            'city_name'=>'ميت غمر',
            'city_name_en'=>'Mitt Ghamr'
        ] );



        City::create( [
            'id'=>69,
            'gov_id'=>4,
            'city_name'=>'دكرنس',
            'city_name_en'=>'Dekernes'
        ] );



        City::create( [
            'id'=>70,
            'gov_id'=>4,
            'city_name'=>'أجا',
            'city_name_en'=>'Aga'
        ] );



        City::create( [
            'id'=>71,
            'gov_id'=>4,
            'city_name'=>'منية النصر',
            'city_name_en'=>'Menia El Nasr'
        ] );



        City::create( [
            'id'=>72,
            'gov_id'=>4,
            'city_name'=>'السنبلاوين',
            'city_name_en'=>'Sinbillawin'
        ] );



        City::create( [
            'id'=>73,
            'gov_id'=>4,
            'city_name'=>'الكردي',
            'city_name_en'=>'El Kurdi'
        ] );



        City::create( [
            'id'=>74,
            'gov_id'=>4,
            'city_name'=>'بني عبيد',
            'city_name_en'=>'Bani Ubaid'
        ] );



        City::create( [
            'id'=>75,
            'gov_id'=>4,
            'city_name'=>'المنزلة',
            'city_name_en'=>'Al Manzala'
        ] );



        City::create( [
            'id'=>76,
            'gov_id'=>4,
            'city_name'=>'تمي الأمديد',
            'city_name_en'=>'tami al\'amdid'
        ] );



        City::create( [
            'id'=>77,
            'gov_id'=>4,
            'city_name'=>'الجمالية',
            'city_name_en'=>'aljamalia'
        ] );



        City::create( [
            'id'=>78,
            'gov_id'=>4,
            'city_name'=>'شربين',
            'city_name_en'=>'Sherbin'
        ] );



        City::create( [
            'id'=>79,
            'gov_id'=>4,
            'city_name'=>'المطرية',
            'city_name_en'=>'Mataria'
        ] );



        City::create( [
            'id'=>80,
            'gov_id'=>4,
            'city_name'=>'بلقاس',
            'city_name_en'=>'Belqas'
        ] );



        City::create( [
            'id'=>81,
            'gov_id'=>4,
            'city_name'=>'ميت سلسيل',
            'city_name_en'=>'Meet Salsil'
        ] );



        City::create( [
            'id'=>82,
            'gov_id'=>4,
            'city_name'=>'جمصة',
            'city_name_en'=>'Gamasa'
        ] );



        City::create( [
            'id'=>83,
            'gov_id'=>4,
            'city_name'=>'محلة دمنة',
            'city_name_en'=>'Mahalat Damana'
        ] );



        City::create( [
            'id'=>84,
            'gov_id'=>4,
            'city_name'=>'نبروه',
            'city_name_en'=>'Nabroh'
        ] );



        City::create( [
            'id'=>85,
            'gov_id'=>22,
            'city_name'=>'كفر الشيخ',
            'city_name_en'=>'Kafr El Sheikh'
        ] );



        City::create( [
            'id'=>86,
            'gov_id'=>22,
            'city_name'=>'دسوق',
            'city_name_en'=>'Desouq'
        ] );



        City::create( [
            'id'=>87,
            'gov_id'=>22,
            'city_name'=>'فوه',
            'city_name_en'=>'Fooh'
        ] );



        City::create( [
            'id'=>88,
            'gov_id'=>22,
            'city_name'=>'مطوبس',
            'city_name_en'=>'Metobas'
        ] );



        City::create( [
            'id'=>89,
            'gov_id'=>22,
            'city_name'=>'برج البرلس',
            'city_name_en'=>'Burg Al Burullus'
        ] );



        City::create( [
            'id'=>90,
            'gov_id'=>22,
            'city_name'=>'بلطيم',
            'city_name_en'=>'Baltim'
        ] );



        City::create( [
            'id'=>91,
            'gov_id'=>22,
            'city_name'=>'مصيف بلطيم',
            'city_name_en'=>'Masief Baltim'
        ] );



        City::create( [
            'id'=>92,
            'gov_id'=>22,
            'city_name'=>'الحامول',
            'city_name_en'=>'Hamol'
        ] );



        City::create( [
            'id'=>93,
            'gov_id'=>22,
            'city_name'=>'بيلا',
            'city_name_en'=>'Bella'
        ] );



        City::create( [
            'id'=>94,
            'gov_id'=>22,
            'city_name'=>'الرياض',
            'city_name_en'=>'Riyadh'
        ] );



        City::create( [
            'id'=>95,
            'gov_id'=>22,
            'city_name'=>'سيدي سالم',
            'city_name_en'=>'Sidi Salm'
        ] );



        City::create( [
            'id'=>96,
            'gov_id'=>22,
            'city_name'=>'قلين',
            'city_name_en'=>'Qellen'
        ] );



        City::create( [
            'id'=>97,
            'gov_id'=>22,
            'city_name'=>'سيدي غازي',
            'city_name_en'=>'Sidi Ghazi'
        ] );



        City::create( [
            'id'=>98,
            'gov_id'=>8,
            'city_name'=>'طنطا',
            'city_name_en'=>'Tanta'
        ] );



        City::create( [
            'id'=>99,
            'gov_id'=>8,
            'city_name'=>'المحلة الكبرى',
            'city_name_en'=>'Al Mahalla Al Kobra'
        ] );



        City::create( [
            'id'=>100,
            'gov_id'=>8,
            'city_name'=>'كفر الزيات',
            'city_name_en'=>'Kafr El Zayat'
        ] );



        City::create( [
            'id'=>101,
            'gov_id'=>8,
            'city_name'=>'زفتى',
            'city_name_en'=>'Zefta'
        ] );



        City::create( [
            'id'=>102,
            'gov_id'=>8,
            'city_name'=>'السنطة',
            'city_name_en'=>'El Santa'
        ] );



        City::create( [
            'id'=>103,
            'gov_id'=>8,
            'city_name'=>'قطور',
            'city_name_en'=>'Qutour'
        ] );



        City::create( [
            'id'=>104,
            'gov_id'=>8,
            'city_name'=>'بسيون',
            'city_name_en'=>'Basion'
        ] );



        City::create( [
            'id'=>105,
            'gov_id'=>8,
            'city_name'=>'سمنود',
            'city_name_en'=>'Samannoud'
        ] );



        City::create( [
            'id'=>106,
            'gov_id'=>10,
            'city_name'=>'شبين الكوم',
            'city_name_en'=>'Shbeen El Koom'
        ] );



        City::create( [
            'id'=>107,
            'gov_id'=>10,
            'city_name'=>'مدينة السادات',
            'city_name_en'=>'Sadat City'
        ] );



        City::create( [
            'id'=>108,
            'gov_id'=>10,
            'city_name'=>'منوف',
            'city_name_en'=>'Menouf'
        ] );



        City::create( [
            'id'=>109,
            'gov_id'=>10,
            'city_name'=>'سرس الليان',
            'city_name_en'=>'Sars El-Layan'
        ] );



        City::create( [
            'id'=>110,
            'gov_id'=>10,
            'city_name'=>'أشمون',
            'city_name_en'=>'Ashmon'
        ] );



        City::create( [
            'id'=>111,
            'gov_id'=>10,
            'city_name'=>'الباجور',
            'city_name_en'=>'Al Bagor'
        ] );



        City::create( [
            'id'=>112,
            'gov_id'=>10,
            'city_name'=>'قويسنا',
            'city_name_en'=>'Quesna'
        ] );



        City::create( [
            'id'=>113,
            'gov_id'=>10,
            'city_name'=>'بركة السبع',
            'city_name_en'=>'Berkat El Saba'
        ] );



        City::create( [
            'id'=>114,
            'gov_id'=>10,
            'city_name'=>'تلا',
            'city_name_en'=>'Tala'
        ] );



        City::create( [
            'id'=>115,
            'gov_id'=>10,
            'city_name'=>'الشهداء',
            'city_name_en'=>'Al Shohada'
        ] );



        City::create( [
            'id'=>116,
            'gov_id'=>20,
            'city_name'=>'الزقازيق',
            'city_name_en'=>'Zagazig'
        ] );



        City::create( [
            'id'=>117,
            'gov_id'=>20,
            'city_name'=>'العاشر من رمضان',
            'city_name_en'=>'Al Ashr Men Ramadan'
        ] );



        City::create( [
            'id'=>118,
            'gov_id'=>20,
            'city_name'=>'منيا القمح',
            'city_name_en'=>'Minya Al Qamh'
        ] );



        City::create( [
            'id'=>119,
            'gov_id'=>20,
            'city_name'=>'بلبيس',
            'city_name_en'=>'Belbeis'
        ] );



        City::create( [
            'id'=>120,
            'gov_id'=>20,
            'city_name'=>'مشتول السوق',
            'city_name_en'=>'Mashtoul El Souq'
        ] );



        City::create( [
            'id'=>121,
            'gov_id'=>20,
            'city_name'=>'القنايات',
            'city_name_en'=>'Qenaiat'
        ] );



        City::create( [
            'id'=>122,
            'gov_id'=>20,
            'city_name'=>'أبو حماد',
            'city_name_en'=>'Abu Hammad'
        ] );



        City::create( [
            'id'=>123,
            'gov_id'=>20,
            'city_name'=>'القرين',
            'city_name_en'=>'El Qurain'
        ] );



        City::create( [
            'id'=>124,
            'gov_id'=>20,
            'city_name'=>'ههيا',
            'city_name_en'=>'Hehia'
        ] );



        City::create( [
            'id'=>125,
            'gov_id'=>20,
            'city_name'=>'أبو كبير',
            'city_name_en'=>'Abu Kabir'
        ] );



        City::create( [
            'id'=>126,
            'gov_id'=>20,
            'city_name'=>'فاقوس',
            'city_name_en'=>'Faccus'
        ] );



        City::create( [
            'id'=>127,
            'gov_id'=>20,
            'city_name'=>'الصالحية الجديدة',
            'city_name_en'=>'El Salihia El Gedida'
        ] );



        City::create( [
            'id'=>128,
            'gov_id'=>20,
            'city_name'=>'الإبراهيمية',
            'city_name_en'=>'Al Ibrahimiyah'
        ] );



        City::create( [
            'id'=>129,
            'gov_id'=>20,
            'city_name'=>'ديرب نجم',
            'city_name_en'=>'Deirb Negm'
        ] );



        City::create( [
            'id'=>130,
            'gov_id'=>20,
            'city_name'=>'كفر صقر',
            'city_name_en'=>'Kafr Saqr'
        ] );



        City::create( [
            'id'=>131,
            'gov_id'=>20,
            'city_name'=>'أولاد صقر',
            'city_name_en'=>'Awlad Saqr'
        ] );



        City::create( [
            'id'=>132,
            'gov_id'=>20,
            'city_name'=>'الحسينية',
            'city_name_en'=>'Husseiniya'
        ] );



        City::create( [
            'id'=>133,
            'gov_id'=>20,
            'city_name'=>'صان الحجر القبلية',
            'city_name_en'=>'san alhajar alqablia'
        ] );



        City::create( [
            'id'=>134,
            'gov_id'=>20,
            'city_name'=>'منشأة أبو عمر',
            'city_name_en'=>'Manshayat Abu Omar'
        ] );



        City::create( [
            'id'=>135,
            'gov_id'=>18,
            'city_name'=>'بورسعيد',
            'city_name_en'=>'PorSaid'
        ] );



        City::create( [
            'id'=>136,
            'gov_id'=>18,
            'city_name'=>'بورفؤاد',
            'city_name_en'=>'PorFouad'
        ] );



        City::create( [
            'id'=>137,
            'gov_id'=>9,
            'city_name'=>'الإسماعيلية',
            'city_name_en'=>'Ismailia'
        ] );



        City::create( [
            'id'=>138,
            'gov_id'=>9,
            'city_name'=>'فايد',
            'city_name_en'=>'Fayed'
        ] );



        City::create( [
            'id'=>139,
            'gov_id'=>9,
            'city_name'=>'القنطرة شرق',
            'city_name_en'=>'Qantara Sharq'
        ] );



        City::create( [
            'id'=>140,
            'gov_id'=>9,
            'city_name'=>'القنطرة غرب',
            'city_name_en'=>'Qantara Gharb'
        ] );



        City::create( [
            'id'=>141,
            'gov_id'=>9,
            'city_name'=>'التل الكبير',
            'city_name_en'=>'El Tal El Kabier'
        ] );



        City::create( [
            'id'=>142,
            'gov_id'=>9,
            'city_name'=>'أبو صوير',
            'city_name_en'=>'Abu Sawir'
        ] );



        City::create( [
            'id'=>143,
            'gov_id'=>9,
            'city_name'=>'القصاصين الجديدة',
            'city_name_en'=>'Kasasien El Gedida'
        ] );



        City::create( [
            'id'=>144,
            'gov_id'=>14,
            'city_name'=>'السويس',
            'city_name_en'=>'Suez'
        ] );



        City::create( [
            'id'=>145,
            'gov_id'=>26,
            'city_name'=>'العريش',
            'city_name_en'=>'Arish'
        ] );



        City::create( [
            'id'=>146,
            'gov_id'=>26,
            'city_name'=>'الشيخ زويد',
            'city_name_en'=>'Sheikh Zowaid'
        ] );



        City::create( [
            'id'=>147,
            'gov_id'=>26,
            'city_name'=>'نخل',
            'city_name_en'=>'Nakhl'
        ] );



        City::create( [
            'id'=>148,
            'gov_id'=>26,
            'city_name'=>'رفح',
            'city_name_en'=>'Rafah'
        ] );



        City::create( [
            'id'=>149,
            'gov_id'=>26,
            'city_name'=>'بئر العبد',
            'city_name_en'=>'Bir al-Abed'
        ] );



        City::create( [
            'id'=>150,
            'gov_id'=>26,
            'city_name'=>'الحسنة',
            'city_name_en'=>'Al Hasana'
        ] );



        City::create( [
            'id'=>151,
            'gov_id'=>21,
            'city_name'=>'الطور',
            'city_name_en'=>'Al Toor'
        ] );



        City::create( [
            'id'=>152,
            'gov_id'=>21,
            'city_name'=>'شرم الشيخ',
            'city_name_en'=>'Sharm El-Shaikh'
        ] );



        City::create( [
            'id'=>153,
            'gov_id'=>21,
            'city_name'=>'دهب',
            'city_name_en'=>'Dahab'
        ] );



        City::create( [
            'id'=>154,
            'gov_id'=>21,
            'city_name'=>'نويبع',
            'city_name_en'=>'Nuweiba'
        ] );



        City::create( [
            'id'=>155,
            'gov_id'=>21,
            'city_name'=>'طابا',
            'city_name_en'=>'Taba'
        ] );



        City::create( [
            'id'=>156,
            'gov_id'=>21,
            'city_name'=>'سانت كاترين',
            'city_name_en'=>'Saint Catherine'
        ] );



        City::create( [
            'id'=>157,
            'gov_id'=>21,
            'city_name'=>'أبو رديس',
            'city_name_en'=>'Abu Redis'
        ] );



        City::create( [
            'id'=>158,
            'gov_id'=>21,
            'city_name'=>'أبو زنيمة',
            'city_name_en'=>'Abu Zenaima'
        ] );



        City::create( [
            'id'=>159,
            'gov_id'=>21,
            'city_name'=>'رأس سدر',
            'city_name_en'=>'Ras Sidr'
        ] );



        City::create( [
            'id'=>160,
            'gov_id'=>17,
            'city_name'=>'بني سويف',
            'city_name_en'=>'Bani Sweif'
        ] );



        City::create( [
            'id'=>161,
            'gov_id'=>17,
            'city_name'=>'بني سويف الجديدة',
            'city_name_en'=>'Beni Suef El Gedida'
        ] );



        City::create( [
            'id'=>162,
            'gov_id'=>17,
            'city_name'=>'الواسطى',
            'city_name_en'=>'Al Wasta'
        ] );



        City::create( [
            'id'=>163,
            'gov_id'=>17,
            'city_name'=>'ناصر',
            'city_name_en'=>'Naser'
        ] );



        City::create( [
            'id'=>164,
            'gov_id'=>17,
            'city_name'=>'إهناسيا',
            'city_name_en'=>'Ehnasia'
        ] );



        City::create( [
            'id'=>165,
            'gov_id'=>17,
            'city_name'=>'ببا',
            'city_name_en'=>'beba'
        ] );



        City::create( [
            'id'=>166,
            'gov_id'=>17,
            'city_name'=>'الفشن',
            'city_name_en'=>'Fashn'
        ] );



        City::create( [
            'id'=>167,
            'gov_id'=>17,
            'city_name'=>'سمسطا',
            'city_name_en'=>'Somasta'
        ] );



        City::create( [
            'id'=>168,
            'gov_id'=>7,
            'city_name'=>'الفيوم',
            'city_name_en'=>'Fayoum'
        ] );



        City::create( [
            'id'=>169,
            'gov_id'=>7,
            'city_name'=>'الفيوم الجديدة',
            'city_name_en'=>'Fayoum El Gedida'
        ] );



        City::create( [
            'id'=>170,
            'gov_id'=>7,
            'city_name'=>'طامية',
            'city_name_en'=>'Tamiya'
        ] );



        City::create( [
            'id'=>171,
            'gov_id'=>7,
            'city_name'=>'سنورس',
            'city_name_en'=>'Snores'
        ] );



        City::create( [
            'id'=>172,
            'gov_id'=>7,
            'city_name'=>'إطسا',
            'city_name_en'=>'Etsa'
        ] );



        City::create( [
            'id'=>173,
            'gov_id'=>7,
            'city_name'=>'إبشواي',
            'city_name_en'=>'Epschway'
        ] );



        City::create( [
            'id'=>174,
            'gov_id'=>7,
            'city_name'=>'يوسف الصديق',
            'city_name_en'=>'Yusuf El Sediaq'
        ] );



        City::create( [
            'id'=>175,
            'gov_id'=>11,
            'city_name'=>'المنيا',
            'city_name_en'=>'Minya'
        ] );



        City::create( [
            'id'=>176,
            'gov_id'=>11,
            'city_name'=>'المنيا الجديدة',
            'city_name_en'=>'Minya El Gedida'
        ] );



        City::create( [
            'id'=>177,
            'gov_id'=>11,
            'city_name'=>'العدوة',
            'city_name_en'=>'El Adwa'
        ] );



        City::create( [
            'id'=>178,
            'gov_id'=>11,
            'city_name'=>'مغاغة',
            'city_name_en'=>'Magagha'
        ] );



        City::create( [
            'id'=>179,
            'gov_id'=>11,
            'city_name'=>'بني مزار',
            'city_name_en'=>'Bani Mazar'
        ] );



        City::create( [
            'id'=>180,
            'gov_id'=>11,
            'city_name'=>'مطاي',
            'city_name_en'=>'Mattay'
        ] );



        City::create( [
            'id'=>181,
            'gov_id'=>11,
            'city_name'=>'سمالوط',
            'city_name_en'=>'Samalut'
        ] );



        City::create( [
            'id'=>182,
            'gov_id'=>11,
            'city_name'=>'المدينة الفكرية',
            'city_name_en'=>'Madinat El Fekria'
        ] );



        City::create( [
            'id'=>183,
            'gov_id'=>11,
            'city_name'=>'ملوي',
            'city_name_en'=>'Meloy'
        ] );



        City::create( [
            'id'=>184,
            'gov_id'=>11,
            'city_name'=>'دير مواس',
            'city_name_en'=>'Deir Mawas'
        ] );



        City::create( [
            'id'=>185,
            'gov_id'=>16,
            'city_name'=>'أسيوط',
            'city_name_en'=>'Assiut'
        ] );



        City::create( [
            'id'=>186,
            'gov_id'=>16,
            'city_name'=>'أسيوط الجديدة',
            'city_name_en'=>'Assiut El Gedida'
        ] );



        City::create( [
            'id'=>187,
            'gov_id'=>16,
            'city_name'=>'ديروط',
            'city_name_en'=>'Dayrout'
        ] );



        City::create( [
            'id'=>188,
            'gov_id'=>16,
            'city_name'=>'منفلوط',
            'city_name_en'=>'Manfalut'
        ] );



        City::create( [
            'id'=>189,
            'gov_id'=>16,
            'city_name'=>'القوصية',
            'city_name_en'=>'Qusiya'
        ] );



        City::create( [
            'id'=>190,
            'gov_id'=>16,
            'city_name'=>'أبنوب',
            'city_name_en'=>'Abnoub'
        ] );



        City::create( [
            'id'=>191,
            'gov_id'=>16,
            'city_name'=>'أبو تيج',
            'city_name_en'=>'Abu Tig'
        ] );



        City::create( [
            'id'=>192,
            'gov_id'=>16,
            'city_name'=>'الغنايم',
            'city_name_en'=>'El Ghanaim'
        ] );



        City::create( [
            'id'=>193,
            'gov_id'=>16,
            'city_name'=>'ساحل سليم',
            'city_name_en'=>'Sahel Selim'
        ] );



        City::create( [
            'id'=>194,
            'gov_id'=>16,
            'city_name'=>'البداري',
            'city_name_en'=>'El Badari'
        ] );



        City::create( [
            'id'=>195,
            'gov_id'=>16,
            'city_name'=>'صدفا',
            'city_name_en'=>'Sidfa'
        ] );



        City::create( [
            'id'=>196,
            'gov_id'=>13,
            'city_name'=>'الخارجة',
            'city_name_en'=>'El Kharga'
        ] );



        City::create( [
            'id'=>197,
            'gov_id'=>13,
            'city_name'=>'باريس',
            'city_name_en'=>'Paris'
        ] );



        City::create( [
            'id'=>198,
            'gov_id'=>13,
            'city_name'=>'موط',
            'city_name_en'=>'Mout'
        ] );



        City::create( [
            'id'=>199,
            'gov_id'=>13,
            'city_name'=>'الفرافرة',
            'city_name_en'=>'Farafra'
        ] );



        City::create( [
            'id'=>200,
            'gov_id'=>13,
            'city_name'=>'بلاط',
            'city_name_en'=>'Balat'
        ] );



        City::create( [
            'id'=>201,
            'gov_id'=>5,
            'city_name'=>'الغردقة',
            'city_name_en'=>'Hurghada'
        ] );



        City::create( [
            'id'=>202,
            'gov_id'=>5,
            'city_name'=>'رأس غارب',
            'city_name_en'=>'Ras Ghareb'
        ] );



        City::create( [
            'id'=>203,
            'gov_id'=>5,
            'city_name'=>'سفاجا',
            'city_name_en'=>'Safaga'
        ] );



        City::create( [
            'id'=>204,
            'gov_id'=>5,
            'city_name'=>'القصير',
            'city_name_en'=>'El Qusiar'
        ] );



        City::create( [
            'id'=>205,
            'gov_id'=>5,
            'city_name'=>'مرسى علم',
            'city_name_en'=>'Marsa Alam'
        ] );



        City::create( [
            'id'=>206,
            'gov_id'=>5,
            'city_name'=>'الشلاتين',
            'city_name_en'=>'Shalatin'
        ] );



        City::create( [
            'id'=>207,
            'gov_id'=>5,
            'city_name'=>'حلايب',
            'city_name_en'=>'Halaib'
        ] );



        City::create( [
            'id'=>208,
            'gov_id'=>27,
            'city_name'=>'سوهاج',
            'city_name_en'=>'Sohag'
        ] );



        City::create( [
            'id'=>209,
            'gov_id'=>27,
            'city_name'=>'سوهاج الجديدة',
            'city_name_en'=>'Sohag El Gedida'
        ] );



        City::create( [
            'id'=>210,
            'gov_id'=>27,
            'city_name'=>'أخميم',
            'city_name_en'=>'Akhmeem'
        ] );



        City::create( [
            'id'=>211,
            'gov_id'=>27,
            'city_name'=>'أخميم الجديدة',
            'city_name_en'=>'Akhmim El Gedida'
        ] );



        City::create( [
            'id'=>212,
            'gov_id'=>27,
            'city_name'=>'البلينا',
            'city_name_en'=>'Albalina'
        ] );



        City::create( [
            'id'=>213,
            'gov_id'=>27,
            'city_name'=>'المراغة',
            'city_name_en'=>'El Maragha'
        ] );



        City::create( [
            'id'=>214,
            'gov_id'=>27,
            'city_name'=>'المنشأة',
            'city_name_en'=>'almunsha\'a'
        ] );



        City::create( [
            'id'=>215,
            'gov_id'=>27,
            'city_name'=>'دار السلام',
            'city_name_en'=>'Dar AISalaam'
        ] );



        City::create( [
            'id'=>216,
            'gov_id'=>27,
            'city_name'=>'جرجا',
            'city_name_en'=>'Gerga'
        ] );



        City::create( [
            'id'=>217,
            'gov_id'=>27,
            'city_name'=>'جهينة الغربية',
            'city_name_en'=>'Jahina Al Gharbia'
        ] );



        City::create( [
            'id'=>218,
            'gov_id'=>27,
            'city_name'=>'ساقلته',
            'city_name_en'=>'Saqilatuh'
        ] );



        City::create( [
            'id'=>219,
            'gov_id'=>27,
            'city_name'=>'طما',
            'city_name_en'=>'Tama'
        ] );



        City::create( [
            'id'=>220,
            'gov_id'=>27,
            'city_name'=>'طهطا',
            'city_name_en'=>'Tahta'
        ] );



        City::create( [
            'id'=>221,
            'gov_id'=>25,
            'city_name'=>'قنا',
            'city_name_en'=>'Qena'
        ] );



        City::create( [
            'id'=>222,
            'gov_id'=>25,
            'city_name'=>'قنا الجديدة',
            'city_name_en'=>'New Qena'
        ] );



        City::create( [
            'id'=>223,
            'gov_id'=>25,
            'city_name'=>'أبو تشت',
            'city_name_en'=>'Abu Tesht'
        ] );



        City::create( [
            'id'=>224,
            'gov_id'=>25,
            'city_name'=>'نجع حمادي',
            'city_name_en'=>'Nag Hammadi'
        ] );



        City::create( [
            'id'=>225,
            'gov_id'=>25,
            'city_name'=>'دشنا',
            'city_name_en'=>'Deshna'
        ] );



        City::create( [
            'id'=>226,
            'gov_id'=>25,
            'city_name'=>'الوقف',
            'city_name_en'=>'Alwaqf'
        ] );



        City::create( [
            'id'=>227,
            'gov_id'=>25,
            'city_name'=>'قفط',
            'city_name_en'=>'Qaft'
        ] );



        City::create( [
            'id'=>228,
            'gov_id'=>25,
            'city_name'=>'نقادة',
            'city_name_en'=>'Naqada'
        ] );



        City::create( [
            'id'=>229,
            'gov_id'=>25,
            'city_name'=>'فرشوط',
            'city_name_en'=>'Farshout'
        ] );



        City::create( [
            'id'=>230,
            'gov_id'=>25,
            'city_name'=>'قوص',
            'city_name_en'=>'Quos'
        ] );



        City::create( [
            'id'=>231,
            'gov_id'=>24,
            'city_name'=>'الأقصر',
            'city_name_en'=>'Luxor'
        ] );



        City::create( [
            'id'=>232,
            'gov_id'=>24,
            'city_name'=>'الأقصر الجديدة',
            'city_name_en'=>'New Luxor'
        ] );



        City::create( [
            'id'=>233,
            'gov_id'=>24,
            'city_name'=>'إسنا',
            'city_name_en'=>'Esna'
        ] );



        City::create( [
            'id'=>234,
            'gov_id'=>24,
            'city_name'=>'طيبة الجديدة',
            'city_name_en'=>'New Tiba'
        ] );



        City::create( [
            'id'=>235,
            'gov_id'=>24,
            'city_name'=>'الزينية',
            'city_name_en'=>'Al ziynia'
        ] );



        City::create( [
            'id'=>236,
            'gov_id'=>24,
            'city_name'=>'البياضية',
            'city_name_en'=>'Al Bayadieh'
        ] );



        City::create( [
            'id'=>237,
            'gov_id'=>24,
            'city_name'=>'القرنة',
            'city_name_en'=>'Al Qarna'
        ] );



        City::create( [
            'id'=>238,
            'gov_id'=>24,
            'city_name'=>'أرمنت',
            'city_name_en'=>'Armant'
        ] );



        City::create( [
            'id'=>239,
            'gov_id'=>24,
            'city_name'=>'الطود',
            'city_name_en'=>'Al Tud'
        ] );



        City::create( [
            'id'=>240,
            'gov_id'=>15,
            'city_name'=>'أسوان',
            'city_name_en'=>'Aswan'
        ] );



        City::create( [
            'id'=>241,
            'gov_id'=>15,
            'city_name'=>'أسوان الجديدة',
            'city_name_en'=>'Aswan El Gedida'
        ] );



        City::create( [
            'id'=>242,
            'gov_id'=>15,
            'city_name'=>'دراو',
            'city_name_en'=>'Drau'
        ] );



        City::create( [
            'id'=>243,
            'gov_id'=>15,
            'city_name'=>'كوم أمبو',
            'city_name_en'=>'Kom Ombo'
        ] );



        City::create( [
            'id'=>244,
            'gov_id'=>15,
            'city_name'=>'نصر النوبة',
            'city_name_en'=>'Nasr Al Nuba'
        ] );



        City::create( [
            'id'=>245,
            'gov_id'=>15,
            'city_name'=>'كلابشة',
            'city_name_en'=>'Kalabsha'
        ] );



        City::create( [
            'id'=>246,
            'gov_id'=>15,
            'city_name'=>'إدفو',
            'city_name_en'=>'Edfu'
        ] );



        City::create( [
            'id'=>247,
            'gov_id'=>15,
            'city_name'=>'الرديسية',
            'city_name_en'=>'Al-Radisiyah'
        ] );



        City::create( [
            'id'=>248,
            'gov_id'=>15,
            'city_name'=>'البصيلية',
            'city_name_en'=>'Al Basilia'
        ] );



        City::create( [
            'id'=>249,
            'gov_id'=>15,
            'city_name'=>'السباعية',
            'city_name_en'=>'Al Sibaeia'
        ] );



        City::create( [
            'id'=>250,
            'gov_id'=>15,
            'city_name'=>'ابوسمبل السياحية',
            'city_name_en'=>'Abo Simbl Al Siyahia'
        ] );



    }
}
