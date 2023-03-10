<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Reset cached roles and permissions
      app()[PermissionRegistrar::class]->forgetCachedPermissions();

      // create permissions
      Permission::create(['name' => 'users.create']);
      Permission::create(['name' => 'users.edit']);
      Permission::create(['name' => 'users.index']);
      Permission::create(['name' => 'users.show']);
      Permission::create(['name' => 'users.delete']);

      Permission::create(['name' => 'roles.create']);
      Permission::create(['name' => 'roles.edit']);
      Permission::create(['name' => 'roles.index']);
      Permission::create(['name' => 'roles.show']);
      Permission::create(['name' => 'roles.delete']);

      Permission::create(['name' => 'permissions.create']);
      Permission::create(['name' => 'permissions.edit']);
      Permission::create(['name' => 'permissions.index']);
      Permission::create(['name' => 'permissions.show']);
      Permission::create(['name' => 'permissions.delete']);

      
      // create roles and assign existing permissions
      $administratorrole = Role::create(['name' => 'administrator']);
      $administratorrole->givePermissionTo('users.create');
      $administratorrole->givePermissionTo('users.edit');
      $administratorrole->givePermissionTo('users.index');
      $administratorrole->givePermissionTo('users.show');
      $administratorrole->givePermissionTo('users.delete');
      $administratorrole->givePermissionTo('roles.create');
      $administratorrole->givePermissionTo('roles.edit');
      $administratorrole->givePermissionTo('roles.index');
      $administratorrole->givePermissionTo('roles.delete');
      $administratorrole->givePermissionTo('permissions.create');
      $administratorrole->givePermissionTo('permissions.edit');
      $administratorrole->givePermissionTo('permissions.index');
      $administratorrole->givePermissionTo('permissions.delete');

     $administrator = User::create([
      'name' => 'Toaa Tokoia', 
      'email' => 'toaat@mfmrd.gov.ki',
      'password' => bcrypt('2'),
     

      ]);

    $administrator->assignRole($administratorrole);

//training permissions
    Permission::create(['name' => 'island.index']);
    Permission::create(['name' => 'island.village']);
    Permission::create(['name' => 'island.create']);
    Permission::create(['name' => 'island.store']);
    Permission::create(['name' => 'island.export']);
    Permission::create(['name' => 'island.show']);
    Permission::create(['name' => 'island.edit']);
    Permission::create(['name' => 'island.update']);
    Permission::create(['name' => 'island.delete']);

    Permission::create(['name' => 'training.index']);
    Permission::create(['name' => 'training.islandList']);
    Permission::create(['name' => 'training.create']);
    Permission::create(['name' => 'training.store']);
    Permission::create(['name' => 'training.export']);
    Permission::create(['name' => 'training.show']);
    Permission::create(['name' => 'training.edit']);
    Permission::create(['name' => 'training.update']);
    Permission::create(['name' => 'training.delete']);

    Permission::create(['name' => 'training_type.index']);
    Permission::create(['name' => 'training_type.create']);
    Permission::create(['name' => 'training_type.store']);
    Permission::create(['name' => 'training_type.export']);
    Permission::create(['name' => 'training_type.show']);
    Permission::create(['name' => 'training_type.edit']);
    Permission::create(['name' => 'training_type.update']);
    Permission::create(['name' => 'training_type.delete']);

    Permission::create(['name' => 'village.index']);
    Permission::create(['name' => 'village.create']);
    Permission::create(['name' => 'village.store']);
    Permission::create(['name' => 'village.export']);
    Permission::create(['name' => 'village.show']);
    Permission::create(['name' => 'village.edit']);
    Permission::create(['name' => 'village.update']);
    Permission::create(['name' => 'village.delete']);


     // create roles and assign existing permissions
     $trainerrole = Role::create(['name' => 'trainer']);
     $trainerrole->givePermissionTo('users.create');
     $trainerrole->givePermissionTo('island.index');
     $trainerrole->givePermissionTo('island.village');
     $trainerrole->givePermissionTo('island.create');
     $trainerrole->givePermissionTo('island.store');
     $trainerrole->givePermissionTo('island.export');
     $trainerrole->givePermissionTo('island.show');
     $trainerrole->givePermissionTo('island.edit');
     $trainerrole->givePermissionTo('island.update');
     $trainerrole->givePermissionTo('island.delete');
 
     $trainerrole->givePermissionTo('training.index');
     $trainerrole->givePermissionTo('training.islandList');
     $trainerrole->givePermissionTo('training.create');
     $trainerrole->givePermissionTo('training.store');
     $trainerrole->givePermissionTo('training.export');
     $trainerrole->givePermissionTo('training.show');
     $trainerrole->givePermissionTo('training.edit');
     $trainerrole->givePermissionTo('training.update');
     $trainerrole->givePermissionTo('training.delete');
 
     $trainerrole->givePermissionTo('training_type.index');
     $trainerrole->givePermissionTo('training_type.create');
     $trainerrole->givePermissionTo('training_type.store');
     $trainerrole->givePermissionTo('training_type.export');
     $trainerrole->givePermissionTo('training_type.show');
     $trainerrole->givePermissionTo('training_type.edit');
     $trainerrole->givePermissionTo('training_type.update');
     $trainerrole->givePermissionTo('training_type.delete');
 
     $trainerrole->givePermissionTo('village.index');
     $trainerrole->givePermissionTo('village.create');
     $trainerrole->givePermissionTo('village.store');
     $trainerrole->givePermissionTo('village.export');
     $trainerrole->givePermissionTo('village.show');
     $trainerrole->givePermissionTo('village.edit');
     $trainerrole->givePermissionTo('village.update');
     $trainerrole->givePermissionTo('village.delete');


     $trainer = User::create([
      'name' => 'Rotia Tabua', 
      'email' => 'rotia@fisheries.gov.ki',
      'password' => bcrypt('2'),
     

      ]);

      $trainer->assignRole($trainerrole);
 

    }
}
