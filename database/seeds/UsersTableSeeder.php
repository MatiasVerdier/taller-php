<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {    
    $users = factory(App\User::class, 5)
      ->create()
      ->each(function($user) {
        $links = factory(App\Resource::class, 5)->states('LINK')->make();
        $size = $links->count();
        
        for ($i = 0; $i < $size; $i++) {
          $user->resources()->save($links->pop());
        }
        
        $markdown = factory(App\Resource::class, 5)->states('MARKDOWN')->make();
        $size = $markdown->count();
        
        for ($i = 0; $i < $size; $i++) {
          $user->resources()->save($markdown->pop());
        }
        
        $code = factory(App\Resource::class, 5)->states('CODE')->make();
        $size = $code->count();
        
        for ($i = 0; $i < $size; $i++) {
          $user->resources()->save($code->pop());
        }
      });
  }
}
