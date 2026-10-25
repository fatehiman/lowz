<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\City;
use Illuminate\Database\Seeder;

class IranLocationSeeder extends Seeder
{
    /**
     * Iran provinces and cities. City priority: 100 = province capital (shown first),
     * 0 = other cities (shown alphabetically after).
     */
    public function run(): void
    {
        $data = array (
  0 => 
  array (
    'name' => 'آذربایجان شرقی',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'تبریز',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آبش احمد',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آذرشهر',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'آقکند',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'آچاچی',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'اسکو',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'اهر',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'ایلخچی',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'باسمنج',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'بخشایش',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'بستان آباد',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'بناب',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'بناب مرند',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'ترک',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'ترکمانچای',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'تسوج',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'تیمورلو',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'تیکمه داش',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'جلفا',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'جوان قلعه',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'خاروانا',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'خامنه',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'خداجو',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'خسروشاه',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'خمارلو',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'خواجه',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'دوزدوزان',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'زرنق',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'زنوز',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'سراب',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'سردرود',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'سیس',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'سیه رود',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'شبستر',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'شربیان',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'شرفخانه',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'شند آباد',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'شهر جدید سهند',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'صوفیان',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'عجب شیر',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'قره آغاج',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'لیلان',
        'is_capital' => false,
      ),
      42 => 
      array (
        'name' => 'مبارک شهر',
        'is_capital' => false,
      ),
      43 => 
      array (
        'name' => 'مراغه',
        'is_capital' => false,
      ),
      44 => 
      array (
        'name' => 'مرند',
        'is_capital' => false,
      ),
      45 => 
      array (
        'name' => 'ملکان',
        'is_capital' => false,
      ),
      46 => 
      array (
        'name' => 'ممقان',
        'is_capital' => false,
      ),
      47 => 
      array (
        'name' => 'مهربان',
        'is_capital' => false,
      ),
      48 => 
      array (
        'name' => 'میانه',
        'is_capital' => false,
      ),
      49 => 
      array (
        'name' => 'نظرکهریزی',
        'is_capital' => false,
      ),
      50 => 
      array (
        'name' => 'هادیشهر',
        'is_capital' => false,
      ),
      51 => 
      array (
        'name' => 'هریس',
        'is_capital' => false,
      ),
      52 => 
      array (
        'name' => 'هشترود',
        'is_capital' => false,
      ),
      53 => 
      array (
        'name' => 'هوراند',
        'is_capital' => false,
      ),
      54 => 
      array (
        'name' => 'وایقان',
        'is_capital' => false,
      ),
      55 => 
      array (
        'name' => 'ورزقان',
        'is_capital' => false,
      ),
      56 => 
      array (
        'name' => 'کشکسرای',
        'is_capital' => false,
      ),
      57 => 
      array (
        'name' => 'کلوانق',
        'is_capital' => false,
      ),
      58 => 
      array (
        'name' => 'کلیبر',
        'is_capital' => false,
      ),
      59 => 
      array (
        'name' => 'کوزه کنان',
        'is_capital' => false,
      ),
      60 => 
      array (
        'name' => 'گوگان',
        'is_capital' => false,
      ),
      61 => 
      array (
        'name' => 'یامچی',
        'is_capital' => false,
      ),
    ),
  ),
  1 => 
  array (
    'name' => 'آذربایجان غربی',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'ارومیه',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آواجیق',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'اشنویه',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'ایواوغلی',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'باروق',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بازرگان',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بوکان',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'تازه شهر',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'تکاب',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'خلیفان',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'خوی',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'دیزج دیز',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'ربط',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'زرآباد',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'سردشت',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'سرو',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'سلماس',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'سیلوانه',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'سیمینه',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'سیه چشمه',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'شاهین دژ',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'شوط',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'فیرورق',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'قره ضیاء الدین',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'قطور',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'قوشچی',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'ماکو',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'محمد یار',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'محمود آباد',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'مرگنلر',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'مهاباد',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'میاندوآب',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'میرآباد',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'نازک علیا',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'نالوس',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'نقده',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'نوشین',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'پلدشت',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'پیرانشهر',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'چهار برج',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'کشاورز',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'گردکشانه',
        'is_capital' => false,
      ),
    ),
  ),
  2 => 
  array (
    'name' => 'اردبیل',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'اردبیل',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آبی بیگلو',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'اسلام آباد',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'اصلاندوز',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'بیله سوار',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'تازه کند',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'تازه کند انگوت',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'جعفر آباد',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'خلخال',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'رضی',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'سرعین',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'عنبران',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'فخرآباد',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'قصابه',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'لاهرود',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'مرادلو',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'مشگین شهر',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'نمین',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'نیر',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'هشتجین',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'هیر',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'پارس آباد',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'کلور',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'کورائیم',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'گرمی',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'گیوی',
        'is_capital' => false,
      ),
    ),
  ),
  3 => 
  array (
    'name' => 'اصفهان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'اصفهان',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آران و بیدگل',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'ابریشم',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'ابوزید آباد',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'اردستان',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'اصغرآباد',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'افوس',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'انارک',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'اژیه',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'ایمانشهر',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'بادرود',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'باغ بهادران',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'باغشاد',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'بافران',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'برزک',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'برف انبار',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'بهاران شهر',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'بهارستان',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'بوئین میاندشت',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'تودشک',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'تیران',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'جندق',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'جوزدان',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'جوشقان قالی',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'حبیب آباد',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'حسن آباد',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'حنا',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'خالد آباد',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'خمینی شهر',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'خوانسار',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'خور',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'خورزوق',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'داران',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'دامنه',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'درچه پیاز',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'دستگرد',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'دهاقان',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'دهق',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'دولت آباد',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'دیزیچه',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'رزوه',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'رضوانشهر',
        'is_capital' => false,
      ),
      42 => 
      array (
        'name' => 'زازران',
        'is_capital' => false,
      ),
      43 => 
      array (
        'name' => 'زاینده رود',
        'is_capital' => false,
      ),
      44 => 
      array (
        'name' => 'زرین شهر',
        'is_capital' => false,
      ),
      45 => 
      array (
        'name' => 'زواره',
        'is_capital' => false,
      ),
      46 => 
      array (
        'name' => 'زیار',
        'is_capital' => false,
      ),
      47 => 
      array (
        'name' => 'زیباشهر',
        'is_capital' => false,
      ),
      48 => 
      array (
        'name' => 'سده لنجان',
        'is_capital' => false,
      ),
      49 => 
      array (
        'name' => 'سفید شهر',
        'is_capital' => false,
      ),
      50 => 
      array (
        'name' => 'سمیرم',
        'is_capital' => false,
      ),
      51 => 
      array (
        'name' => 'سگزی',
        'is_capital' => false,
      ),
      52 => 
      array (
        'name' => 'سین',
        'is_capital' => false,
      ),
      53 => 
      array (
        'name' => 'شاهین شهر',
        'is_capital' => false,
      ),
      54 => 
      array (
        'name' => 'شاپورآباد',
        'is_capital' => false,
      ),
      55 => 
      array (
        'name' => 'شهرضا',
        'is_capital' => false,
      ),
      56 => 
      array (
        'name' => 'طالخونچه',
        'is_capital' => false,
      ),
      57 => 
      array (
        'name' => 'طرق رود',
        'is_capital' => false,
      ),
      58 => 
      array (
        'name' => 'عسگران',
        'is_capital' => false,
      ),
      59 => 
      array (
        'name' => 'علویچه',
        'is_capital' => false,
      ),
      60 => 
      array (
        'name' => 'فرخی',
        'is_capital' => false,
      ),
      61 => 
      array (
        'name' => 'فریدونشهر',
        'is_capital' => false,
      ),
      62 => 
      array (
        'name' => 'فلاورجان',
        'is_capital' => false,
      ),
      63 => 
      array (
        'name' => 'فولاد شهر',
        'is_capital' => false,
      ),
      64 => 
      array (
        'name' => 'قمصر',
        'is_capital' => false,
      ),
      65 => 
      array (
        'name' => 'قهجاورستان',
        'is_capital' => false,
      ),
      66 => 
      array (
        'name' => 'قهدریجان',
        'is_capital' => false,
      ),
      67 => 
      array (
        'name' => 'لای بید',
        'is_capital' => false,
      ),
      68 => 
      array (
        'name' => 'مبارکه',
        'is_capital' => false,
      ),
      69 => 
      array (
        'name' => 'محمد آباد',
        'is_capital' => false,
      ),
      70 => 
      array (
        'name' => 'مشکات',
        'is_capital' => false,
      ),
      71 => 
      array (
        'name' => 'منظریه',
        'is_capital' => false,
      ),
      72 => 
      array (
        'name' => 'مهاباد',
        'is_capital' => false,
      ),
      73 => 
      array (
        'name' => 'میمه',
        'is_capital' => false,
      ),
      74 => 
      array (
        'name' => 'نائین',
        'is_capital' => false,
      ),
      75 => 
      array (
        'name' => 'نجف آباد',
        'is_capital' => false,
      ),
      76 => 
      array (
        'name' => 'نصرآباد',
        'is_capital' => false,
      ),
      77 => 
      array (
        'name' => 'نظنز',
        'is_capital' => false,
      ),
      78 => 
      array (
        'name' => 'نوش آباد',
        'is_capital' => false,
      ),
      79 => 
      array (
        'name' => 'نیاسر',
        'is_capital' => false,
      ),
      80 => 
      array (
        'name' => 'نیک آباد',
        'is_capital' => false,
      ),
      81 => 
      array (
        'name' => 'هرند',
        'is_capital' => false,
      ),
      82 => 
      array (
        'name' => 'ورزنه',
        'is_capital' => false,
      ),
      83 => 
      array (
        'name' => 'ورنامخواست',
        'is_capital' => false,
      ),
      84 => 
      array (
        'name' => 'وزوان',
        'is_capital' => false,
      ),
      85 => 
      array (
        'name' => 'ونک',
        'is_capital' => false,
      ),
      86 => 
      array (
        'name' => 'پیر بکران',
        'is_capital' => false,
      ),
      87 => 
      array (
        'name' => 'چادگان',
        'is_capital' => false,
      ),
      88 => 
      array (
        'name' => 'چرمهین',
        'is_capital' => false,
      ),
      89 => 
      array (
        'name' => 'چمگردان',
        'is_capital' => false,
      ),
      90 => 
      array (
        'name' => 'کاشان',
        'is_capital' => false,
      ),
      91 => 
      array (
        'name' => 'کامو و چوگان',
        'is_capital' => false,
      ),
      92 => 
      array (
        'name' => 'کرکوند',
        'is_capital' => false,
      ),
      93 => 
      array (
        'name' => 'کلیشاد و سودرجان',
        'is_capital' => false,
      ),
      94 => 
      array (
        'name' => 'کمشجه',
        'is_capital' => false,
      ),
      95 => 
      array (
        'name' => 'کمه',
        'is_capital' => false,
      ),
      96 => 
      array (
        'name' => 'کهریزسنگ',
        'is_capital' => false,
      ),
      97 => 
      array (
        'name' => 'کوشک',
        'is_capital' => false,
      ),
      98 => 
      array (
        'name' => 'کوهپایه',
        'is_capital' => false,
      ),
      99 => 
      array (
        'name' => 'گرگاب',
        'is_capital' => false,
      ),
      100 => 
      array (
        'name' => 'گز برخوار',
        'is_capital' => false,
      ),
      101 => 
      array (
        'name' => 'گلدشت',
        'is_capital' => false,
      ),
      102 => 
      array (
        'name' => 'گلشن',
        'is_capital' => false,
      ),
      103 => 
      array (
        'name' => 'گلشهر',
        'is_capital' => false,
      ),
      104 => 
      array (
        'name' => 'گلپایگان',
        'is_capital' => false,
      ),
      105 => 
      array (
        'name' => 'گوگد',
        'is_capital' => false,
      ),
    ),
  ),
  4 => 
  array (
    'name' => 'البرز',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'کرج',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آسارا',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'اشتهارد',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'تنکمان',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'شهر جدید هشتگرد',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'طالقان',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'فردیس',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'ماهدشت',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'محمد شهر',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'مشکین دشت',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'نظر آباد',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'هشتگرد',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'چهارباغ',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'کمال شهر',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'کوهسار',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'گرمدره',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'گلسار',
        'is_capital' => false,
      ),
    ),
  ),
  5 => 
  array (
    'name' => 'ایلام',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'ایلام',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آبدانان',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آسمان آباد',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'ارکواز',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'ایوان',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بدره',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بلاوه',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'توحید',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'دره شهر',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'دلگشا',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'دهلران',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'زرنه',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'سراب باغ',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'سرابله',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'شباب',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'صالح آباد',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'لومار',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'ماژین',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'مهر',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'مهران',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'مورموری',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'موسیان',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'میمه',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'پهله',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'چوار',
        'is_capital' => false,
      ),
    ),
  ),
  6 => 
  array (
    'name' => 'بوشهر',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'بوشهر',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آباد',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آبدان',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'آبپخش',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'امام حسن',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'انارستان',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'اهرم',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بادوله',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'برازجان',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'بردخون',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'بردستان',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'بندر دیر',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'بندر دیلم',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'بندر ریگ',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'بندر کنگان',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'بندر گناوه',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'بنک',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'بوشکان',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'تنگ ارم',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'جم',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'خارک',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'خورموج',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'دالکی',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'دلوار',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'دوراهک',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'ریز',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'سعد آباد',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'سیراف',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'شبانکاره',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'شنبه',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'عسلویه',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'نخل تقی',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'وحدتیه',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'چغادک',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'کاکی',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'کلمه',
        'is_capital' => false,
      ),
    ),
  ),
  7 => 
  array (
    'name' => 'تهران',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'تهران',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آبسرد',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آبعلی',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'ارجمند',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'اسلامشهر',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'اندیشه',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'باغستان',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'باقرشهر',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'بومهن',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'تجریش',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'جواد آباد',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'حسن آباد',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'دماوند',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'رباط کریم',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'رودهن',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'ری',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'شاهدشهر',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'شریف آباد',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'شمشک',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'شهر جدید پرند',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'شهریار',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'صالحیه',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'صبا شهر',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'صفادشت',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'فردوسیه',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'فرون آباد',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'فشم',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'فیروزکوه',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'قدس',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'قرچک',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'لواسان',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'ملارد',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'نسیم شهر',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'نصیرشهر',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'وحیدیه',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'ورامین',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'پاکدشت',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'پردیس',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'پیشوا',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'چهاردانگه',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'کهریزک',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'کیلان',
        'is_capital' => false,
      ),
      42 => 
      array (
        'name' => 'گلستان',
        'is_capital' => false,
      ),
    ),
  ),
  8 => 
  array (
    'name' => 'خراسان جنوبی',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'بیرجند',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آرین شهر',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آیسک',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'ارسک',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'اسدیه',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'اسفدن',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'اسلامیه',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بشرویه',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'حاجی آباد',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'خضری دشت بیاض',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'خوسف',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'دیهوک',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'زهان',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'سرایان',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'سربیشه',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'سه قلعه',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'شوسف',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'طبس',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'طبس مسینا',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'عشق آباد',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'فردوس',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'قائن',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'قهستان',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'محمدشهر',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'مود',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'نهبندان',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'نیمبلوک',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'گزیک',
        'is_capital' => false,
      ),
    ),
  ),
  9 => 
  array (
    'name' => 'خراسان رضوی',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'مشهد',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'احمدآباد صولت',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'انابد',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'باجگیران',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'باخرز',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بار',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بایک',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بجستان',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'بردسکن',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'بیدخت',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'تایباد',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'تربت جام',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'تربت حیدریه',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'جغتای',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'جنگل',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'خرو',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'خلیل آباد',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'خواف',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'داورزن',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'درود',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'درگز',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'دولت آباد',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'رباط سنگ',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'رشتخوار',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'رضویه',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'روداب',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'ریوش',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'سبزوار',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'سرخس',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'سفید سنگ',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'سلامی',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'سلطان آباد',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'سنگان',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'شادمهر',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'شاندیز',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'ششتمد',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'شهر زو',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'شهرآباد',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'صالح آباد',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'طرقبه',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'عشق آباد',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'فرهاد گرد',
        'is_capital' => false,
      ),
      42 => 
      array (
        'name' => 'فریمان',
        'is_capital' => false,
      ),
      43 => 
      array (
        'name' => 'فیروزه',
        'is_capital' => false,
      ),
      44 => 
      array (
        'name' => 'فیض آباد',
        'is_capital' => false,
      ),
      45 => 
      array (
        'name' => 'قاسم آباد',
        'is_capital' => false,
      ),
      46 => 
      array (
        'name' => 'قدمگاه',
        'is_capital' => false,
      ),
      47 => 
      array (
        'name' => 'قلندر آباد',
        'is_capital' => false,
      ),
      48 => 
      array (
        'name' => 'قوچان',
        'is_capital' => false,
      ),
      49 => 
      array (
        'name' => 'لطف آباد',
        'is_capital' => false,
      ),
      50 => 
      array (
        'name' => 'مزدآوند',
        'is_capital' => false,
      ),
      51 => 
      array (
        'name' => 'مشهدریزه',
        'is_capital' => false,
      ),
      52 => 
      array (
        'name' => 'ملک آباد',
        'is_capital' => false,
      ),
      53 => 
      array (
        'name' => 'نشتیفان',
        'is_capital' => false,
      ),
      54 => 
      array (
        'name' => 'نصرآباد',
        'is_capital' => false,
      ),
      55 => 
      array (
        'name' => 'نقاب',
        'is_capital' => false,
      ),
      56 => 
      array (
        'name' => 'نوخندان',
        'is_capital' => false,
      ),
      57 => 
      array (
        'name' => 'نیشابور',
        'is_capital' => false,
      ),
      58 => 
      array (
        'name' => 'نیل شهر',
        'is_capital' => false,
      ),
      59 => 
      array (
        'name' => 'همت آباد',
        'is_capital' => false,
      ),
      60 => 
      array (
        'name' => 'چاپشلو',
        'is_capital' => false,
      ),
      61 => 
      array (
        'name' => 'چناران',
        'is_capital' => false,
      ),
      62 => 
      array (
        'name' => 'چکنه',
        'is_capital' => false,
      ),
      63 => 
      array (
        'name' => 'کاخک',
        'is_capital' => false,
      ),
      64 => 
      array (
        'name' => 'کاریز',
        'is_capital' => false,
      ),
      65 => 
      array (
        'name' => 'کاشمر',
        'is_capital' => false,
      ),
      66 => 
      array (
        'name' => 'کدکن',
        'is_capital' => false,
      ),
      67 => 
      array (
        'name' => 'کلات',
        'is_capital' => false,
      ),
      68 => 
      array (
        'name' => 'کندر',
        'is_capital' => false,
      ),
      69 => 
      array (
        'name' => 'گلمکان',
        'is_capital' => false,
      ),
      70 => 
      array (
        'name' => 'گناباد',
        'is_capital' => false,
      ),
      71 => 
      array (
        'name' => 'یونسی',
        'is_capital' => false,
      ),
    ),
  ),
  10 => 
  array (
    'name' => 'خراسان شمالی',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'بجنورد',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آشخانه',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آوا',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'اسفراین',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'ایور',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'تیتکانلو',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'جاجرم',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'حصارگرمخان',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'درق',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'راز',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'زیارت',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'سنخواست',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'شوقان',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'شیروان',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'صفی آباد',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'فاروج',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'قاضی',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'قوشخانه',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'لوجلی',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'پیش قلعه',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'چناران شهر',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'گرمه',
        'is_capital' => false,
      ),
    ),
  ),
  11 => 
  array (
    'name' => 'خوزستان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'اهواز',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آبادان',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آبژدان',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'آزادی',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'آغاجاری',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'ابوحمیظه',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'اروند کنار',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'الهایی',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'الوان',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'امیدیه',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'اندیمشک',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'ایذه',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'باغ ملک',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'بستان',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'بندر امام خمینی',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'بندر ماهشهر',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'بهبهان',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'بیدروبه',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'ترکالکی',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'تشان',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'جایزان',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'جنت مکان',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'حر',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'حسینیه',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'حمزه',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'حمیدیه',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'خرمشهر',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'خنافره',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'دارخوین',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'دزفول',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'دهدز',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'رامشیر',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'رامهرمز',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'رفیع',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'زهره',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'سالند',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'سرداران',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'سردشت',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'سماله',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'سوسنگرد',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'سیاه منصور',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'شادگان',
        'is_capital' => false,
      ),
      42 => 
      array (
        'name' => 'شاوور',
        'is_capital' => false,
      ),
      43 => 
      array (
        'name' => 'شرافت',
        'is_capital' => false,
      ),
      44 => 
      array (
        'name' => 'شمس آباد',
        'is_capital' => false,
      ),
      45 => 
      array (
        'name' => 'شهر امام',
        'is_capital' => false,
      ),
      46 => 
      array (
        'name' => 'شوش',
        'is_capital' => false,
      ),
      47 => 
      array (
        'name' => 'شوشتر',
        'is_capital' => false,
      ),
      48 => 
      array (
        'name' => 'شیبان',
        'is_capital' => false,
      ),
      49 => 
      array (
        'name' => 'صالح شهر',
        'is_capital' => false,
      ),
      50 => 
      array (
        'name' => 'صفی آباد',
        'is_capital' => false,
      ),
      51 => 
      array (
        'name' => 'صیدون',
        'is_capital' => false,
      ),
      52 => 
      array (
        'name' => 'فتح المبین',
        'is_capital' => false,
      ),
      53 => 
      array (
        'name' => 'قلعه تل',
        'is_capital' => false,
      ),
      54 => 
      array (
        'name' => 'قلعه خواجه',
        'is_capital' => false,
      ),
      55 => 
      array (
        'name' => 'لالی',
        'is_capital' => false,
      ),
      56 => 
      array (
        'name' => 'مسجد سلیمان',
        'is_capital' => false,
      ),
      57 => 
      array (
        'name' => 'مشراگه',
        'is_capital' => false,
      ),
      58 => 
      array (
        'name' => 'مقاومت',
        'is_capital' => false,
      ),
      59 => 
      array (
        'name' => 'ملاثانی',
        'is_capital' => false,
      ),
      60 => 
      array (
        'name' => 'منصوریه',
        'is_capital' => false,
      ),
      61 => 
      array (
        'name' => 'میانرود',
        'is_capital' => false,
      ),
      62 => 
      array (
        'name' => 'میداود',
        'is_capital' => false,
      ),
      63 => 
      array (
        'name' => 'مینوشهر',
        'is_capital' => false,
      ),
      64 => 
      array (
        'name' => 'هفتگل',
        'is_capital' => false,
      ),
      65 => 
      array (
        'name' => 'هندیجان',
        'is_capital' => false,
      ),
      66 => 
      array (
        'name' => 'هویزه',
        'is_capital' => false,
      ),
      67 => 
      array (
        'name' => 'ویس',
        'is_capital' => false,
      ),
      68 => 
      array (
        'name' => 'چغامیش',
        'is_capital' => false,
      ),
      69 => 
      array (
        'name' => 'چم گلک',
        'is_capital' => false,
      ),
      70 => 
      array (
        'name' => 'چمران',
        'is_capital' => false,
      ),
      71 => 
      array (
        'name' => 'چوئبده',
        'is_capital' => false,
      ),
      72 => 
      array (
        'name' => 'کوت سیدنعیم',
        'is_capital' => false,
      ),
      73 => 
      array (
        'name' => 'کوت عبدالله',
        'is_capital' => false,
      ),
      74 => 
      array (
        'name' => 'گتوند',
        'is_capital' => false,
      ),
      75 => 
      array (
        'name' => 'گلگیر',
        'is_capital' => false,
      ),
      76 => 
      array (
        'name' => 'گوریه',
        'is_capital' => false,
      ),
    ),
  ),
  12 => 
  array (
    'name' => 'زنجان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'زنجان',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آب بر',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'ابهر',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'ارمخانخانه',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'حلب',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'خرمدره',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'دندی',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'زرین آباد',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'زرین رود',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'سجاس',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'سلطانیه',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'سهرورد',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'صائین قلعه',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'قیدار',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'ماه نشان',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'نوربهار',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'نیک پی',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'هیدج',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'چورزق',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'کرسف',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'گرماب',
        'is_capital' => false,
      ),
    ),
  ),
  13 => 
  array (
    'name' => 'سمنان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'سمنان',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آرادان',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'امیریه',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'ایوانکی',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'بسطام',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بیارجمند',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'دامغان',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'درجزین',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'دیباج',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'رودیان',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'سرخه',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'شاهرود',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'شهمیرزاد',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'مجن',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'مهدی شهر',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'میامی',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'کلاته',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'کلاته خیج',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'کهن آباد',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'گرمسار',
        'is_capital' => false,
      ),
    ),
  ),
  14 => 
  array (
    'name' => 'سیستان و بلوچستان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'زاهدان',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'ادیمی',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'اسپکه',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'ایرانشهر',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'بزمان',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بمپور',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بنت',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بنجار',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'جالق',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'خاش',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'دوست محمد',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'راسک',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'زابل',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'زرآباد',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'زهک',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'سراوان',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'سرباز',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'سوران',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'سیرکان',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'علی اکبر',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'فنوج',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'قصر قند',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'محمد آباد',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'محمدان',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'محمدی',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'مهرستان',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'میرجاوه',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'نصرت آباد',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'نوک آباد',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'نگور',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'نیک شهر',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'هیدوچ',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'پیشین',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'چاه بهار',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'کنارک',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'گشت',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'گلمورتی',
        'is_capital' => false,
      ),
    ),
  ),
  15 => 
  array (
    'name' => 'فارس',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'شیراز',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آباده',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آباده طشک',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'اردکان',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'ارسنجان',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'استهبان',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'اسیر',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'اشکنان',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'افزر',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'اقلید',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'امام شهر',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'اهل',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'اوز',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'ایج',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'ایزد خواست',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'باب انار',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'بابامنیر',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'بالاده',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'بنارویه',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'بهمن',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'بوانات',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'بیرم',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'بیضا',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'جنت شهر',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'جهرم',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'جویم',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'حاجی آباد',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'حسامی',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'حسن آباد',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'خانه زنیان',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'خانیمن',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'خاوران',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'خرامه',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'خشت',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'خنج',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'خور',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'خوزی',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'خومه زار',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'داراب',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'داریان',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'دبیران',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'دهرم',
        'is_capital' => false,
      ),
      42 => 
      array (
        'name' => 'دوبرجی',
        'is_capital' => false,
      ),
      43 => 
      array (
        'name' => 'دوزه',
        'is_capital' => false,
      ),
      44 => 
      array (
        'name' => 'دژکرد',
        'is_capital' => false,
      ),
      45 => 
      array (
        'name' => 'رامجرد',
        'is_capital' => false,
      ),
      46 => 
      array (
        'name' => 'رونیز',
        'is_capital' => false,
      ),
      47 => 
      array (
        'name' => 'زاهد شهر',
        'is_capital' => false,
      ),
      48 => 
      array (
        'name' => 'زرقان',
        'is_capital' => false,
      ),
      49 => 
      array (
        'name' => 'سده',
        'is_capital' => false,
      ),
      50 => 
      array (
        'name' => 'سروستان',
        'is_capital' => false,
      ),
      51 => 
      array (
        'name' => 'سعادت شهر',
        'is_capital' => false,
      ),
      52 => 
      array (
        'name' => 'سلطان شهر',
        'is_capital' => false,
      ),
      53 => 
      array (
        'name' => 'سورمق',
        'is_capital' => false,
      ),
      54 => 
      array (
        'name' => 'سیدان',
        'is_capital' => false,
      ),
      55 => 
      array (
        'name' => 'ششده',
        'is_capital' => false,
      ),
      56 => 
      array (
        'name' => 'شهر جدید صدرا',
        'is_capital' => false,
      ),
      57 => 
      array (
        'name' => 'شهر پیر',
        'is_capital' => false,
      ),
      58 => 
      array (
        'name' => 'صغاد',
        'is_capital' => false,
      ),
      59 => 
      array (
        'name' => 'صفا شهر',
        'is_capital' => false,
      ),
      60 => 
      array (
        'name' => 'علامرودشت',
        'is_capital' => false,
      ),
      61 => 
      array (
        'name' => 'عماد ده',
        'is_capital' => false,
      ),
      62 => 
      array (
        'name' => 'فدامی',
        'is_capital' => false,
      ),
      63 => 
      array (
        'name' => 'فراشبند',
        'is_capital' => false,
      ),
      64 => 
      array (
        'name' => 'فسا',
        'is_capital' => false,
      ),
      65 => 
      array (
        'name' => 'فیروزآباد',
        'is_capital' => false,
      ),
      66 => 
      array (
        'name' => 'قائمیه',
        'is_capital' => false,
      ),
      67 => 
      array (
        'name' => 'قادرآباد',
        'is_capital' => false,
      ),
      68 => 
      array (
        'name' => 'قره بلاغ',
        'is_capital' => false,
      ),
      69 => 
      array (
        'name' => 'قطب آباد',
        'is_capital' => false,
      ),
      70 => 
      array (
        'name' => 'قطرویه',
        'is_capital' => false,
      ),
      71 => 
      array (
        'name' => 'قیر',
        'is_capital' => false,
      ),
      72 => 
      array (
        'name' => 'لار',
        'is_capital' => false,
      ),
      73 => 
      array (
        'name' => 'لامرد',
        'is_capital' => false,
      ),
      74 => 
      array (
        'name' => 'لطیفی',
        'is_capital' => false,
      ),
      75 => 
      array (
        'name' => 'لپوئی',
        'is_capital' => false,
      ),
      76 => 
      array (
        'name' => 'مادرسلیمان',
        'is_capital' => false,
      ),
      77 => 
      array (
        'name' => 'مبارک آباد',
        'is_capital' => false,
      ),
      78 => 
      array (
        'name' => 'مرودشت',
        'is_capital' => false,
      ),
      79 => 
      array (
        'name' => 'مزایجان',
        'is_capital' => false,
      ),
      80 => 
      array (
        'name' => 'مشکان',
        'is_capital' => false,
      ),
      81 => 
      array (
        'name' => 'مصیری',
        'is_capital' => false,
      ),
      82 => 
      array (
        'name' => 'مهر',
        'is_capital' => false,
      ),
      83 => 
      array (
        'name' => 'میانشهر',
        'is_capital' => false,
      ),
      84 => 
      array (
        'name' => 'میمند',
        'is_capital' => false,
      ),
      85 => 
      array (
        'name' => 'نوبندگان',
        'is_capital' => false,
      ),
      86 => 
      array (
        'name' => 'نوجین',
        'is_capital' => false,
      ),
      87 => 
      array (
        'name' => 'نودان',
        'is_capital' => false,
      ),
      88 => 
      array (
        'name' => 'نورآباد',
        'is_capital' => false,
      ),
      89 => 
      array (
        'name' => 'نی ریز',
        'is_capital' => false,
      ),
      90 => 
      array (
        'name' => 'هماشهر',
        'is_capital' => false,
      ),
      91 => 
      array (
        'name' => 'وراوی',
        'is_capital' => false,
      ),
      92 => 
      array (
        'name' => 'کارزین',
        'is_capital' => false,
      ),
      93 => 
      array (
        'name' => 'کازرون',
        'is_capital' => false,
      ),
      94 => 
      array (
        'name' => 'کامفیروز',
        'is_capital' => false,
      ),
      95 => 
      array (
        'name' => 'کره ای',
        'is_capital' => false,
      ),
      96 => 
      array (
        'name' => 'کنار تخته',
        'is_capital' => false,
      ),
      97 => 
      array (
        'name' => 'کوار',
        'is_capital' => false,
      ),
      98 => 
      array (
        'name' => 'کوهنجان',
        'is_capital' => false,
      ),
      99 => 
      array (
        'name' => 'کوپن',
        'is_capital' => false,
      ),
      100 => 
      array (
        'name' => 'گراش',
        'is_capital' => false,
      ),
      101 => 
      array (
        'name' => 'گله دار',
        'is_capital' => false,
      ),
    ),
  ),
  16 => 
  array (
    'name' => 'قزوین',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'قزوین',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آبگرم',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آبیک',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'آوج',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'ارداق',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'اسفرورین',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'اقبالیه',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'الوند',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'بوئین زهرا',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'بیدستان',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'تاکستان',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'خاکعلی',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'خرمدشت',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'دانسفهان',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'رازمیان',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'سگز آباد',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'سیردان',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'شال',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'شریفیه',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'ضیاء آباد',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'محمدیه',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'محمود آباد نمونه',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'معلم کلایه',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'نرجه',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'کوهین',
        'is_capital' => false,
      ),
    ),
  ),
  17 => 
  array (
    'name' => 'قم',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'قم',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'جعفریه',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'دستجرد',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'سلفچگان',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'قنوات',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'کهک',
        'is_capital' => false,
      ),
    ),
  ),
  18 => 
  array (
    'name' => 'لرستان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'خرم آباد',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'ازنا',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'اشترینان',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'الشتر',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'الیگودرز',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بروجرد',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بیرانشهر',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'درب گنبد',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'دورود',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'زاغه',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'سراب دوره',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'سپید دشت',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'شول آباد',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'فیروزآباد',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'معمولان',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'مومن آباد',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'نورآباد',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'هفت چشمه',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'ویسیان',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'پلدختر',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'چالانچولان',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'چقابل',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'کوهدشت',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'کوهنانی',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'گراب',
        'is_capital' => false,
      ),
    ),
  ),
  19 => 
  array (
    'name' => 'مازندران',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'ساری',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آلاشت',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آمل',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'ارطه',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'امامزاده عبدالله',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'امیر کلا',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'ایزد شهر',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بابل',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'بابلسر',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'بلده',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'بهشهر',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'بهنمیر',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'تنکابن',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'جویبار',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'خرم آباد',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'خلیل شهر',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'خوش رودپی',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'دابودشت',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'رامسر',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'رستمکلا',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'رویان',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'رینه',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'زرگر محله',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'زیرآب',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'سرخرود',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'سلمان شهر',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'سورک',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'شیرود',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'شیرگاه',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'عباس آباد',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'فریدونکنار',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'فریم',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'قائم شهر',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'محمود آباد',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'مرزن آباد',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'مرزیکلا',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'نشتارود',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'نور',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'نوشهر',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'نکا',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'هادی شهر',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'هچیرود',
        'is_capital' => false,
      ),
      42 => 
      array (
        'name' => 'پایین هولار',
        'is_capital' => false,
      ),
      43 => 
      array (
        'name' => 'پل سفید',
        'is_capital' => false,
      ),
      44 => 
      array (
        'name' => 'پول',
        'is_capital' => false,
      ),
      45 => 
      array (
        'name' => 'چالوس',
        'is_capital' => false,
      ),
      46 => 
      array (
        'name' => 'چمستان',
        'is_capital' => false,
      ),
      47 => 
      array (
        'name' => 'کتالم و سادات شهر',
        'is_capital' => false,
      ),
      48 => 
      array (
        'name' => 'کجور',
        'is_capital' => false,
      ),
      49 => 
      array (
        'name' => 'کلارآباد',
        'is_capital' => false,
      ),
      50 => 
      array (
        'name' => 'کلاردشت',
        'is_capital' => false,
      ),
      51 => 
      array (
        'name' => 'کوهی خیل',
        'is_capital' => false,
      ),
      52 => 
      array (
        'name' => 'کیاسر',
        'is_capital' => false,
      ),
      53 => 
      array (
        'name' => 'کیاکلا',
        'is_capital' => false,
      ),
      54 => 
      array (
        'name' => 'گتاب',
        'is_capital' => false,
      ),
      55 => 
      array (
        'name' => 'گزنک',
        'is_capital' => false,
      ),
      56 => 
      array (
        'name' => 'گلوگاه',
        'is_capital' => false,
      ),
      57 => 
      array (
        'name' => 'گلوگاه',
        'is_capital' => false,
      ),
    ),
  ),
  20 => 
  array (
    'name' => 'مرکزی',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'اراک',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آستانه',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آشتیان',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'آوه',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'تفرش',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'توره',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'جاورسیان',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'خشکرود',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'خمین',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'خنجین',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'خنداب',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'داود آباد',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'دلیجان',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'رازقان',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'زاویه',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'ساروق',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'ساوه',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'شازند',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'شهباز',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'شهر جدید مهاجران',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'غرق آباد',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'فرمهین',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'قورچی باشی',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'مامونیه',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'محلات',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'میلاجرد',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'نراق',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'نوبران',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'نیمور',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'هندودر',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'پرندک',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'کارچان',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'کمیجان',
        'is_capital' => false,
      ),
    ),
  ),
  21 => 
  array (
    'name' => 'هرمزگان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'بندرعباس',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'ابوموسی',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'بستک',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'بندر جاسک',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'بندر عباس',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بندر لنگه',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بیکاه',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'تازیان پائین',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'تخت',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'تیرور',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'جناح',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'حاجی آباد',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'خمیر',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'درگهان',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'دشتی',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'دهبارز',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'رویدر',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'زیارتعلی',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'سردشت',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'سرگز',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'سندرک',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'سوزا',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'سیریک',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'فارغان',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'فین',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'قشم',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'قلعه قاضی',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'لمزان',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'میناب',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'هرمز',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'هشتبندی',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'پارسیان',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'چارک',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'کنگ',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'کوخردهرنگ',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'کوشکنار',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'کوهستک',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'کیش',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'گروک',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'گوهران',
        'is_capital' => false,
      ),
    ),
  ),
  22 => 
  array (
    'name' => 'همدان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'همدان',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آجین',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'ازندریان',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'اسد آباد',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'برزول',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بهار',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'تویسرکان',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'جورقان',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'جوکار',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'دمق',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'رزن',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'زنگنه',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'سامن',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'سرکان',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'شیرین سو',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'صالح آباد',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'فامنین',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'فرسفج',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'فیروزان',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'قروه در جزین',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'قهاوند',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'لالجین',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'مریانج',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'ملایر',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'مهاجران',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'نهاوند',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'کبودر آهنگ',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'گل تپه',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'گیان',
        'is_capital' => false,
      ),
    ),
  ),
  23 => 
  array (
    'name' => 'چهار محال و بختیاری',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'شهرکرد',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آلونی',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'اردل',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'باباحیدر',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'بازفت',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بروجن',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بلداجی',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بن',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'جونقان',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'دستناء',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'دشتک',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'سامان',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'سرخون',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'سردشت لردگان',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'سفید دشت',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'سودجان',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'سورشجان',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'شلمزار',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'صمصامی',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'طاقانک',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'فارسان',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'فرادنبه',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'فرخ شهر',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'لردگان',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'مال خلیفه',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'منج',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'ناغان',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'نافچ',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'نقنه',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'هارونی',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'هفشجان',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'وردنجان',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'پردنجان',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'چلگرد',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'چلیچه',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'کاج',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'کیان',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'گندمان',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'گهرو',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'گوجان',
        'is_capital' => false,
      ),
    ),
  ),
  24 => 
  array (
    'name' => 'کردستان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'سنندج',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آرمرده',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'اورامان تخت',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'بابارشانی',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'بانه',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'برده رشه',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بلبان آباد',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بوئین سفلی',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'بیجار',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'توپ آغاج',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'دزج',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'دلبران',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'دهگلان',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'دیواندره',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'زرینه',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'سرو آباد',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'سریش آباد',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'سقز',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'شویشه',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'صاحب',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'قروه',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'مریوان',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'موچش',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'پیرتاج',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'چناره',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'کامیاران',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'کانی دینار',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'کانی سور',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'یاسوکند',
        'is_capital' => false,
      ),
    ),
  ),
  25 => 
  array (
    'name' => 'کرمان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'کرمان',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'اختیار آباد',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'ارزوئیه',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'امین شهر',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'انار',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'اندوهجرد',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'باغین',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بافت',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'بردسیر',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'بروات',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'بزنجان',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'بلورد',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'بلوک',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'بم',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'بهرمان',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'جبالبارز',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'جوزم',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'جوپار',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'جیرفت',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'خاتون آباد',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'خانوک',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'خواجوشهر',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'خورسند',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'درب بهشت',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'دشتکار',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'دهج',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'دوساری',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'رابر',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'راور',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'راین',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'رفسنجان',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'رودبار',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'ریحان',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'زرند',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'زنگی آباد',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'زهکلوت',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'زید آباد',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'سیرجان',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'شهداد',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'شهر بابک',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'صفائیه',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'عنبر آباد',
        'is_capital' => false,
      ),
      42 => 
      array (
        'name' => 'فاریاب',
        'is_capital' => false,
      ),
      43 => 
      array (
        'name' => 'فهرج',
        'is_capital' => false,
      ),
      44 => 
      array (
        'name' => 'قلعه گنج',
        'is_capital' => false,
      ),
      45 => 
      array (
        'name' => 'لاله زار',
        'is_capital' => false,
      ),
      46 => 
      array (
        'name' => 'ماهان',
        'is_capital' => false,
      ),
      47 => 
      array (
        'name' => 'محمد آباد',
        'is_capital' => false,
      ),
      48 => 
      array (
        'name' => 'محی آباد',
        'is_capital' => false,
      ),
      49 => 
      array (
        'name' => 'مردهک',
        'is_capital' => false,
      ),
      50 => 
      array (
        'name' => 'مس سرچشمه',
        'is_capital' => false,
      ),
      51 => 
      array (
        'name' => 'منوجان',
        'is_capital' => false,
      ),
      52 => 
      array (
        'name' => 'نجف شهر',
        'is_capital' => false,
      ),
      53 => 
      array (
        'name' => 'نرماشیر',
        'is_capital' => false,
      ),
      54 => 
      array (
        'name' => 'نظام شهر',
        'is_capital' => false,
      ),
      55 => 
      array (
        'name' => 'نودژ',
        'is_capital' => false,
      ),
      56 => 
      array (
        'name' => 'نگار',
        'is_capital' => false,
      ),
      57 => 
      array (
        'name' => 'هجدک',
        'is_capital' => false,
      ),
      58 => 
      array (
        'name' => 'هماشهر',
        'is_capital' => false,
      ),
      59 => 
      array (
        'name' => 'هنزا',
        'is_capital' => false,
      ),
      60 => 
      array (
        'name' => 'پاریز',
        'is_capital' => false,
      ),
      61 => 
      array (
        'name' => 'چترود',
        'is_capital' => false,
      ),
      62 => 
      array (
        'name' => 'کاظم آباد',
        'is_capital' => false,
      ),
      63 => 
      array (
        'name' => 'کشکوئیه',
        'is_capital' => false,
      ),
      64 => 
      array (
        'name' => 'کهنوج',
        'is_capital' => false,
      ),
      65 => 
      array (
        'name' => 'کوهبنان',
        'is_capital' => false,
      ),
      66 => 
      array (
        'name' => 'کیانشهر',
        'is_capital' => false,
      ),
      67 => 
      array (
        'name' => 'گلباف',
        'is_capital' => false,
      ),
      68 => 
      array (
        'name' => 'گلزار',
        'is_capital' => false,
      ),
      69 => 
      array (
        'name' => 'گنبکی',
        'is_capital' => false,
      ),
      70 => 
      array (
        'name' => 'یزدان شهر',
        'is_capital' => false,
      ),
    ),
  ),
  26 => 
  array (
    'name' => 'کرمانشاه',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'کرمانشاه',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'ازگله',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'اسلام آباد غرب',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'بانوره',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'باینگان',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بیستون',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'تازه آباد',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'جوانرود',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'حمیل',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'رباط',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'روانسر',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'ریجاب',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'سر پل ذهاب',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'سرمست',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'سطر',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'سنقر',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'سومار',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'شاهو',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'صحنه',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'قصر شیرین',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'میان راهان',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'نودشه',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'نوسود',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'هرسین',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'هلشی',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'پاوه',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'کرند غرب',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'کنگاور',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'کوزران',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'گهواره',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'گودین',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'گیلانغرب',
        'is_capital' => false,
      ),
    ),
  ),
  27 => 
  array (
    'name' => 'کهگیلویه و بویراحمد',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'یاسوج',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'باشت',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'دهدشت',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'دوگنبدان',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'دیشموک',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'سرفاریاب',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'سوق',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'سی سخت',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'قلعه رئیسی',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'لنده',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'لیکک',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'مادوان',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'مارگون',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'پاتاوه',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'چرام',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'چیتاب',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'گراب سفلی',
        'is_capital' => false,
      ),
    ),
  ),
  28 => 
  array (
    'name' => 'گلستان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'گرگان',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آزاد شهر',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آق قلا',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'انبار آلوم',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'اینچه برون',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بندر ترکمن',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بندر گز',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'تاتار علیا',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'جلین',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'خان ببین',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'دلند',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'رامیان',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'سرخنکلاته',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'سنگدوین',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'سیمین شهر',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'علی آباد',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'فاضل آباد',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'فراغی',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'مراوه تپه',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'مزرعه',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'مینودشت',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'نوده خاندوز',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'نوکنده',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'نگین شهر',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'کرد کوی',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'کلاله',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'گالیکش',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'گمیش تپه',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'گنبدکاووس',
        'is_capital' => false,
      ),
    ),
  ),
  29 => 
  array (
    'name' => 'گیلان',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'رشت',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'آستارا',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'آستانه اشرفیه',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'احمد سرگوراب',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'اسالم',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'اطاقور',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'املش',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بازار جمعه',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'بره سر',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'بندر انزلی',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'توتکابن',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'جیرنده',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'حویق',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'خشکبیجار',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'خمام',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'دیلمان',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'رانکوه',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'رحیم آباد',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'رستم آباد',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'رضوانشهر',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'رودبار',
        'is_capital' => false,
      ),
      21 => 
      array (
        'name' => 'رودبنه',
        'is_capital' => false,
      ),
      22 => 
      array (
        'name' => 'رودسر',
        'is_capital' => false,
      ),
      23 => 
      array (
        'name' => 'سنگر',
        'is_capital' => false,
      ),
      24 => 
      array (
        'name' => 'سیاهکل',
        'is_capital' => false,
      ),
      25 => 
      array (
        'name' => 'شفت',
        'is_capital' => false,
      ),
      26 => 
      array (
        'name' => 'شلمان',
        'is_capital' => false,
      ),
      27 => 
      array (
        'name' => 'صومعه سرا',
        'is_capital' => false,
      ),
      28 => 
      array (
        'name' => 'فومن',
        'is_capital' => false,
      ),
      29 => 
      array (
        'name' => 'لاهیجان',
        'is_capital' => false,
      ),
      30 => 
      array (
        'name' => 'لشت نشاء',
        'is_capital' => false,
      ),
      31 => 
      array (
        'name' => 'لنگرود',
        'is_capital' => false,
      ),
      32 => 
      array (
        'name' => 'لوشان',
        'is_capital' => false,
      ),
      33 => 
      array (
        'name' => 'لولمان',
        'is_capital' => false,
      ),
      34 => 
      array (
        'name' => 'لوندویل',
        'is_capital' => false,
      ),
      35 => 
      array (
        'name' => 'لیسار',
        'is_capital' => false,
      ),
      36 => 
      array (
        'name' => 'ماسال',
        'is_capital' => false,
      ),
      37 => 
      array (
        'name' => 'ماسوله',
        'is_capital' => false,
      ),
      38 => 
      array (
        'name' => 'ماکلوان',
        'is_capital' => false,
      ),
      39 => 
      array (
        'name' => 'مرجقل',
        'is_capital' => false,
      ),
      40 => 
      array (
        'name' => 'منجیل',
        'is_capital' => false,
      ),
      41 => 
      array (
        'name' => 'هشتپر',
        'is_capital' => false,
      ),
      42 => 
      array (
        'name' => 'واجارگاه',
        'is_capital' => false,
      ),
      43 => 
      array (
        'name' => 'پره سر',
        'is_capital' => false,
      ),
      44 => 
      array (
        'name' => 'چابکسر',
        'is_capital' => false,
      ),
      45 => 
      array (
        'name' => 'چاف و چمخاله',
        'is_capital' => false,
      ),
      46 => 
      array (
        'name' => 'چوبر',
        'is_capital' => false,
      ),
      47 => 
      array (
        'name' => 'کلاچای',
        'is_capital' => false,
      ),
      48 => 
      array (
        'name' => 'کومله',
        'is_capital' => false,
      ),
      49 => 
      array (
        'name' => 'کوچصفهان',
        'is_capital' => false,
      ),
      50 => 
      array (
        'name' => 'کیاشهر',
        'is_capital' => false,
      ),
      51 => 
      array (
        'name' => 'گوراب زرمیخ',
        'is_capital' => false,
      ),
    ),
  ),
  30 => 
  array (
    'name' => 'یزد',
    'cities' => 
    array (
      0 => 
      array (
        'name' => 'یزد',
        'is_capital' => true,
      ),
      1 => 
      array (
        'name' => 'ابرکوه',
        'is_capital' => false,
      ),
      2 => 
      array (
        'name' => 'احمد آباد',
        'is_capital' => false,
      ),
      3 => 
      array (
        'name' => 'اردکان',
        'is_capital' => false,
      ),
      4 => 
      array (
        'name' => 'اشکذر',
        'is_capital' => false,
      ),
      5 => 
      array (
        'name' => 'بافق',
        'is_capital' => false,
      ),
      6 => 
      array (
        'name' => 'بفروئیه',
        'is_capital' => false,
      ),
      7 => 
      array (
        'name' => 'بهاباد',
        'is_capital' => false,
      ),
      8 => 
      array (
        'name' => 'تفت',
        'is_capital' => false,
      ),
      9 => 
      array (
        'name' => 'حمیدیا',
        'is_capital' => false,
      ),
      10 => 
      array (
        'name' => 'خضر آباد',
        'is_capital' => false,
      ),
      11 => 
      array (
        'name' => 'زارچ',
        'is_capital' => false,
      ),
      12 => 
      array (
        'name' => 'شاهدیه',
        'is_capital' => false,
      ),
      13 => 
      array (
        'name' => 'عقدا',
        'is_capital' => false,
      ),
      14 => 
      array (
        'name' => 'مروست',
        'is_capital' => false,
      ),
      15 => 
      array (
        'name' => 'مهردشت',
        'is_capital' => false,
      ),
      16 => 
      array (
        'name' => 'مهریز',
        'is_capital' => false,
      ),
      17 => 
      array (
        'name' => 'میبد',
        'is_capital' => false,
      ),
      18 => 
      array (
        'name' => 'ندوشن',
        'is_capital' => false,
      ),
      19 => 
      array (
        'name' => 'نیر',
        'is_capital' => false,
      ),
      20 => 
      array (
        'name' => 'هرات',
        'is_capital' => false,
      ),
    ),
  ),
);

        foreach ($data as $row) {
            $province = Province::updateOrCreate(['name' => $row['name']]);
            foreach ($row['cities'] as $city) {
                City::updateOrCreate(
                    ['province_id' => $province->id, 'name' => $city['name']],
                    ['priority' => $city['is_capital'] ? 100 : 0]
                );
            }
        }
    }
}
