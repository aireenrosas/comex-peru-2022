<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategoriesTableSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'email' => 'mchirinos@apros.pe',
            'name' => 'Mónica',
            'autor' => 'ComexAd',
            'password' => bcrypt('123456')
        ]);


    }
  }
class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            'name_es' => 'Semanario',
            'name_en' => 'Weekly'
        ]);
        DB::table('categories')->insert([
            'name_es' => 'Agrocomex',
            'name_en' => 'Agrocomex'
        ]);
        DB::table('categories')->insert([
            'name_es' => 'DataComex',
            'name_en' => 'DataComex'
        ]);
        DB::table('categories')->insert([
            'name_es' => 'Memoria Anual',
            'name_en' => 'Annual Memory'
        ]);
        DB::table('categories')->insert([
            'name_es' => 'Revista Negocios',
            'name_en' => 'Business magazine'
        ]);

    }
  }

  class TagsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tags')->delete();

        DB::table('tags')->insert([
            'name_es' => 'Comercio Exterior',
            'name_en' => 'Weekly'
        ]);
        DB::table('tags')->insert([
            'name_es' => 'Infraestructura',
            'name_en' => 'Infraestructure'
        ]);
        DB::table('tags')->insert([
            'name_es' => 'Educación',
            'name_en' => 'Education'
        ]);
        DB::table('tags')->insert([
            'name_es' => 'Salud',
            'name_en' => 'Health'
        ]);
        DB::table('tags')->insert([
            'name_es' => 'Empleo',
            'name_en' => 'Job'
        ]);
        DB::table('tags')->insert([
            'name_es' => 'Minería',
            'name_en' => 'Mining'
        ]);
        DB::table('tags')->insert([
            'name_es' => 'Energía',
            'name_en' => 'Energy'
        ]);
        DB::table('tags')->insert([
            'name_es' => 'Economía',
            'name_en' => 'Economy'
        ]);

    }
}
