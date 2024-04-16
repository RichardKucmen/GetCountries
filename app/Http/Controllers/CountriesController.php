<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\Currencies;
use Illuminate\Support\Facades\Http;
class CountriesController extends Controller
{
     /** 
     * Retrieves all countries' data from the database.
     * 
     * @return mixed Returns a view containing the data for all countries.
    */
    public function getCountries(){
        $countries = Countries::select('common_name','flag')->get();;
        return view("countries_list", ["countries"=>$countries]);
    }

    /**
     * Retrieves information about a specific country and its currency.
     * 
     * This function retrieves information about a country with the given common name from the database. If no country with the specified name is found, it returns an error view indicating that no data is available. If currency data is available in the database, it fetches the currency information associated with the country and returns it along with the country information in a view for further processing and display.
     * 
     * @param string $country_name The common name of the country.
     * @return \Illuminate\Contracts\View\View Returns a view containing information about the country and its currency, or an error view if no data is available.
 */
    public function getCountry($country_name){
        $country = Countries::where('common_name', $country_name)->first();
        if(Currencies::all()->isEmpty()){
            $error = "Error: No data";
            return view("error", ["error" => $error]);
        } else{
            $currency = Currencies::where('currency', $country->currencies)->get();
            return view("country", ["country" => $country, "currency" => $currency]);
        }
        
    }

    /**
     * Fetches data about European countries from an external API and stores it in the database.
     * 
     * This function retrieves information such as name, flags, capital, population, currencies, languages, and timezones for European countries from a REST API. It then processes this data and stores it in the local database. If a country already exists in the database, it updates the existing entry with the new data. Otherwise, it creates a new entry for the country.
    */
    public function fetchDataAndStore(){
        $response = Http::get("https://restcountries.com/v3.1/region/europe?fields=name,flags,capital,population,currencies,languages,timezones");
        if($response->successful()){
            $data = $response->json();
            foreach ($data as $item){
                $language = "";
                $timezone = "";

                foreach ($item["currencies"] as $currencyCode => $currency){
                    $currency_name = $currency["name"];
                }
                foreach ($item["languages"] as $languagesCode => $languages) {
                    $language .= $languages. ", ";
                }
                foreach ($item["timezones"] as $timezones){
                    $timezone .= $timezones . ", ";
                }

                $language = rtrim($language, ", ");
                $timezone = rtrim($timezone, ", ");

                $existingItem = Countries::where('official_name', $item["name"]["official"])->first();
                if($existingItem){
                    $updateData = [];
                    if ($existingItem->common_name !== $item["name"]["common"]) {
                        $updateData['common_name'] = $item["name"]["common"];
                    }
                    if ($existingItem->capital !== $item["capital"][0]) {
                        $updateData['capital'] = $item["capital"][0];
                    }
                    if ($existingItem->population !== $item["population"]) {
                        $updateData['population'] = $item["population"];
                    }
                    if ($existingItem->timezones !== $timezone) {
                        $updateData['timezones'] = $timezone;
                    }
                    if ($existingItem->flag !== $item["flags"]["png"]) {
                        $updateData['flag'] = $item["flags"]["png"];
                    }
                    if ($existingItem->currencies !== $currencyCode) {
                        $updateData['currencies'] = $currencyCode;
                    }
                    if ($existingItem->currency_name !== $currency_name) {
                        $updateData['currency_name'] = $currency_name;
                    }
                    if ($existingItem->languages !== $language) {
                        $updateData['languages'] = $language;
                    }
                    $existingItem->update($updateData);
                } else{
                    Countries::create([
                        'official_name' => $item["name"]["official"],
                        'common_name' => $item["name"]["common"],
                        'capital' => $item["capital"][0],
                        'population' => $item["population"],
                        'timezones' => $timezone,
                        'flag' => $item["flags"]["png"],
                        'currencies' => $currencyCode,
                        'currency_name' => $currency_name,
                        'languages' => $language
                    ]);
                }
              }
            }
          }
}
