<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogHasilModel;

class CurrencyListController extends BaseController
{

    public function __construct()
    {
        $this->LogHasilModel = new LogHasilModel();
    }

    public function index()
    {
        $site = 'https://api-exchange-rates.herokuapp.com/list-currency';
        $content = file_get_contents($site);
        $listCurrency = json_decode($content, true);


        $data = [
            'currencyList' => $listCurrency,
        ];

        return view('currency-list', $data);
    }

    public function hitung()
    {
        $dari = $this->request->getVar('dari');
        $ke = $this->request->getVar('ke');
        $amount = $this->request->getVar('amount');

        $hasilObject = 'https://api-exchange-rates.herokuapp.com/calculator?from=' . $dari . '&to=' . $ke . '&amount=' . $amount;
        $contentss = file_get_contents($hasilObject);
        $sites = json_decode($contentss);

        var_dump($sites{'data'});

        $data = [
            'title' => $sites
        ];

        return redirect()->to('/hasil-cv');
    }

    public function hasilCv()
    {
        $var = $this->hitung();
        $hasil = $var->sites;

        $data = [
            'hasil' => $hasil
        ];

      

        return view('hasil-cv');
    }
}
