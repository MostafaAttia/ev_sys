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
        Eloquent::unguard();

        $this->call(CountriesSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(PaymentGatewaySeeder::class);
        $this->call(QuestionTypesSeeder::class);
        $this->call(TicketStatusSeeder::class);
        $this->call(TimezoneSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(WeekDaysTableSeeder::class);
    }
}
