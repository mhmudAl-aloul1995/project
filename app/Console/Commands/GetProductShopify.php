<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

class GetProductShopify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'recreate the CSV file by ready the data coming thru shopify API';

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

        $url = "https://e8fe1882da2563489067f68a20a5d716:94ec0b61a90951a56de989f8ca32da8b@sellenvo.myshopify.com/admin/products.json?";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        if($result === false)
        {
            $this->info(curl_error($ch));
            return false;
        }

        $decode_result = json_decode($result);


        (new FastExcel($decode_result->products))->export('products.csv', function ($product) {
            if (is_array($product->tags)) {
                $product->tags = implode($product->tags);
            }
            return [
                'Title' => $product->title,
                'Body' => $product->body_html,
                'Vendor' => $product->vendor,
                'Tags' => $product->tags,
            ];
        });

        $this->info('recreate the CSV file by ready the data coming thru shopify API');

        curl_close($ch);


    }
}
