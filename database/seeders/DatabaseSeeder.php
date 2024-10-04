<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BasicModels\Departments;
use App\Models\BasicModels\OrderCountry;
use App\Models\BasicModels\OrderCurrencies;
use App\Models\BasicModels\OrderServices;
use App\Models\BasicModels\OrderWebsites;
use App\Models\BasicModels\UserDesignations;
use App\Models\BasicModels\WriterSkills;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Departments::insert([
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Department_Name' => 'SEO'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Department_Name' => 'Admin'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Department_Name' => 'Content Writing'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Department_Name' => 'HR'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Department_Name' => 'Sales & Marketing'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Department_Name' => 'Web Designer'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Department_Name' => 'Digital Marketer'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Department_Name' => 'Research Writing'
            ],
            [
                'Department_Name' => 'Web Development',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        WriterSkills::insert([
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Skill_Name' => 'CV Writing'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Skill_Name' => 'Ebook Writing'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Skill_Name' => 'Article and Blog Writing'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Skill_Name' => 'Story Writing / Novels / Poems'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Skill_Name' => 'Web Content Writing'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Skill_Name' => 'Copyrighting'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Skill_Name' => 'Categories For Content'
            ]
        ]);

        OrderServices::insert([
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Service_Name' => ' Assignment'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Service_Name' => ' Case Study'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Service_Name' => 'Dissertation'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Service_Name' => 'PPT'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Service_Name' => 'Proposal'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Service_Name' => 'Question & Answer'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Service_Name' => 'Research Paper'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Service_Name' => 'Thesis'
            ],
            [
                'Service_Name' => 'Critical Review',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'Service_Name' => 'Editing/Formatting',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'Service_Name' => 'Essay Writing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'Service_Name' => 'Letter of intent needed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'Service_Name' => 'Literature Review',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'Service_Name' => 'Re-Writing/ Paraphrasing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'Service_Name' => 'Reflective Summary',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'Service_Name' => 'Research Report',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'Service_Name' => 'Term Paper',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
        ]);

        OrderWebsites::insert([
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Website_Name' => 'Danish-Designing'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Website_Name' => 'Ruby'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Website_Name' => 'Imran - Developer'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Website_Name' => 'Imran - Upwork'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Website_Name' => '1click Writers'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Website_Name' => 'Anisa'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Website_Name' => 'Rabia'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Website_Name' => 'Essay Buddies'
            ],
            [
                'Website_Name' => 'Ghulam',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'Website_Name' => 'Melissa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'Website_Name' => 'Isabella',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'Website_Name' => 'One Click',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        UserDesignations::insert([
            [	'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Administrator'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'HR'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Web Developer'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Research Manager'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Re-Search Coordinator'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Re-Search Writer'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Independent Research Writer'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Independent Content Writer'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Sales Manager'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Sales Coordinator'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Sales Executive'
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'Designation_Name' => 'Content Writer'
            ]
        ]);

        $currencies = [
            array('code' =>'AFN' , 'name' => 'Afghani', 'symbol' => '؋' ),
            array('code' =>'ALL' , 'name' => 'Lek', 'symbol' => 'Lek' ),
            array('code' =>'ANG' , 'name' => 'Netherlands Antillean Guilder', 'symbol' => 'ƒ' ),
            array('code' =>'ARS' , 'name' => 'Argentine Peso', 'symbol' => '$' ),
            array('code' =>'AUD' , 'name' => 'Australian Dollar', 'symbol' => '$' ),
            array('code' =>'AWG' , 'name' => 'Aruba Guilder', 'symbol' => 'ƒ' ),
            array('code' =>'AZN' , 'name' => 'Azerbaijani Mana', 'symbol' => 'ман' ),
            array('code' =>'BAM' , 'name' => 'Convertible Marks', 'symbol' => 'KM' ),
            array('code' =>'BBD' , 'name' => 'Barbados Dollar', 'symbol' => '$' ),
            array('code' =>'BGN' , 'name' => 'Bulgarian Lev', 'symbol' => 'лв' ),
            array('code' =>'BMD' , 'name' => 'Bermudian Dollar', 'symbol' => '$' ),
            array('code' =>'BND' , 'name' => 'Brunei Dollar', 'symbol' => '$' ),
            array('code' =>'BOB' , 'name' => 'BOV Bolivian modal', 'symbol' => '$b' ),
            array('code' =>'BRL' , 'name' => 'Brazilian Real', 'symbol' => 'R$' ),
            array('code' =>'BSD' , 'name' => 'Bahamian Dollar', 'symbol' => '$' ),
            array('code' =>'BWP' , 'name' => 'Pull', 'symbol' => 'P' ),
            array('code' =>'BYR' , 'name' => 'Belarussian Ruble', 'symbol' => 'p.' ),
            array('code' =>'BZD' , 'name' => 'Belize Dollar', 'symbol' => 'BZ$' ),
            array('code' =>'CAD' , 'name' => 'Canadian Dollar', 'symbol' => '$' ),
            array('code' =>'CHF' , 'name' => 'Swiss Franc', 'symbol' => 'CHF' ),
            array('code' =>'CLP' , 'name' => 'CLF Chilean Peso Unidades de fomento', 'symbol' => '$' ),
            array('code' =>'CNY' , 'name' => 'Yuan Renminbi', 'symbol' => '¥' ),
            array('code' =>'COP' , 'name' => 'COU Colombian Peso Unidad de Valor Real', 'symbol' => '$' ),
            array('code' =>'CRC' , 'name' => 'Costa Rican Colon', 'symbol' => '₡' ),
            array('code' =>'CUP' , 'name' => 'CUC Cuban Peso Peso Convertible', 'symbol' => '₱' ),
            array('code' =>'CZK' , 'name' => 'Czech Koruna', 'symbol' => 'Kč' ),
            array('code' =>'DKK' , 'name' => 'Danish Krone', 'symbol' => 'kr' ),
            array('code' =>'DOP' , 'name' => 'Dominican Peso', 'symbol' => 'RD$' ),
            array('code' =>'EGP' , 'name' => 'Egyptian Pound', 'symbol' => '£' ),
            array('code' =>'EUR' , 'name' => 'Euro', 'symbol' => '€' ),
            array('code' =>'FJD' , 'name' => 'Fiji Dollar', 'symbol' => '$' ),
            array('code' =>'FKP' , 'name' => 'Falkland Islands Pound', 'symbol' => '£' ),
            array('code' =>'GBP' , 'name' => 'Pound Sterling', 'symbol' => '£' ),
            array('code' =>'GIP' , 'name' => 'Gibraltar Pound', 'symbol' => '£' ),
            array('code' =>'GTQ' , 'name' => 'Quetzal', 'symbol' => 'Q' ),
            array('code' =>'GYD' , 'name' => 'Guyana Dollar', 'symbol' => '$' ),
            array('code' =>'HKD' , 'name' => 'Hong Kong Dollar', 'symbol' => '$' ),
            array('code' =>'HNL' , 'name' => 'Lempira', 'symbol' => 'L' ),
            array('code' =>'HRK' , 'name' => 'Croatian Kuna', 'symbol' => 'kn' ),
            array('code' =>'HUF' , 'name' => 'Forint', 'symbol' => 'Ft' ),
            array('code' =>'IDR' , 'name' => 'Rupiah', 'symbol' => 'Rp' ),
            array('code' =>'ILS' , 'name' => 'New Israeli Sheqel', 'symbol' => '₪' ),
            array('code' =>'IRR' , 'name' => 'Iranian Rial', 'symbol' => '﷼' ),
            array('code' =>'ISK' , 'name' => 'Iceland Krona', 'symbol' => 'kr' ),
            array('code' =>'JMD' , 'name' => 'Jamaican Dollar', 'symbol' => 'J$' ),
            array('code' =>'JPY' , 'name' => 'Yen', 'symbol' => '¥' ),
            array('code' =>'KGS' , 'name' => 'Som', 'symbol' => 'лв' ),
            ['code' =>'KHR' , 'name' => 'Riel', 'symbol' => '៛'],
            array('code' =>'KPW' , 'name' => 'North Korean Won', 'symbol' => '₩' ),
            array('code' =>'KRW' , 'name' => 'Won', 'symbol' => '₩' ),
            array('code' =>'KYD' , 'name' => 'Cayman Islands Dollar', 'symbol' => '$' ),
            array('code' =>'KZT' , 'name' => 'Tenge', 'symbol' => 'лв' ),
            array('code' =>'LAK' , 'name' => 'Kip', 'symbol' => '₭' ),
            array('code' =>'LBP' , 'name' => 'Lebanese Pound', 'symbol' => '£' ),
            array('code' =>'LKR' , 'name' => 'Sri Lanka Rupee', 'symbol' => '₨' ),
            array('code' =>'LRD' , 'name' => 'Liberian Dollar', 'symbol' => '$' ),
            array('code' =>'LTL' , 'name' => 'Lithuanian Litas', 'symbol' => 'Lt' ),
            array('code' =>'LVL' , 'name' => 'Latvian Lats', 'symbol' => 'Ls' ),
            array('code' =>'MKD' , 'name' => 'Denar', 'symbol' => 'ден' ),
            array('code' =>'MNT' , 'name' => 'Tugrik', 'symbol' => '₮' ),
            array('code' =>'MUR' , 'name' => 'Mauritius Rupee', 'symbol' => '₨' ),
            array('code' =>'MXN' , 'name' => 'MXV Mexican Peso Mexican Unidad de Inversion (UDI)', 'symbol' => '$' ),
            array('code' =>'MYR' , 'name' => 'Malaysian Ringgit', 'symbol' => 'RM' ),
            array('code' =>'MZN' , 'name' => 'Metical', 'symbol' => 'MT' ),
            array('code' =>'NGN' , 'name' => 'Naira', 'symbol' => '₦' ),
            array('code' =>'NIO' , 'name' => 'Cordoba Oro', 'symbol' => 'C$' ),
            array('code' =>'NOK' , 'name' => 'Norwegian Krone', 'symbol' => 'kr' ),
            array('code' =>'NPR' , 'name' => 'Nepalese Rupee', 'symbol' => '₨' ),
            array('code' =>'NZD' , 'name' => 'New Zealand Dollar', 'symbol' => '$' ),
            array('code' =>'OMR' , 'name' => 'Rial Omani', 'symbol' => '﷼' ),
            array('code' =>'PAB' , 'name' => 'USD Balboa US Dollar', 'symbol' => 'B/.' ),
            array('code' =>'PEN' , 'name' => 'Nuevo Sol', 'symbol' => 'S/.' ),
            array('code' =>'PHP' , 'name' => 'Philippine Peso', 'symbol' => 'Php' ),
            array('code' =>'PKR' , 'name' => 'Pakistan Rupee', 'symbol' => '₨' ),
            array('code' =>'PLN' , 'name' => 'Zloty', 'symbol' => 'zł' ),
            array('code' =>'PYG' , 'name' => 'Guarani', 'symbol' => 'Gs' ),
            array('code' =>'QAR' , 'name' => 'Qatari Rial', 'symbol' => '﷼' ),
            array('code' =>'RON' , 'name' => 'New Leu', 'symbol' => 'lei' ),
            array('code' =>'RSD' , 'name' => 'Serbian Dinar', 'symbol' => 'Дин.' ),
            array('code' =>'RUB' , 'name' => 'Russian Ruble', 'symbol' => 'руб' ),
            array('code' =>'SAR' , 'name' => 'Saudi Riyal', 'symbol' => '﷼' ),
            array('code' =>'SBD' , 'name' => 'Solomon Islands Dollar', 'symbol' => '$' ),
            array('code' =>'SCR' , 'name' => 'Seychelles Rupee', 'symbol' => '₨' ),
            array('code' =>'SEK' , 'name' => 'Swedish Krona', 'symbol' => 'kr' ),
            array('code' =>'SGD' , 'name' => 'Singapore Dollar', 'symbol' => '$' ),
            array('code' =>'SHP' , 'name' => 'Saint Helena Pound', 'symbol' => '£' ),
            array('code' =>'SOS' , 'name' => 'Somali Shilling', 'symbol' => 'S' ),
            array('code' =>'SRD' , 'name' => 'Surinam Dollar', 'symbol' => '$' ),
            array('code' =>'SVC' , 'name' => 'USD El Salvador Colon US Dollar', 'symbol' => '$' ),
            array('code' =>'SYP' , 'name' => 'Syrian Pound', 'symbol' => '£' ),
            array('code' =>'THB' , 'name' => 'Baht', 'symbol' => '฿' ),
            array('code' =>'TRY' , 'name' => 'Turkish Lira', 'symbol' => 'TL' ),
            array('code' =>'TTD' , 'name' => 'Trinidad and Tobago Dollar', 'symbol' => 'TT$' ),
            array('code' =>'TWD' , 'name' => 'New Taiwan Dollar', 'symbol' => 'NT$' ),
            array('code' =>'UAH' , 'name' => 'Hryvnia', 'symbol' => '₴' ),
            array('code' =>'USD' , 'name' => 'US Dollar', 'symbol' => '$' ),
            array('code' =>'UYU' , 'name' => 'UYI Peso Uruguayo Uruguay Peso en Unidades Indexadas', 'symbol' => '$U' ),
            array('code' =>'UZS' , 'name' => 'Uzbekistan Sum', 'symbol' => 'лв' ),
            array('code' =>'VEF' , 'name' => 'Bolivar Fuerte', 'symbol' => 'Bs' ),
            array('code' =>'VND' , 'name' => 'Dong', 'symbol' => '₫' ),
            array('code' =>'XCD' , 'name' => 'East Caribbean Dollar', 'symbol' => '$' ),
            array('code' =>'YER' , 'name' => 'Yemeni Rial', 'symbol' => '﷼' ),
            array('code' =>'ZAR' , 'name' => 'Rand', 'symbol' => 'R' ),
        ];
        OrderCurrencies::insert($currencies);

        OrderCountry::insert([
            ['name' => 'Afghanistan', 'code' => 'AF'],
            ['name' => 'Åland Islands', 'code' => 'AX'],
            ['name' => 'Albania', 'code' => 'AL'],
            ['name' => 'Algeria', 'code' => 'DZ'],
            ['name' => 'American Samoa', 'code' => 'AS'],
            ['name' => 'Andorra', 'code' => 'AD'],
            ['name' => 'Angola', 'code' => 'AO'],
            ['name' => 'Anguilla', 'code' => 'AI'],
            ['name' => 'Antarctica', 'code' => 'AQ'],
            ['name' => 'Antigua and Barbuda', 'code' => 'AG'],
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'Armenia', 'code' => 'AM'],
            ['name' => 'Aruba', 'code' => 'AW'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Austria', 'code' => 'AT'],
            ['name' => 'Azerbaijan', 'code' => 'AZ'],
            ['name' => 'Bahamas', 'code' => 'BS'],
            ['name' => 'Bahrain', 'code' => 'BH'],
            ['name' => 'Bangladesh', 'code' => 'BD'],
            ['name' => 'Barbados', 'code' => 'BB'],
            ['name' => 'Belarus', 'code' => 'BY'],
            ['name' => 'Belgium', 'code' => 'BE'],
            ['name' => 'Belize', 'code' => 'BZ'],
            ['name' => 'Benin', 'code' => 'BJ'],
            ['name' => 'Bermuda', 'code' => 'BM'],
            ['name' => 'Bhutan', 'code' => 'BT'],
            ['name' => 'Bolivia, Plurinational State of', 'code' => 'BO'],
            ['name' => 'Bonaire, Sint Eustatius and Saba', 'code' => 'BQ'],
            ['name' => 'Bosnia and Herzegovina', 'code' => 'BA'],
            ['name' => 'Botswana', 'code' => 'BW'],
            ['name' => 'Bouvet Island', 'code' => 'BV'],
            ['name' => 'Brazil', 'code' => 'BR'],
            ['name' => 'British Indian Ocean Territory', 'code' => 'IO'],
            ['name' => 'Brunei Darussalam', 'code' => 'BN'],
            ['name' => 'Bulgaria', 'code' => 'BG'],
            ['name' => 'Burkina Faso', 'code' => 'BF'],
            ['name' => 'Burundi', 'code' => 'BI'],
            ['name' => 'Cambodia', 'code' => 'KH'],
            ['name' => 'Cameroon', 'code' => 'CM'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'Cape Verde', 'code' => 'CV'],
            ['name' => 'Cayman Islands', 'code' => 'KY'],
            ['name' => 'Central African Republic', 'code' => 'CF'],
            ['name' => 'Chad', 'code' => 'TD'],
            ['name' => 'Chile', 'code' => 'CL'],
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'Christmas Island', 'code' => 'CX'],
            ['name' => 'Cocos (Keeling) Islands', 'code' => 'CC'],
            ['name' => 'Colombia', 'code' => 'CO'],
            ['name' => 'Comoros', 'code' => 'KM'],
            ['name' => 'Congo', 'code' => 'CG'],
            ['name' => 'Congo, the Democratic Republic of the', 'code' => 'CD'],
            ['name' => 'Cook Islands', 'code' => 'CK'],
            ['name' => 'Costa Rica', 'code' => 'CR'],
            ['name' => 'Côte d\'Ivoire', 'code' => 'CI'],
            ['name' => 'Croatia', 'code' => 'HR'],
            ['name' => 'Cuba', 'code' => 'CU'],
            ['name' => 'Curaçao', 'code' => 'CW'],
            ['name' => 'Cyprus', 'code' => 'CY'],
            ['name' => 'Czech Republic', 'code' => 'CZ'],
            ['name' => 'Denmark', 'code' => 'DK'],
            ['name' => 'Djibouti', 'code' => 'DJ'],
            ['name' => 'Dominica', 'code' => 'DM'],
            ['name' => 'Dominican Republic', 'code' => 'DO'],
            ['name' => 'Ecuador', 'code' => 'EC'],
            ['name' => 'Egypt', 'code' => 'EG'],
            ['name' => 'El Salvador', 'code' => 'SV'],
            ['name' => 'Equatorial Guinea', 'code' => 'GQ'],
            ['name' => 'Eritrea', 'code' => 'ER'],
            ['name' => 'Estonia', 'code' => 'EE'],
            ['name' => 'Ethiopia', 'code' => 'ET'],
            ['name' => 'Falkland Islands (Malvinas)', 'code' => 'FK'],
            ['name' => 'Faroe Islands', 'code' => 'FO'],
            ['name' => 'Fiji', 'code' => 'FJ'],
            ['name' => 'Finland', 'code' => 'FI'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'French Guiana', 'code' => 'GF'],
            ['name' => 'French Polynesia', 'code' => 'PF'],
            ['name' => 'French Southern Territories', 'code' => 'TF'],
            ['name' => 'Gabon', 'code' => 'GA'],
            ['name' => 'Gambia', 'code' => 'GM'],
            ['name' => 'Georgia', 'code' => 'GE'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'Ghana', 'code' => 'GH'],
            ['name' => 'Gibraltar', 'code' => 'GI'],
            ['name' => 'Greece', 'code' => 'GR'],
            ['name' => 'Greenland', 'code' => 'GL'],
            ['name' => 'Grenada', 'code' => 'GD'],
            ['name' => 'Guadeloupe', 'code' => 'GP'],
            ['name' => 'Guam', 'code' => 'GU'],
            ['name' => 'Guatemala', 'code' => 'GT'],
            ['name' => 'Guernsey', 'code' => 'GG'],
            ['name' => 'Guinea', 'code' => 'GN'],
            ['name' => 'Guinea-Bissau', 'code' => 'GW'],
            ['name' => 'Guyana', 'code' => 'GY'],
            ['name' => 'Haiti', 'code' => 'HT'],
            ['name' => 'Heard Island and McDonald Mcdonald Islands', 'code' => 'HM'],
            ['name' => 'Holy See (Vatican City State)', 'code' => 'VA'],
            ['name' => 'Honduras', 'code' => 'HN'],
            ['name' => 'Hong Kong', 'code' => 'HK'],
            ['name' => 'Hungary', 'code' => 'HU'],
            ['name' => 'Iceland', 'code' => 'IS'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Indonesia', 'code' => 'ID'],
            ['name' => 'Iran, Islamic Republic of', 'code' => 'IR'],
            ['name' => 'Iraq', 'code' => 'IQ'],
            ['name' => 'Ireland', 'code' => 'IE'],
            ['name' => 'Isle of Man', 'code' => 'IM'],
            ['name' => 'Israel', 'code' => 'IL'],
            ['name' => 'Italy', 'code' => 'IT'],
            ['name' => 'Jamaica', 'code' => 'JM'],
            ['name' => 'Japan', 'code' => 'JP'],
            ['name' => 'Jersey', 'code' => 'JE'],
            ['name' => 'Jordan', 'code' => 'JO'],
            ['name' => 'Kazakhstan', 'code' => 'KZ'],
            ['name' => 'Kenya', 'code' => 'KE'],
            ['name' => 'Kiribati', 'code' => 'KI'],
            ['name' => 'Korea, Democratic People\'s Republic of', 'code' => 'KP'],
            ['name' => 'Korea, Republic of', 'code' => 'KR'],
            ['name' => 'Kuwait', 'code' => 'KW'],
            ['name' => 'Kyrgyzstan', 'code' => 'KG'],
            ['name' => 'Lao People\'s Democratic Republic', 'code' => 'LA'],
            ['name' => 'Latvia', 'code' => 'LV'],
            ['name' => 'Lebanon', 'code' => 'LB'],
            ['name' => 'Lesotho', 'code' => 'LS'],
            ['name' => 'Liberia', 'code' => 'LR'],
            ['name' => 'Libya', 'code' => 'LY'],
            ['name' => 'Liechtenstein', 'code' => 'LI'],
            ['name' => 'Lithuania', 'code' => 'LT'],
            ['name' => 'Luxembourg', 'code' => 'LU'],
            ['name' => 'Macao', 'code' => 'MO'],
            ['name' => 'Macedonia, the Former Yugoslav Republic of', 'code' => 'MK'],
            ['name' => 'Madagascar', 'code' => 'MG'],
            ['name' => 'Malawi', 'code' => 'MW'],
            ['name' => 'Malaysia', 'code' => 'MY'],
            ['name' => 'Maldives', 'code' => 'MV'],
            ['name' => 'Mali', 'code' => 'ML'],
            ['name' => 'Malta', 'code' => 'MT'],
            ['name' => 'Marshall Islands', 'code' => 'MH'],
            ['name' => 'Martinique', 'code' => 'MQ'],
            ['name' => 'Mauritania', 'code' => 'MR'],
            ['name' => 'Mauritius', 'code' => 'MU'],
            ['name' => 'Mayotte', 'code' => 'YT'],
            ['name' => 'Mexico', 'code' => 'MX'],
            ['name' => 'Micronesia, Federated States of', 'code' => 'FM'],
            ['name' => 'Moldova, Republic of', 'code' => 'MD'],
            ['name' => 'Monaco', 'code' => 'MC'],
            ['name' => 'Mongolia', 'code' => 'MN'],
            ['name' => 'Montenegro', 'code' => 'ME'],
            ['name' => 'Montserrat', 'code' => 'MS'],
            ['name' => 'Morocco', 'code' => 'MA'],
            ['name' => 'Mozambique', 'code' => 'MZ'],
            ['name' => 'Myanmar', 'code' => 'MM'],
            ['name' => 'Namibia', 'code' => 'NA'],
            ['name' => 'Nauru', 'code' => 'NR'],
            ['name' => 'Nepal', 'code' => 'NP'],
            ['name' => 'Netherlands', 'code' => 'NL'],
            ['name' => 'New Caledonia', 'code' => 'NC'],
            ['name' => 'New Zealand', 'code' => 'NZ'],
            ['name' => 'Nicaragua', 'code' => 'NI'],
            ['name' => 'Niger', 'code' => 'NE'],
            ['name' => 'Nigeria', 'code' => 'NG'],
            ['name' => 'Niue', 'code' => 'NU'],
            ['name' => 'Norfolk Island', 'code' => 'NF'],
            ['name' => 'Northern Mariana Islands', 'code' => 'MP'],
            ['name' => 'Norway', 'code' => 'NO'],
            ['name' => 'Oman', 'code' => 'OM'],
            ['name' => 'Pakistan', 'code' => 'PK'],
            ['name' => 'Palau', 'code' => 'PW'],
            ['name' => 'Palestine, State of', 'code' => 'PS'],
            ['name' => 'Panama', 'code' => 'PA'],
            ['name' => 'Papua New Guinea', 'code' => 'PG'],
            ['name' => 'Paraguay', 'code' => 'PY'],
            ['name' => 'Peru', 'code' => 'PE'],
            ['name' => 'Philippines', 'code' => 'PH'],
            ['name' => 'Pitcairn', 'code' => 'PN'],
            ['name' => 'Poland', 'code' => 'PL'],
            ['name' => 'Portugal', 'code' => 'PT'],
            ['name' => 'Puerto Rico', 'code' => 'PR'],
            ['name' => 'Qatar', 'code' => 'QA'],
            ['name' => 'Réunion', 'code' => 'RE'],
            ['name' => 'Romania', 'code' => 'RO'],
            ['name' => 'Russian Federation', 'code' => 'RU'],
            ['name' => 'Rwanda', 'code' => 'RW'],
            ['name' => 'Saint Barthélemy', 'code' => 'BL'],
            ['name' => 'Saint Helena, Ascension and Tristan da Cunha', 'code' => 'SH'],
            ['name' => 'Saint Kitts and Nevis', 'code' => 'KN'],
            ['name' => 'Saint Lucia', 'code' => 'LC'],
            ['name' => 'Saint Martin (French part)', 'code' => 'MF'],
            ['name' => 'Saint Pierre and Miquelon', 'code' => 'PM'],
            ['name' => 'Saint Vincent and the Grenadines', 'code' => 'VC'],
            ['name' => 'Samoa', 'code' => 'WS'],
            ['name' => 'San Marino', 'code' => 'SM'],
            ['name' => 'Sao Tome and Principe', 'code' => 'ST'],
            ['name' => 'Saudi Arabia', 'code' => 'SA'],
            ['name' => 'Senegal', 'code' => 'SN'],
            ['name' => 'Serbia', 'code' => 'RS'],
            ['name' => 'Seychelles', 'code' => 'SC'],
            ['name' => 'Sierra Leone', 'code' => 'SL'],
            ['name' => 'Singapore', 'code' => 'SG'],
            ['name' => 'Sint Maarten (Dutch part)', 'code' => 'SX'],
            ['name' => 'Slovakia', 'code' => 'SK'],
            ['name' => 'Slovenia', 'code' => 'SI'],
            ['name' => 'Solomon Islands', 'code' => 'SB'],
            ['name' => 'Somalia', 'code' => 'SO'],
            ['name' => 'South Africa', 'code' => 'ZA'],
            ['name' => 'South Georgia and the South Sandwich Islands', 'code' => 'GS'],
            ['name' => 'South Sudan', 'code' => 'SS'],
            ['name' => 'Spain', 'code' => 'ES'],
            ['name' => 'Sri Lanka', 'code' => 'LK'],
            ['name' => 'Sudan', 'code' => 'SD'],
            ['name' => 'Suriname', 'code' => 'SR'],
            ['name' => 'Svalbard and Jan Mayen', 'code' => 'SJ'],
            ['name' => 'Swaziland', 'code' => 'SZ'],
            ['name' => 'Sweden', 'code' => 'SE'],
            ['name' => 'Switzerland', 'code' => 'CH'],
            ['name' => 'Syrian Arab Republic', 'code' => 'SY'],
            ['name' => 'Taiwan', 'code' => 'TW'],
            ['name' => 'Tajikistan', 'code' => 'TJ'],
            ['name' => 'Tanzania, United Republic of', 'code' => 'TZ'],
            ['name' => 'Thailand', 'code' => 'TH'],
            ['name' => 'Timor-Leste', 'code' => 'TL'],
            ['name' => 'Togo', 'code' => 'TG'],
            ['name' => 'Tokelau', 'code' => 'TK'],
            ['name' => 'Tonga', 'code' => 'TO'],
            ['name' => 'Trinidad and Tobago', 'code' => 'TT'],
            ['name' => 'Tunisia', 'code' => 'TN'],
            ['name' => 'Turkey', 'code' => 'TR'],
            ['name' => 'Turkmenistan', 'code' => 'TM'],
            ['name' => 'Turks and Cai-cos Islands', 'code' => 'TC'],
            ['name' => 'Tuvalu', 'code' => 'TV'],
            ['name' => 'Uganda', 'code' => 'UG'],
            ['name' => 'Ukraine', 'code' => 'UA'],
            ['name' => 'United Arab Emirates', 'code' => 'AE'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'United States Minor Outlying Islands', 'code' => 'UM'],
            ['name' => 'Uruguay', 'code' => 'UY'],
            ['name' => 'Uzbekistan', 'code' => 'UZ'],
            ['name' => 'Vanuatu', 'code' => 'VU'],
            ['name' => 'Venezuela, Bolivar Republic of', 'code' => 'VE'],
            ['name' => 'Viet Nam', 'code' => 'VN'],
            ['name' => 'Virgin Islands, British', 'code' => 'VG'],
            ['name' => 'Virgin Islands, U.S.', 'code' => 'VI'],
            ['name' => 'Wallis and Tuna', 'code' => 'WF'],
            ['name' => 'Western Sahara', 'code' => 'EH'],
            ['name' => 'Yemen', 'code' => 'YE'],
            ['name' => 'Zambia', 'code' => 'ZM'],
            ['name' => 'Zimbabwe', 'code' => 'ZW'],
        ]);

    }
}
