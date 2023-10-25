<?php

use Phinx\Seed\AbstractSeed;

class ProductsSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Water',
                'unity' => 20,
                'price' => 0.65,
                'icon_url' => 'https://purepng.com/public/uploads/large/purepng.com-ice-water-bottle-aquafinabottle-water-drink-aquafina-9415246348499t1u0.png'
            ],
            [
                'name' => 'Juice',
                'unity' => 30,
                'price' => 1.0,
                'icon_url' => 'https://www.pepsicoschoolsource.com/prod/s3fs-public/styles/pepsico_school_source_product_image_style_for_mobile_fallback/public/2021-06/Tropicana%C2%AE%20Orange%20Juice%20-%2010oz..png?itok=vQJcENmA'
            ],
            [
                'name' => 'Soda',
                'unity' => 12,
                'price' => 1.5,
                'icon_url' => 'https://i.pinimg.com/originals/fe/79/a7/fe79a77d57b98386b8c05706eec0bd84.png'
            ],
        ];

        $this->insert('Products', $products);
    }
}
