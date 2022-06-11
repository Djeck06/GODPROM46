<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('countries')->truncate();
        
        $countries = array(
            array('code' => 'US', 'name' => 'United States', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CA', 'name' => 'Canada', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AF', 'name' => 'Afghanistan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AL', 'name' => 'Albania', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'DZ', 'name' => 'Algeria', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AS', 'name' => 'American Samoa', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AD', 'name' => 'Andorra', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AO', 'name' => 'Angola', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AI', 'name' => 'Anguilla', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AQ', 'name' => 'Antarctica', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AG', 'name' => 'Antigua and/or Barbuda', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AR', 'name' => 'Argentina', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AM', 'name' => 'Armenia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AW', 'name' => 'Aruba', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AU', 'name' => 'Australia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AT', 'name' => 'Austria', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AZ', 'name' => 'Azerbaijan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BS', 'name' => 'Bahamas', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BH', 'name' => 'Bahrain', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BD', 'name' => 'Bangladesh', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BB', 'name' => 'Barbados', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BY', 'name' => 'Belarus', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BE', 'name' => 'Belgium', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BZ', 'name' => 'Belize', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BJ', 'name' => 'Benin', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BM', 'name' => 'Bermuda', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BT', 'name' => 'Bhutan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BO', 'name' => 'Bolivia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BA', 'name' => 'Bosnia and Herzegovina', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BW', 'name' => 'Botswana', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BV', 'name' => 'Bouvet Island', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BR', 'name' => 'Brazil', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'IO', 'name' => 'British lndian Ocean Territory', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BN', 'name' => 'Brunei Darussalam', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BG', 'name' => 'Bulgaria', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BF', 'name' => 'Burkina Faso', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'BI', 'name' => 'Burundi', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KH', 'name' => 'Cambodia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CM', 'name' => 'Cameroon', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CV', 'name' => 'Cape Verde', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KY', 'name' => 'Cayman Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CF', 'name' => 'Central African Republic', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TD', 'name' => 'Chad', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CL', 'name' => 'Chile', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CN', 'name' => 'China', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CX', 'name' => 'Christmas Island', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CC', 'name' => 'Cocos (Keeling) Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CO', 'name' => 'Colombia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KM', 'name' => 'Comoros', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CG', 'name' => 'Congo', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CK', 'name' => 'Cook Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CR', 'name' => 'Costa Rica', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'HR', 'name' => 'Croatia (Hrvatska)', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CU', 'name' => 'Cuba', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CY', 'name' => 'Cyprus', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CZ', 'name' => 'Czech Republic', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CD', 'name' => 'Democratic Republic of Congo', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'DK', 'name' => 'Denmark', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'DJ', 'name' => 'Djibouti', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'DM', 'name' => 'Dominica', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'DO', 'name' => 'Dominican Republic', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TP', 'name' => 'East Timor', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'EC', 'name' => 'Ecudaor', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'EG', 'name' => 'Egypt', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SV', 'name' => 'El Salvador', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GQ', 'name' => 'Equatorial Guinea', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ER', 'name' => 'Eritrea', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'EE', 'name' => 'Estonia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ET', 'name' => 'Ethiopia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'FK', 'name' => 'Falkland Islands (Malvinas)', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'FO', 'name' => 'Faroe Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'FJ', 'name' => 'Fiji', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'FI', 'name' => 'Finland', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'FR', 'name' => 'France', 'is_pickup_country' => true, 'is_delivery_country' => true),
            array('code' => 'FX', 'name' => 'France, Metropolitan', 'is_pickup_country' => true, 'is_delivery_country' => true),
            array('code' => 'GF', 'name' => 'French Guiana', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PF', 'name' => 'French Polynesia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TF', 'name' => 'French Southern Territories', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GA', 'name' => 'Gabon', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GM', 'name' => 'Gambia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GE', 'name' => 'Georgia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'DE', 'name' => 'Germany', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GH', 'name' => 'Ghana', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GI', 'name' => 'Gibraltar', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GR', 'name' => 'Greece', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GL', 'name' => 'Greenland', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GD', 'name' => 'Grenada', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GP', 'name' => 'Guadeloupe', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GU', 'name' => 'Guam', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GT', 'name' => 'Guatemala', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GN', 'name' => 'Guinea', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GW', 'name' => 'Guinea-Bissau', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GY', 'name' => 'Guyana', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'HT', 'name' => 'Haiti', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'HM', 'name' => 'Heard and Mc Donald Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'HN', 'name' => 'Honduras', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'HK', 'name' => 'Hong Kong', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'HU', 'name' => 'Hungary', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'IS', 'name' => 'Iceland', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'IN', 'name' => 'India', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ID', 'name' => 'Indonesia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'IR', 'name' => 'Iran (Islamic Republic of)', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'IQ', 'name' => 'Iraq', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'IE', 'name' => 'Ireland', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'IL', 'name' => 'Israel', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'IT', 'name' => 'Italy', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CI', 'name' => 'Ivory Coast', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'JM', 'name' => 'Jamaica', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'JP', 'name' => 'Japan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'JO', 'name' => 'Jordan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KZ', 'name' => 'Kazakhstan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KE', 'name' => 'Kenya', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KI', 'name' => 'Kiribati', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KP', 'name' => 'Korea, Democratic People\'s Republic of', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KR', 'name' => 'Korea, Republic of', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KW', 'name' => 'Kuwait', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KG', 'name' => 'Kyrgyzstan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LA', 'name' => 'Lao People\'s Democratic Republic', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LV', 'name' => 'Latvia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LB', 'name' => 'Lebanon', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LS', 'name' => 'Lesotho', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LR', 'name' => 'Liberia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LY', 'name' => 'Libyan Arab Jamahiriya', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LI', 'name' => 'Liechtenstein', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LT', 'name' => 'Lithuania', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LU', 'name' => 'Luxembourg', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MO', 'name' => 'Macau', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MK', 'name' => 'Macedonia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MG', 'name' => 'Madagascar', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MW', 'name' => 'Malawi', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MY', 'name' => 'Malaysia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MV', 'name' => 'Maldives', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ML', 'name' => 'Mali', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MT', 'name' => 'Malta', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MH', 'name' => 'Marshall Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MQ', 'name' => 'Martinique', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MR', 'name' => 'Mauritania', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MU', 'name' => 'Mauritius', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TY', 'name' => 'Mayotte', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MX', 'name' => 'Mexico', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'FM', 'name' => 'Micronesia, Federated States of', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MD', 'name' => 'Moldova, Republic of', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MC', 'name' => 'Monaco', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MN', 'name' => 'Mongolia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MS', 'name' => 'Montserrat', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MA', 'name' => 'Morocco', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MZ', 'name' => 'Mozambique', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MM', 'name' => 'Myanmar', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NA', 'name' => 'Namibia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NR', 'name' => 'Nauru', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NP', 'name' => 'Nepal', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NL', 'name' => 'Netherlands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AN', 'name' => 'Netherlands Antilles', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NC', 'name' => 'New Caledonia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NZ', 'name' => 'New Zealand', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NI', 'name' => 'Nicaragua', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NE', 'name' => 'Niger', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NG', 'name' => 'Nigeria', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NU', 'name' => 'Niue', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NF', 'name' => 'Norfork Island', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'MP', 'name' => 'Northern Mariana Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'NO', 'name' => 'Norway', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'OM', 'name' => 'Oman', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PK', 'name' => 'Pakistan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PW', 'name' => 'Palau', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PA', 'name' => 'Panama', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PG', 'name' => 'Papua New Guinea', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PY', 'name' => 'Paraguay', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PE', 'name' => 'Peru', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PH', 'name' => 'Philippines', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PN', 'name' => 'Pitcairn', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PL', 'name' => 'Poland', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PT', 'name' => 'Portugal', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PR', 'name' => 'Puerto Rico', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'QA', 'name' => 'Qatar', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SS', 'name' => 'Republic of South Sudan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'RE', 'name' => 'Reunion', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'RO', 'name' => 'Romania', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'RU', 'name' => 'Russian Federation', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'RW', 'name' => 'Rwanda', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'KN', 'name' => 'Saint Kitts and Nevis', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LC', 'name' => 'Saint Lucia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'VC', 'name' => 'Saint Vincent and the Grenadines', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'WS', 'name' => 'Samoa', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SM', 'name' => 'San Marino', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ST', 'name' => 'Sao Tome and Principe', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SA', 'name' => 'Saudi Arabia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SN', 'name' => 'Senegal', 'is_pickup_country' => true, 'is_delivery_country' => true),
            array('code' => 'RS', 'name' => 'Serbia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SC', 'name' => 'Seychelles', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SL', 'name' => 'Sierra Leone', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SG', 'name' => 'Singapore', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SK', 'name' => 'Slovakia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SI', 'name' => 'Slovenia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SB', 'name' => 'Solomon Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SO', 'name' => 'Somalia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ZA', 'name' => 'South Africa', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GS', 'name' => 'South Georgia South Sandwich Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ES', 'name' => 'Spain', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'LK', 'name' => 'Sri Lanka', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SH', 'name' => 'St. Helena', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'PM', 'name' => 'St. Pierre and Miquelon', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SD', 'name' => 'Sudan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SR', 'name' => 'Suriname', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SJ', 'name' => 'Svalbarn and Jan Mayen Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SZ', 'name' => 'Swaziland', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SE', 'name' => 'Sweden', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'CH', 'name' => 'Switzerland', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'SY', 'name' => 'Syrian Arab Republic', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TW', 'name' => 'Taiwan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TJ', 'name' => 'Tajikistan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TZ', 'name' => 'Tanzania, United Republic of', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TH', 'name' => 'Thailand', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TG', 'name' => 'Togo', 'is_pickup_country' => true, 'is_delivery_country' => true),
            array('code' => 'TK', 'name' => 'Tokelau', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TO', 'name' => 'Tonga', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TT', 'name' => 'Trinidad and Tobago', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TN', 'name' => 'Tunisia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TR', 'name' => 'Turkey', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TM', 'name' => 'Turkmenistan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TC', 'name' => 'Turks and Caicos Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'TV', 'name' => 'Tuvalu', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'UG', 'name' => 'Uganda', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'UA', 'name' => 'Ukraine', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'AE', 'name' => 'United Arab Emirates', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'GB', 'name' => 'United Kingdom', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'UM', 'name' => 'United States minor outlying islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'UY', 'name' => 'Uruguay', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'UZ', 'name' => 'Uzbekistan', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'VU', 'name' => 'Vanuatu', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'VA', 'name' => 'Vatican City State', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'VE', 'name' => 'Venezuela', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'VN', 'name' => 'Vietnam', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'VG', 'name' => 'Virgin Islands (British)', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'VI', 'name' => 'Virgin Islands (U.S.)', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'WF', 'name' => 'Wallis and Futuna Islands', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'EH', 'name' => 'Western Sahara', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'YE', 'name' => 'Yemen', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'YU', 'name' => 'Yugoslavia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ZR', 'name' => 'Zaire', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ZM', 'name' => 'Zambia', 'is_pickup_country' => false, 'is_delivery_country' => false),
            array('code' => 'ZW', 'name' => 'Zimbabwe', 'is_pickup_country' => false, 'is_delivery_country' => false),
        );

        DB::table('countries')->insert($countries);
        Schema::enableForeignKeyConstraints();

    }
}