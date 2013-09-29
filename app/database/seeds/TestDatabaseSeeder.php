<?php

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('TestMasterSeeder');
    }
}

/**
 * This class seeds all tables needed for authentication and authorization
 *
 * @tables: users, roles, role_user, permissions
 */
class TestMasterSeeder extends Seeder
{
    public function run()
    {
        /**
         * This statement allows tables with foreign keys to be truncated.
         * It does not technically need to be turned back on since it is
         * a per connection setting and will reset itself.
         */
        DB::table('users')->truncate();
        DB::table('profiles')->truncate();
        DB::table('settings')->truncate();
        DB::table('privacy')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permissions')->truncate();

        $timestamp = new DateTime;

        // Users //////////////////////////////////////////////////////////////
        DB::table('users')->insert([
            [
                'email'      => 'admin@everyequity.com',
                'password'   => Hash::make('black'),
                'activated'  => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'email'      => 'moderator@everyequity.com',
                'password'   => Hash::make('black'),
                'activated'  => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'email'      => 'user@everyequity.com',
                'password'   => Hash::make('black'),
                'activated'  => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]
        ]);

        // Profiles ///////////////////////////////////////////////////////////
        DB::table('profiles')->insert([
            [
                'user_id'    => 1,
                'first_name' => 'Elliot',
                'last_name'  => 'Fleming',
                'gender'     => 'M',
                'city'       => 'New Orleans', 
                'state'      => 'LA',
                'birthday'   => date("Y-m-d H:i:s", strtotime('November 28, 1985')),
                'about'      => 'I made this thing.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'user_id'    => 2,
                'first_name' => 'Rodger',
                'last_name'  => 'Fleming',
                'gender'     => 'M',
                'city'       => 'New Orleans', 
                'state'      => 'LA',
                'birthday'   => date("Y-m-d H:i:s", strtotime('November 28, 1985')),
                'about'      => 'I made this thing.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'user_id'    => 3,
                'first_name' => 'Erin',
                'last_name'  => 'McGrail',
                'gender'     => 'F',
                'city'       => 'New Orleans', 
                'state'      => 'LA',
                'birthday'   => date("Y-m-d H:i:s", strtotime('July 11, 1987')),
                'about'      => 'I made this thing.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]
        ]);

        // Settings ///////////////////////////////////////////////////////////
        DB::table('settings')->insert([
            ['user_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['user_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['user_id' => 3, 'created_at' => $timestamp, 'updated_at' => $timestamp]
        ]);

        // Privacy ////////////////////////////////////////////////////////////
        DB::table('privacy')->insert([
            ['user_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['user_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['user_id' => 3, 'created_at' => $timestamp, 'updated_at' => $timestamp]
        ]);

        // Roles //////////////////////////////////////////////////////////////
        DB::table('roles')->insert([
            ['name' => 'cofounder'],
            ['name' => 'founder'],
            ['name' => 'investor'],
            ['name' => 'admin']
        ]);

        // Role-User Pivot ////////////////////////////////////////////////////
        DB::table('role_user')->insert([
            ['role_id' => 4, 'user_id' => 1],
            ['role_id' => 4, 'user_id' => 2],
            ['role_id' => 1, 'user_id' => 3]
        ]);

        // Permissions ////////////////////////////////////////////////////////
        DB::table('permissions')->insert([
            [
                'user_id'    => 1,
                'type'       => 'allow',
                'action'     => 'superuser',
                'resource'   => 'all',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]
        ]);
    }
}
