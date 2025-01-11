<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Str;
use App\Models\Currency;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    function getTitle(){
        $title=Setting::where(['key' => 'site.title'])->value('value');
        return $title;
    }

    function getdescription(){
        $description=Setting::where(['key' => 'site.description'])->value('value');
        return $description;
    }

    function getkeywords(){
        $keywords= Setting::where(['key' => 'site.keywords'])->value('value');
        return $keywords;
    }

    function getphone(){
        $phone = Setting::where('key','site.phone')->value('value');
        return $phone;
    }
    function getphoneother(){
        $phoneother = Setting::where('key','site.phoneother')->value('value');
        return $phoneother;
    }
    function getwhatsapp(){
        $whatsapp = Setting::where('key','site.whatsapp')->value('value');
        return $whatsapp;
    }
    function getemail(){
        $email=Setting::where('key','site.email')->value('value');
        return $email;
    }
    function getaddress(){
        $address=Setting::where('key','site.address')->value('value');
        return $address;
    }

    function getshorabout(){
        $shorabout=Setting::where('key','site.shorabout')->value('value');
        return $shorabout;
    }

    function getcurrencies(){
        $currencies=Currency::orderBy('id', 'ASC')->get();
        return $currencies;
    }

    

    public function boot()
    {
        try{
            view()->share('title',$this->getTitle());
            view()->share('description',$this->getdescription());
            view()->share('keywords',$this->getkeywords());
            view()->share('phone',$this->getphone());
            view()->share('phoneother',$this->getphoneother());
            view()->share('whatsapp',$this->getwhatsapp());
            view()->share('email',$this->getemail());
            view()->share('address',$this->getaddress());  
            view()->share('currencies',$this->getcurrencies());  
        } catch (\Exception $e) {
        }
    }
}
