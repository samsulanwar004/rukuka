<?php

use Illuminate\Database\Seeder;

class SeederCountries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$countries = [
						["countries_name" => "Bangladesh", "countries_code" => "BD"],
						["countries_name" => "Netherlands", "countries_code" => "NL"],
						["countries_name" => "Belgium", "countries_code" => "BE"],
						["countries_name" => "Brazil", "countries_code" => "BR"],
						["countries_name" => "Brunei Darussalam", "countries_code" => "BN"],
						["countries_name" => "Cambodia", "countries_code" => "KH"],
						["countries_name" => "Denmark", "countries_code" => "DK"],
						["countries_name" => "Finland", "countries_code" => "FI"],
						["countries_name" => "Hong Kong", "countries_code" => "HK"],
						["countries_name" => "India", "countries_code" => "IN"],
						["countries_name" => "Great Britain", "countries_code" => "GB"],
						["countries_name" => "Iraq", "countries_code" => "IQ"],
						["countries_name" => "Ireland", "countries_code" => "IE"],
						["countries_name" => "Italy", "countries_code" => "IT"],
						["countries_name" => "Japan", "countries_code" => "JP"],
						["countries_name" => "Germany", "countries_code" => "DE"],
						["countries_name" => "Canada", "countries_code" => "CA"],
						["countries_name" => "Korea (Rep.)", "countries_code" => "KR"],
						["countries_name" => "Kuwait", "countries_code" => "KW"],
						["countries_name" => "Macao", "countries_code" => "MO"],
						["countries_name" => "Malaysia", "countries_code" => "MY"],
						["countries_name" => "Maldives", "countries_code" => "MV"],
						["countries_name" => "Egypt", "countries_code" => "EG"],
						["countries_name" => "Nepal", "countries_code" => "NP"],
						["countries_name" => "New Caledonia", "countries_code" => "NC"],
						["countries_name" => "New Zealand", "countries_code" => "NZ"],
						["countries_name" => "Nigeria", "countries_code" => "NG"],
						["countries_name" => "Norway", "countries_code" => "NO"],
						["countries_name" => "Pakistan", "countries_code" => "PK"],
						["countries_name" => "Papua New Guinea", "countries_code" => "PG"],
						["countries_name" => "France", "countries_code" => "FR"],
						["countries_name" => "Philippines", "countries_code" => "PH"],
						["countries_name" => "Poland", "countries_code" => "PL"],
						["countries_name" => "Portugal", "countries_code" => "PT"],
						["countries_name" => "Qatar", "countries_code" => "QA"],
						["countries_name" => "China (People's Rep.)", "countries_code" => "CN"],
						["countries_name" => "Russian Federation", "countries_code" => "RU"],
						["countries_name" => "Saudi Arabia", "countries_code" => "SA"],
						["countries_name" => "Singapore", "countries_code" => "SG"],
						["countries_name" => "Sudan", "countries_code" => "SD"],
						["countries_name" => "Sweden", "countries_code" => "SE"],
						["countries_name" => "Switzerland", "countries_code" => "CH"],
						["countries_name" => "Taiwan", "countries_code" => "TW"],
						["countries_name" => "Thailand", "countries_code" => "TH"],
						["countries_name" => "United Arab Emirates", "countries_code" => "AE"],
						["countries_name" => "Viet Nam", "countries_code" => "VN"],
						["countries_name" => "Costa Rica", "countries_code" => "CR"],
						["countries_name" => "Chile", "countries_code" => "CL"],
						["countries_name" => "Colombia", "countries_code" => "CO"],
						["countries_name" => "Dominica", "countries_code" => "DM"],
						["countries_name" => "Dominica Rep", "countries_code" => "DO"],
						["countries_name" => "Equador", "countries_code" => "EC"],
						["countries_name" => "El Salvador", "countries_code" => "SV"],
						["countries_name" => "Honduras", "countries_code" => "HN"],
						["countries_name" => "Haiti", "countries_code" => "HT"],
						["countries_name" => "Mexico", "countries_code" => "MX"],
						["countries_name" => "Spain", "countries_code" => "ES"],
						["countries_name" => "Albania", "countries_code" => "AL"],
						["countries_name" => "Argentina", "countries_code" => "AR"],
						["countries_name" => "Bulgaria", "countries_code" => "BG"],
						["countries_name" => "Greece", "countries_code" => "GR"],
						["countries_name" => "Iran", "countries_code" => "IR"],
						["countries_name" => "Jordania", "countries_code" => "JO"],
						["countries_name" => "Lao People's Dem. Rep", "countries_code" => "LO"],
						["countries_name" => "Marocco", "countries_code" => "MA"],
						["countries_name" => "Mauritius", "countries_code" => "MU"],
						["countries_name" => "Myanmar", "countries_code" => "MM"],
						["countries_name" => "Oman", "countries_code" => "OM"],
						["countries_name" => "Panama", "countries_code" => "PA"],
						["countries_name" => "Senegal", "countries_code" => "SN"],
						["countries_name" => "Suriname", "countries_code" => "SR"],
						["countries_name" => "Syrian Arab Rep.", "countries_code" => "SY"],
						["countries_name" => "Tunisia", "countries_code" => "TN"],
						["countries_name" => "Turkey", "countries_code" => "TR"],
						["countries_name" => "Venezuela", "countries_code" => "VE"],
						["countries_name" => "Yemen Arab Rep", "countries_code" => "YE"],
						["countries_name" => "Zambia", "countries_code" => "ZM"]
					];

        DB::table('countries')->insert($countries);
    }
}
