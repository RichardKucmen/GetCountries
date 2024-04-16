<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchAndStoreData extends Command
{
    protected $signature = 'fetch-and-store:data';
    protected $description = 'Command description';

    /**
     * Handles the command execution by fetching and storing countries data.
     * 
     * This method invokes the fetchDataAndStore method from the CountriesController to fetch data about European countries from an external API and store it in the database. Upon successful execution, it displays a message indicating that the countries data has been fetched and saved to the database.
     */
    public function handle()
    {
        app(\App\Http\Controllers\CountriesController::class)->fetchDataAndStore();
        $this->info('Countries data fetched and saved to database.');
    }
}
