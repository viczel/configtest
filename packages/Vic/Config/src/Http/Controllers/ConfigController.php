<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30.03.2018
 * Time: 14:11
 */
namespace BrainySoft\Config\Http\Controllers;

use App\Http\Controllers\Controller;
use BrainySoft\Config\Models\Mfo;

class ConfigController extends Controller
{

    /**
     * @return $this
     */
    public function customerList() {

        $mfoList = Mfo::get()->all();
        return view('configs::customerList')->with('mfoList', $mfoList);
    }


    /**
     * @param string $customer_key
     *
     * @return $this
     */
    public function customerSettings($customer_key = '') {
        $mfo = Mfo::where('name', $customer_key)
            ->with('settings', 'settings.type')
            ->firstOrFail();
        return view('configs::customerSettings')->with('mfo', $mfo);
    }


}