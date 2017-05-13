<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	DB::table('address')->insert(
            [
        		[
                    'name' => 'Cần Thơ'
        		],
        		[
                    'name' => 'Đà Nẵng'
        		],
                [
                    'name' => 'Hà Nội'
        		],
                [
                    'name' => 'TP HCM'
        		],
                [
                    'name' => 'Hải Phòng'
        		],
                [
                    'name' => 'An Giang'
        		],
                [
                    'name' => 'Bà Rịa - Vũng tàu'
        		],
                [
                    'name' => 'Bắc Giang'
        		],
                [
                    'name' => 'Bắc Kạn'
        		],
                [
                    'name' => 'Bạc Liêu'
        		],
                [
                    'name' => 'Bắc Ninh'
        		],
                [
                    'name' => 'Bến Tre'
        		],
                [
                    'name' => 'Bình Định'
        		],
                [
                    'name' => 'Bình Dương'
        		],
                [
                    'name' => 'Bình Phước'
        		],
                [
                    'name' => 'Bình Thuận'
        		],
                [
                    'name' => 'Cà Mau'
        		],
                [
                    'name' => 'Cao Bằng'
        		],
                [
                    'name' => 'Đắk Lắk'
        		],
                [
                    'name' => 'Đắk Nông'
        		],
                [
                    'name' => 'Điện Biên'
        		],
                [
                    'name' => 'Đồng Nai'
        		],
                [
                    'name' => 'Đồng Tháp'
        		],
                [
                    'name' => 'Gia Lai'
        		],
                [
                    'name' => 'Hà Giang'
        		],
                [
                    'name' => 'Hà Nam'
        		],
                [
                    'name' => 'Hà Tỉnh'
        		],
                [
                    'name' => 'Hải Dương'
        		],
                [
                    'name' => 'Hậu Giang'
        		],
                [
                    'name' => 'Hòa Bình'
        		],
                [
                    'name' => 'Hưng Yên'
        		],
                [
                    'name' => 'Khánh Hòa'
        		],
                [
                    'name' => 'Kiên Giang'
        		],
                [
                    'name' => 'Kon Tum'
        		],
                [
                    'name' => 'Lai Châu'
        		],
                [
                    'name' => 'Lâm Đồng'
        		],
                [
                    'name' => 'Lạng Sơn'
        		],
                [
                    'name' => 'Lào Cai'
        		],
                [
                    'name' => 'Long An'
        		],
                [
                    'name' => 'Nam Định'
        		],
                [
                    'name' => 'Nghệ An'
        		],
                [
                    'name' => 'Ninh Bình'
        		],
                [
                    'name' => 'Ninh Thuận'
        		],
                [
                    'name' => 'Phú Thọ'
        		],
                [
                    'name' => 'Quảng Bình'
        		],
                [
                    'name' => 'Quảng Nam'
        		],
                [
                    'name' => 'Quãng Ngãi'
        		],
                [
                    'name' => 'Quãng Ninh'
        		],
                [
                    'name' => 'Quãng Trị'
        		],
                [
                    'name' => 'Sóc Trăng'
        		],
                [
                    'name' => 'Sơn La'
        		],
                [
                    'name' => 'Tây Ninh'
        		],
                [
                    'name' => 'Thái Bình'
        		],
                [
                    'name' => 'Thái Nguyên'
        		],
                [
                    'name' => 'Thanh Hóa'
        		],
                [
                        'name' => 'Huế'
        		],
                [
                    'name' => 'Tiền Giang'
        		],
                [
                        'name' => 'Trà Vinh'
        		],
                [
                        'name' => 'Tuyên Quang'
        		],
                [
                    'name' => 'Vĩnh Long'
        		],
                [
                    'name' => 'Vĩnh Phúc'
        		],
                [
                    'name' => 'Yên Bái'
        		],
                [
                    'name' => 'Phú Yên'
        		]             
            ]
    	);
    }

}
