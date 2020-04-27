<?php

use Illuminate\Database\Seeder;
use App\Subject;
class SubjectSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create( [
            'id'=>1,
            'title_ar'=>'كيمياء',
            'title_en'=>'Chemistry',
            'slug_ar'=>'كيمياء',
            'slug_en'=>'chemistry',
            'created_at'=>'2020-04-25 16:42:13',
            'updated_at'=>'2020-04-25 16:42:13'
        ] );

        Subject::create( [
            'id'=>2,
            'title_ar'=>'احياء',
            'title_en'=>'Biology',
            'slug_ar'=>'احياء',
            'slug_en'=>'biology',
            'created_at'=>'2020-04-25 16:42:43',
            'updated_at'=>'2020-04-25 16:42:43'
        ] );

        Subject::create( [
            'id'=>3,
            'title_ar'=>'لغة عربية',
            'title_en'=>'Arabic Language',
            'slug_ar'=>'لغة-عربية',
            'slug_en'=>'arabic-language',
            'created_at'=>'2020-04-25 16:43:11',
            'updated_at'=>'2020-04-25 16:43:11'
        ] );

        Subject::create( [
            'id'=>4,
            'title_ar'=>'علم نفس',
            'title_en'=>'psychology',
            'slug_ar'=>'علم-نفس',
            'slug_en'=>'psychology',
            'created_at'=>'2020-04-25 16:43:38',
            'updated_at'=>'2020-04-25 16:43:38'
        ] );

        Subject::create( [
            'id'=>5,
            'title_ar'=>'جغرافية',
            'title_en'=>'geography',
            'slug_ar'=>'جغرافية',
            'slug_en'=>'geography',
            'created_at'=>'2020-04-25 16:44:04',
            'updated_at'=>'2020-04-25 16:44:04'
        ] );
    }
}
