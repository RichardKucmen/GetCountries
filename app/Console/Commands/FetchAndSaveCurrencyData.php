<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Currencies;

class FetchAndSaveCurrencyData extends Command
{
    protected $signature = 'fetch-and-save:currency';
    protected $description = 'Fetch currency data from XML and save to database';
    /**
     * Handles the command execution by fetching and storing currency data.
     * 
     * This method retrieves currency exchange rate data from the European Central Bank (ECB) website in XML format, converts it to a PHP array, and then iterates over each currency entry to store it in the database. Each currency entry includes the currency code and its corresponding exchange rate. Upon successful execution, it displays a message indicating that the currency data has been fetched and saved to the database.
    */
    public function handle()
    {
        $xmlString = file_get_contents('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');
        $xmlObject = simplexml_load_string($xmlString);
                    
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true); 
   
        foreach($phpArray['Cube']['Cube']['Cube'] as $item){
            Currencies::create([
                    "currency" => $item["@attributes"]["currency"],
                    "rate" => $item["@attributes"]["rate"]
            ]);
        }

        $this->info('Currency data fetched and saved to database.');
    }
}
