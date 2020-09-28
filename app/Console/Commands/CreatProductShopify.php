<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Rap2hpoutre\FastExcel\FastExcel;

class CreatProductShopify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'extract items from the product export file and create products in shopify using API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = (new FastExcel)->import(storage_path('shop1.csv'), function ($cell) {


            if ($cell['Tags'] != null || "") {
                $tags = explode("4", $cell['Tags']);
            }


            $url = "https://e8fe1882da2563489067f68a20a5d716:94ec0b61a90951a56de989f8ca32da8b@sellenvo.myshopify.com/admin/products.json";
            $product = ['title' => $cell['Title'], 'body_html' => $cell['Body (HTML)'], 'vendor' => $cell['Vendor'], 'tags' => $cell['Tags']];
            $encode_product = json_encode(array("product" => $product));

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $encode_product);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            if($result === false)
            {
                $this->info(curl_error($ch));
                return false;
            }
            $decode_result = json_decode($result)->product->id;

            curl_close($ch);

        });
        $this->info('Successfully created product in shopify');

    }
}
