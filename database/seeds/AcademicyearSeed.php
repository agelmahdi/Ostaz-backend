<?php

use Illuminate\Database\Seeder;
use App\AcademicYear;
class AcademicyearSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Academicyear::create( [
            'id'=>1,
            'title_ar'=>'الصف الاول الابتدائي',
            'title_en'=>'First grade',
            'slug_ar'=>'الصف-الاول-الابتدائي',
            'slug_en'=>'first-grade',
            'created_at'=>'2020-04-23 16:46:01',
            'updated_at'=>'2020-04-23 16:46:01'
        ] );

        Academicyear::create( [
            'id'=>2,
            'title_ar'=>'الصف الثانى الابتدائي',
            'title_en'=>'The second primary grade',
            'slug_ar'=>'الصف-الثانى-الابتدائي',
            'slug_en'=>'the-second-primary-grade',
            'created_at'=>'2020-04-23 16:46:40',
            'updated_at'=>'2020-04-23 16:46:40'
        ] );

        Academicyear::create( [
            'id'=>3,
            'title_ar'=>'الصف الثالث الابتدائي',
            'title_en'=>'The third primary grade',
            'slug_ar'=>'الصف-الثالث-الابتدائي',
            'slug_en'=>'the-third-primary-grade',
            'created_at'=>'2020-04-23 16:47:07',
            'updated_at'=>'2020-04-23 16:47:07'
        ] );

        Academicyear::create( [
            'id'=>4,
            'title_ar'=>'الصف الرابع الابتدائي',
            'title_en'=>'fourth grade',
            'slug_ar'=>'الصف-الرابع-الابتدائي',
            'slug_en'=>'fourth-grade',
            'created_at'=>'2020-04-23 16:47:34',
            'updated_at'=>'2020-04-23 16:47:34'
        ] );

        Academicyear::create( [
            'id'=>5,
            'title_ar'=>'الصف الخامس الابتدائي',
            'title_en'=>'Fifth grade primary',
            'slug_ar'=>'الصف-الخامس-الابتدائي',
            'slug_en'=>'fifth-grade-primary',
            'created_at'=>'2020-04-23 16:48:06',
            'updated_at'=>'2020-04-23 16:48:06'
        ] );

        Academicyear::create( [
            'id'=>6,
            'title_ar'=>'الصف السادس الابتدائي',
            'title_en'=>'The sixth grade of primary school',
            'slug_ar'=>'الصف-السادس-الابتدائي',
            'slug_en'=>'the-sixth-grade-of-primary-school',
            'created_at'=>'2020-04-23 16:48:42',
            'updated_at'=>'2020-04-23 16:48:42'
        ] );

        Academicyear::create( [
            'id'=>7,
            'title_ar'=>'الصف الاول الاعدادي',
            'title_en'=>'seventh grade',
            'slug_ar'=>'الصف-الاول-الاعدادي',
            'slug_en'=>'seventh-grade',
            'created_at'=>'2020-04-23 16:49:14',
            'updated_at'=>'2020-04-23 16:49:14'
        ] );

        Academicyear::create( [
            'id'=>8,
            'title_ar'=>'الصف الثاني الاعدادي',
            'title_en'=>'The second year of middle school',
            'slug_ar'=>'الصف-الثاني-الاعدادي',
            'slug_en'=>'the-second-year-of-middle-school',
            'created_at'=>'2020-04-23 16:49:33',
            'updated_at'=>'2020-04-23 16:49:33'
        ] );

        Academicyear::create( [
            'id'=>9,
            'title_ar'=>'الصف الثالث الاعدادي',
            'title_en'=>'The third preparatory grade',
            'slug_ar'=>'الصف-الثالث-الاعدادي',
            'slug_en'=>'the-third-preparatory-grade',
            'created_at'=>'2020-04-23 16:50:03',
            'updated_at'=>'2020-04-23 16:50:03'
        ] );

        Academicyear::create( [
            'id'=>10,
            'title_ar'=>'الصف الاول الثانوي',
            'title_en'=>'First grade secondary',
            'slug_ar'=>'الصف-الاول-الثانوي',
            'slug_en'=>'first-grade-secondary',
            'created_at'=>'2020-04-23 16:50:27',
            'updated_at'=>'2020-04-23 16:50:27'
        ] );

        Academicyear::create( [
            'id'=>11,
            'title_ar'=>'الصف الثاني الثانوي',
            'title_en'=>'Secondary second grade',
            'slug_ar'=>'الصف-الثاني-الثانوي',
            'slug_en'=>'secondary-second-grade',
            'created_at'=>'2020-04-23 16:50:54',
            'updated_at'=>'2020-04-23 16:50:54'
        ] );

        Academicyear::create( [
            'id'=>12,
            'title_ar'=>'الصف الثالث الثانوي',
            'title_en'=>'Secondary third grade',
            'slug_ar'=>'الصف-الثالث-الثانوي',
            'slug_en'=>'secondary-third-grade',
            'created_at'=>'2020-04-23 16:51:27',
            'updated_at'=>'2020-04-23 16:51:27'
        ] );
    }
}
