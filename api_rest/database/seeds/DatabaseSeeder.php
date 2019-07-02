<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('games')->insert([['name'=>'God of war','genero'=>'Ação', 'idade_indicativa'=>12,'preco'=> 10.0]]);
        DB::table('animes')->insert([['name'=>'Dragon Ball','genero'=>'Ação', 'idade_indicativa'=>1,'episodios' => 220]]);
      }
}
