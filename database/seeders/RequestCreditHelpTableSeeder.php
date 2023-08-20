<?php

namespace Database\Seeders;

use App\Models\RequestCreditHelp;
use Illuminate\Database\Seeder;

class RequestCreditHelpTableSeeder extends Seeder
{
    public function run()
    {
        $requestCreditHelp = [
            [
                'id' => 1,
                'type' => 'placeholders',
                'attribute' => 'Others',
                'attribute_2' => '',
                'attribute_3' => '',
            ],
            [
                'id' => 2,
                'type' => 'brands',
                'attribute' => 'Honda',
                'attribute_2' => '',
                'attribute_3' => '',
            ],
            [
                'id' => 3,
                'type' => 'dealers',
                'attribute' => 'Honda Sukun',
                'attribute_2' => '',
                'attribute_3' => '',
            ],
            [
                'id' => 4,
                'type' => 'insurances',
                'attribute' => 'Insurances',
                'attribute_2' => '',
                'attribute_3' => '',
            ],
            [
                'id' => 5,
                'type' => 'products',
                'attribute' => 'Products',
                'attribute_2' => '',
                'attribute_3' => '',
            ],
            [
                'id' => 6,
                'type' => 'tenors',
                'attribute' => '5',
                'attribute_2' => '',
                'attribute_3' => '',
            ],
            [
                'id' => 7,
                'type' => 'years',
                'attribute' => '2015',
                'attribute_2' => '',
                'attribute_3' => '',
            ],
            [
                'id' => 8,
                'type' => 'years',
                'attribute' => '2012',
                'attribute_2' => '',
                'attribute_3' => '',
            ],
        ];

        RequestCreditHelp::insert($requestCreditHelp);
    }
}
