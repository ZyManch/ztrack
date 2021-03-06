<?php

class m150415_134012_country extends EDbMigration
{
	public function up()
	{
        $this->createTable('country',array(
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT',
            'code' => 'varchar(3) NOT NULL',
            'name' => 'varchar(50) NOT NULL',
            'region' => 'enum("EUROPE","ASIA","AMERICA","AFRICA","OCEANIA","OTHER") DEFAULT "OTHER"',
            'PRIMARY KEY (`id`)',
            'UNIQUE KEY `code_UNIQUE` (`code`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=898');

        $this->insert('country',array('id' => 1,'code' => 'EX','name'=>'external country','region' => 'other'));
        $this->insert('country',array('id' => 4,'code' => 'AF','name'=>'Afghanistan','region' => 'ASIA'));
        $this->insert('country',array('id' => 8,'code' => 'AL','name'=>'Albania','region' => 'EUROPE'));
        $this->insert('country',array('id' => 10,'code' => 'AQ','name'=>'Antarctica','region' => 'other'));
        $this->insert('country',array('id' => 12,'code' => 'DZ','name'=>'Algeria','region' => 'AFRICA'));
        $this->insert('country',array('id' => 16,'code' => 'AS','name'=>'American Samoa','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 20,'code' => 'AD','name'=>'Andorra','region' => 'EUROPE'));
        $this->insert('country',array('id' => 24,'code' => 'AO','name'=>'Angola','region' => 'AFRICA'));
        $this->insert('country',array('id' => 28,'code' => 'AG','name'=>'Antigua and Barbuda','region' => 'AMERICA'));
        $this->insert('country',array('id' => 31,'code' => 'AZ','name'=>'Azerbaijan','region' => 'ASIA'));
        $this->insert('country',array('id' => 32,'code' => 'AR','name'=>'Argentina','region' => 'AMERICA'));
        $this->insert('country',array('id' => 36,'code' => 'AU','name'=>'Australia','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 40,'code' => 'AT','name'=>'Austria','region' => 'EUROPE'));
        $this->insert('country',array('id' => 44,'code' => 'BS','name'=>'Bahamas','region' => 'AMERICA'));
        $this->insert('country',array('id' => 48,'code' => 'BH','name'=>'Bahrain','region' => 'ASIA'));
        $this->insert('country',array('id' => 50,'code' => 'BD','name'=>'Bangladesh','region' => 'ASIA'));
        $this->insert('country',array('id' => 51,'code' => 'AM','name'=>'Armenia','region' => 'ASIA'));
        $this->insert('country',array('id' => 52,'code' => 'BB','name'=>'Barbados','region' => 'AMERICA'));
        $this->insert('country',array('id' => 56,'code' => 'BE','name'=>'Belgium','region' => 'EUROPE'));
        $this->insert('country',array('id' => 60,'code' => 'BM','name'=>'Bermuda','region' => 'AMERICA'));
        $this->insert('country',array('id' => 64,'code' => 'BT','name'=>'Bhutan','region' => 'ASIA'));
        $this->insert('country',array('id' => 68,'code' => 'BO','name'=>'Bolivia','region' => 'AMERICA'));
        $this->insert('country',array('id' => 70,'code' => 'BA','name'=>'Bosnia and Herzegovina','region' => 'EUROPE'));
        $this->insert('country',array('id' => 72,'code' => 'BW','name'=>'Botswana','region' => 'AFRICA'));
        $this->insert('country',array('id' => 74,'code' => 'BV','name'=>'Bouvet Island','region' => 'other'));
        $this->insert('country',array('id' => 76,'code' => 'BR','name'=>'Brazil','region' => 'AMERICA'));
        $this->insert('country',array('id' => 84,'code' => 'BZ','name'=>'Belize','region' => 'AMERICA'));
        $this->insert('country',array('id' => 86,'code' => 'IO','name'=>'British Indian Ocean Territory','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 90,'code' => 'SB','name'=>'Solomon Islands','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 92,'code' => 'VG','name'=>'Virgin Islands, British','region' => 'AMERICA'));
        $this->insert('country',array('id' => 96,'code' => 'BN','name'=>'Brunei Darussalam','region' => 'ASIA'));
        $this->insert('country',array('id' => 100,'code' => 'BG','name'=>'Bulgaria','region' => 'EUROPE'));
        $this->insert('country',array('id' => 104,'code' => 'MM','name'=>'Myanmar','region' => 'ASIA'));
        $this->insert('country',array('id' => 108,'code' => 'BI','name'=>'Burundi','region' => 'AFRICA'));
        $this->insert('country',array('id' => 112,'code' => 'BY','name'=>'Belarus','region' => 'EUROPE'));
        $this->insert('country',array('id' => 116,'code' => 'KH','name'=>'Cambodia','region' => 'ASIA'));
        $this->insert('country',array('id' => 120,'code' => 'CM','name'=>'Cameroon','region' => 'AFRICA'));
        $this->insert('country',array('id' => 124,'code' => 'CA','name'=>'Canada','region' => 'AMERICA'));
        $this->insert('country',array('id' => 132,'code' => 'CV','name'=>'Cape Verde','region' => 'AFRICA'));
        $this->insert('country',array('id' => 136,'code' => 'KY','name'=>'Cayman Islands','region' => 'AMERICA'));
        $this->insert('country',array('id' => 140,'code' => 'CF','name'=>'Central African Republic','region' => 'AFRICA'));
        $this->insert('country',array('id' => 144,'code' => 'LK','name'=>'Sri Lanka','region' => 'ASIA'));
        $this->insert('country',array('id' => 148,'code' => 'TD','name'=>'Chad','region' => 'AFRICA'));
        $this->insert('country',array('id' => 152,'code' => 'CL','name'=>'Chile','region' => 'AMERICA'));
        $this->insert('country',array('id' => 156,'code' => 'CN','name'=>'China','region' => 'ASIA'));
        $this->insert('country',array('id' => 158,'code' => 'TW','name'=>'Taiwan, Province of China','region' => 'ASIA'));
        $this->insert('country',array('id' => 162,'code' => 'CX','name'=>'Christmas Island','region' => 'ASIA'));
        $this->insert('country',array('id' => 166,'code' => 'CC','name'=>'Cocos (Keeling) Islands','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 170,'code' => 'CO','name'=>'Colombia','region' => 'AMERICA'));
        $this->insert('country',array('id' => 174,'code' => 'KM','name'=>'Comoros','region' => 'AFRICA'));
        $this->insert('country',array('id' => 175,'code' => 'YT','name'=>'Mayotte','region' => 'AFRICA'));
        $this->insert('country',array('id' => 178,'code' => 'CG','name'=>'Congo','region' => 'AFRICA'));
        $this->insert('country',array('id' => 180,'code' => 'CD','name'=>'Congo, the Democratic Republic','region' => 'AFRICA'));
        $this->insert('country',array('id' => 184,'code' => 'CK','name'=>'Cook Islands','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 188,'code' => 'CR','name'=>'Costa Rica','region' => 'AMERICA'));
        $this->insert('country',array('id' => 191,'code' => 'HR','name'=>'Croatia','region' => 'EUROPE'));
        $this->insert('country',array('id' => 192,'code' => 'CU','name'=>'Cuba','region' => 'AMERICA'));
        $this->insert('country',array('id' => 196,'code' => 'CY','name'=>'Cyprus','region' => 'ASIA'));
        $this->insert('country',array('id' => 203,'code' => 'CZ','name'=>'Czech Republic','region' => 'EUROPE'));
        $this->insert('country',array('id' => 204,'code' => 'BJ','name'=>'Benin','region' => 'AFRICA'));
        $this->insert('country',array('id' => 208,'code' => 'DK','name'=>'Denmark','region' => 'EUROPE'));
        $this->insert('country',array('id' => 212,'code' => 'DM','name'=>'Dominica','region' => 'AMERICA'));
        $this->insert('country',array('id' => 214,'code' => 'DO','name'=>'Dominican Republic','region' => 'AMERICA'));
        $this->insert('country',array('id' => 218,'code' => 'EC','name'=>'Ecuador','region' => 'AMERICA'));
        $this->insert('country',array('id' => 222,'code' => 'SV','name'=>'El Salvador','region' => 'AMERICA'));
        $this->insert('country',array('id' => 226,'code' => 'GQ','name'=>'Equatorial Guinea','region' => 'AFRICA'));
        $this->insert('country',array('id' => 231,'code' => 'ET','name'=>'Ethiopia','region' => 'AFRICA'));
        $this->insert('country',array('id' => 232,'code' => 'ER','name'=>'Eritrea','region' => 'AFRICA'));
        $this->insert('country',array('id' => 233,'code' => 'EE','name'=>'Estonia','region' => 'EUROPE'));
        $this->insert('country',array('id' => 234,'code' => 'FO','name'=>'Faroe Islands','region' => 'EUROPE'));
        $this->insert('country',array('id' => 238,'code' => 'FK','name'=>'Falkland Islands (Malvinas)','region' => 'AMERICA'));
        $this->insert('country',array('id' => 239,'code' => 'GS','name'=>'South Georgia and the South Sa','region' => 'other'));
        $this->insert('country',array('id' => 242,'code' => 'FJ','name'=>'Fiji','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 246,'code' => 'FI','name'=>'Finland','region' => 'EUROPE'));
        $this->insert('country',array('id' => 248,'code' => 'AX','name'=>'Aland Islands','region' => 'EUROPE'));
        $this->insert('country',array('id' => 250,'code' => 'FR','name'=>'France','region' => 'EUROPE'));
        $this->insert('country',array('id' => 254,'code' => 'GF','name'=>'French Guiana','region' => 'AMERICA'));
        $this->insert('country',array('id' => 258,'code' => 'PF','name'=>'French Polynesia','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 260,'code' => 'TF','name'=>'French Southern Territories','region' => 'other'));
        $this->insert('country',array('id' => 262,'code' => 'DJ','name'=>'Djibouti','region' => 'AFRICA'));
        $this->insert('country',array('id' => 266,'code' => 'GA','name'=>'Gabon','region' => 'AFRICA'));
        $this->insert('country',array('id' => 268,'code' => 'GE','name'=>'Georgia','region' => 'ASIA'));
        $this->insert('country',array('id' => 270,'code' => 'GM','name'=>'Gambia','region' => 'AFRICA'));
        $this->insert('country',array('id' => 275,'code' => 'PS','name'=>'Palestinian Territory, Occupie','region' => 'ASIA'));
        $this->insert('country',array('id' => 276,'code' => 'DE','name'=>'Germany','region' => 'EUROPE'));
        $this->insert('country',array('id' => 288,'code' => 'GH','name'=>'Ghana','region' => 'AFRICA'));
        $this->insert('country',array('id' => 292,'code' => 'GI','name'=>'Gibraltar','region' => 'EUROPE'));
        $this->insert('country',array('id' => 296,'code' => 'KI','name'=>'Kiribati','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 300,'code' => 'GR','name'=>'Greece','region' => 'EUROPE'));
        $this->insert('country',array('id' => 304,'code' => 'GL','name'=>'Greenland','region' => 'AMERICA'));
        $this->insert('country',array('id' => 308,'code' => 'GD','name'=>'Grenada','region' => 'AMERICA'));
        $this->insert('country',array('id' => 312,'code' => 'GP','name'=>'Guadeloupe','region' => 'AMERICA'));
        $this->insert('country',array('id' => 316,'code' => 'GU','name'=>'Guam','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 320,'code' => 'GT','name'=>'Guatemala','region' => 'AMERICA'));
        $this->insert('country',array('id' => 324,'code' => 'GN','name'=>'Guinea','region' => 'AFRICA'));
        $this->insert('country',array('id' => 328,'code' => 'GY','name'=>'Guyana','region' => 'AMERICA'));
        $this->insert('country',array('id' => 332,'code' => 'HT','name'=>'Haiti','region' => 'AMERICA'));
        $this->insert('country',array('id' => 334,'code' => 'HM','name'=>'Heard Island and McDonald Isla','region' => 'other'));
        $this->insert('country',array('id' => 336,'code' => 'VA','name'=>'Holy See (Vatican City State)','region' => 'EUROPE'));
        $this->insert('country',array('id' => 340,'code' => 'HN','name'=>'Honduras','region' => 'AMERICA'));
        $this->insert('country',array('id' => 344,'code' => 'HK','name'=>'Hong Kong','region' => 'ASIA'));
        $this->insert('country',array('id' => 348,'code' => 'HU','name'=>'Hungary','region' => 'EUROPE'));
        $this->insert('country',array('id' => 352,'code' => 'IS','name'=>'Iceland','region' => 'EUROPE'));
        $this->insert('country',array('id' => 356,'code' => 'IN','name'=>'India','region' => 'ASIA'));
        $this->insert('country',array('id' => 360,'code' => 'ID','name'=>'Indonesia','region' => 'ASIA'));
        $this->insert('country',array('id' => 364,'code' => 'IR','name'=>'Iran, Islamic Republic of','region' => 'ASIA'));
        $this->insert('country',array('id' => 368,'code' => 'IQ','name'=>'Iraq','region' => 'ASIA'));
        $this->insert('country',array('id' => 372,'code' => 'IE','name'=>'Ireland','region' => 'EUROPE'));
        $this->insert('country',array('id' => 376,'code' => 'IL','name'=>'Israel','region' => 'ASIA'));
        $this->insert('country',array('id' => 380,'code' => 'IT','name'=>'Italy','region' => 'EUROPE'));
        $this->insert('country',array('id' => 384,'code' => 'CI','name'=>'Cote D\'Ivoire','region' => 'AFRICA'));
        $this->insert('country',array('id' => 388,'code' => 'JM','name'=>'Jamaica','region' => 'AMERICA'));
        $this->insert('country',array('id' => 392,'code' => 'JP','name'=>'Japan','region' => 'ASIA'));
        $this->insert('country',array('id' => 398,'code' => 'KZ','name'=>'Kazakhstan','region' => 'ASIA'));
        $this->insert('country',array('id' => 400,'code' => 'JO','name'=>'Jordan','region' => 'ASIA'));
        $this->insert('country',array('id' => 404,'code' => 'KE','name'=>'Kenya','region' => 'AFRICA'));
        $this->insert('country',array('id' => 408,'code' => 'KP','name'=>'Korea, Democratic People\'s Rep','region' => 'ASIA'));
        $this->insert('country',array('id' => 410,'code' => 'KR','name'=>'Korea, Republic of','region' => 'ASIA'));
        $this->insert('country',array('id' => 414,'code' => 'KW','name'=>'Kuwait','region' => 'ASIA'));
        $this->insert('country',array('id' => 417,'code' => 'KG','name'=>'Kyrgyzstan','region' => 'ASIA'));
        $this->insert('country',array('id' => 418,'code' => 'LA','name'=>'Lao People\'s Democratic Republ','region' => 'ASIA'));
        $this->insert('country',array('id' => 422,'code' => 'LB','name'=>'Lebanon','region' => 'ASIA'));
        $this->insert('country',array('id' => 426,'code' => 'LS','name'=>'Lesotho','region' => 'AFRICA'));
        $this->insert('country',array('id' => 428,'code' => 'LV','name'=>'Latvia','region' => 'EUROPE'));
        $this->insert('country',array('id' => 430,'code' => 'LR','name'=>'Liberia','region' => 'AFRICA'));
        $this->insert('country',array('id' => 434,'code' => 'LY','name'=>'Libyan Arab Jamahiriya','region' => 'AFRICA'));
        $this->insert('country',array('id' => 438,'code' => 'LI','name'=>'Liechtenstein','region' => 'EUROPE'));
        $this->insert('country',array('id' => 440,'code' => 'LT','name'=>'Lithuania','region' => 'EUROPE'));
        $this->insert('country',array('id' => 442,'code' => 'LU','name'=>'Luxembourg','region' => 'EUROPE'));
        $this->insert('country',array('id' => 446,'code' => 'MO','name'=>'Macao','region' => 'ASIA'));
        $this->insert('country',array('id' => 450,'code' => 'MG','name'=>'Madagascar','region' => 'AFRICA'));
        $this->insert('country',array('id' => 454,'code' => 'MW','name'=>'Malawi','region' => 'AFRICA'));
        $this->insert('country',array('id' => 458,'code' => 'MY','name'=>'Malaysia','region' => 'ASIA'));
        $this->insert('country',array('id' => 462,'code' => 'MV','name'=>'Maldives','region' => 'ASIA'));
        $this->insert('country',array('id' => 466,'code' => 'ML','name'=>'Mali','region' => 'AFRICA'));
        $this->insert('country',array('id' => 470,'code' => 'MT','name'=>'Malta','region' => 'EUROPE'));
        $this->insert('country',array('id' => 474,'code' => 'MQ','name'=>'Martinique','region' => 'AMERICA'));
        $this->insert('country',array('id' => 478,'code' => 'MR','name'=>'Mauritania','region' => 'AFRICA'));
        $this->insert('country',array('id' => 480,'code' => 'MU','name'=>'Mauritius','region' => 'AFRICA'));
        $this->insert('country',array('id' => 484,'code' => 'MX','name'=>'Mexico','region' => 'AMERICA'));
        $this->insert('country',array('id' => 492,'code' => 'MC','name'=>'Monaco','region' => 'EUROPE'));
        $this->insert('country',array('id' => 496,'code' => 'MN','name'=>'Mongolia','region' => 'ASIA'));
        $this->insert('country',array('id' => 498,'code' => 'MD','name'=>'Moldova, Republic of','region' => 'EUROPE'));
        $this->insert('country',array('id' => 499,'code' => 'ME','name'=>'Montenegro','region' => 'EUROPE'));
        $this->insert('country',array('id' => 500,'code' => 'MS','name'=>'Montserrat','region' => 'AMERICA'));
        $this->insert('country',array('id' => 504,'code' => 'MA','name'=>'Morocco','region' => 'AFRICA'));
        $this->insert('country',array('id' => 508,'code' => 'MZ','name'=>'Mozambique','region' => 'AFRICA'));
        $this->insert('country',array('id' => 512,'code' => 'OM','name'=>'Oman','region' => 'ASIA'));
        $this->insert('country',array('id' => 516,'code' => 'NA','name'=>'Namibia','region' => 'AFRICA'));
        $this->insert('country',array('id' => 520,'code' => 'NR','name'=>'Nauru','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 524,'code' => 'NP','name'=>'Nepal','region' => 'ASIA'));
        $this->insert('country',array('id' => 528,'code' => 'NL','name'=>'Netherlands','region' => 'EUROPE'));
        $this->insert('country',array('id' => 530,'code' => 'AN','name'=>'Netherlands Antilles','region' => 'AMERICA'));
        $this->insert('country',array('id' => 531,'code' => 'CW','name'=>'Curacao','region' => 'AMERICA'));
        $this->insert('country',array('id' => 533,'code' => 'AW','name'=>'Aruba','region' => 'AMERICA'));
        $this->insert('country',array('id' => 534,'code' => 'SX','name'=>'Sint Maarten (Dutch part)','region' => 'AMERICA'));
        $this->insert('country',array('id' => 535,'code' => 'BQ','name'=>'Bonaire, Sint Eustatius and Sa','region' => 'AMERICA'));
        $this->insert('country',array('id' => 540,'code' => 'NC','name'=>'New Caledonia','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 548,'code' => 'VU','name'=>'Vanuatu','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 554,'code' => 'NZ','name'=>'New Zealand','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 558,'code' => 'NI','name'=>'Nicaragua','region' => 'AMERICA'));
        $this->insert('country',array('id' => 562,'code' => 'NE','name'=>'Niger','region' => 'AFRICA'));
        $this->insert('country',array('id' => 566,'code' => 'NG','name'=>'Nigeria','region' => 'AFRICA'));
        $this->insert('country',array('id' => 570,'code' => 'NU','name'=>'Niue','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 574,'code' => 'NF','name'=>'Norfolk Island','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 578,'code' => 'NO','name'=>'Norway','region' => 'EUROPE'));
        $this->insert('country',array('id' => 580,'code' => 'MP','name'=>'Northern Mariana Islands','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 581,'code' => 'UM','name'=>'United States Minor Outlying I','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 583,'code' => 'FM','name'=>'Micronesia, Federated States o','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 584,'code' => 'MH','name'=>'Marshall Islands','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 585,'code' => 'PW','name'=>'Palau','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 586,'code' => 'PK','name'=>'Pakistan','region' => 'ASIA'));
        $this->insert('country',array('id' => 591,'code' => 'PA','name'=>'Panama','region' => 'AMERICA'));
        $this->insert('country',array('id' => 598,'code' => 'PG','name'=>'Papua New Guinea','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 600,'code' => 'PY','name'=>'Paraguay','region' => 'AMERICA'));
        $this->insert('country',array('id' => 604,'code' => 'PE','name'=>'Peru','region' => 'AMERICA'));
        $this->insert('country',array('id' => 608,'code' => 'PH','name'=>'Philippines','region' => 'ASIA'));
        $this->insert('country',array('id' => 612,'code' => 'PN','name'=>'Pitcairn','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 616,'code' => 'PL','name'=>'Poland','region' => 'EUROPE'));
        $this->insert('country',array('id' => 620,'code' => 'PT','name'=>'Portugal','region' => 'EUROPE'));
        $this->insert('country',array('id' => 624,'code' => 'GW','name'=>'Guinea-Bissau','region' => 'AFRICA'));
        $this->insert('country',array('id' => 626,'code' => 'TL','name'=>'Timor-Leste','region' => 'ASIA'));
        $this->insert('country',array('id' => 630,'code' => 'PR','name'=>'Puerto Rico','region' => 'AMERICA'));
        $this->insert('country',array('id' => 634,'code' => 'QA','name'=>'Qatar','region' => 'ASIA'));
        $this->insert('country',array('id' => 638,'code' => 'RE','name'=>'Reunion','region' => 'AFRICA'));
        $this->insert('country',array('id' => 642,'code' => 'RO','name'=>'Romania','region' => 'EUROPE'));
        $this->insert('country',array('id' => 643,'code' => 'RU','name'=>'Russian Federation','region' => 'EUROPE'));
        $this->insert('country',array('id' => 646,'code' => 'RW','name'=>'Rwanda','region' => 'AFRICA'));
        $this->insert('country',array('id' => 652,'code' => 'BL','name'=>'Saint Barthelemy','region' => 'AMERICA'));
        $this->insert('country',array('id' => 654,'code' => 'SH','name'=>'Saint Helena','region' => 'AFRICA'));
        $this->insert('country',array('id' => 659,'code' => 'KN','name'=>'Saint Kitts and Nevis','region' => 'AMERICA'));
        $this->insert('country',array('id' => 660,'code' => 'AI','name'=>'Anguilla','region' => 'AMERICA'));
        $this->insert('country',array('id' => 662,'code' => 'LC','name'=>'Saint Lucia','region' => 'AMERICA'));
        $this->insert('country',array('id' => 663,'code' => 'MF','name'=>'Saint Martin (French part)','region' => 'AMERICA'));
        $this->insert('country',array('id' => 666,'code' => 'PM','name'=>'Saint Pierre and Miquelon','region' => 'AMERICA'));
        $this->insert('country',array('id' => 670,'code' => 'VC','name'=>'Saint Vincent and the Grenadin','region' => 'AMERICA'));
        $this->insert('country',array('id' => 674,'code' => 'SM','name'=>'San Marino','region' => 'EUROPE'));
        $this->insert('country',array('id' => 678,'code' => 'ST','name'=>'Sao Tome and Principe','region' => 'AFRICA'));
        $this->insert('country',array('id' => 682,'code' => 'SA','name'=>'Saudi Arabia','region' => 'ASIA'));
        $this->insert('country',array('id' => 686,'code' => 'SN','name'=>'Senegal','region' => 'AFRICA'));
        $this->insert('country',array('id' => 688,'code' => 'RS','name'=>'Serbia','region' => 'EUROPE'));
        $this->insert('country',array('id' => 690,'code' => 'SC','name'=>'Seychelles','region' => 'AFRICA'));
        $this->insert('country',array('id' => 694,'code' => 'SL','name'=>'Sierra Leone','region' => 'AFRICA'));
        $this->insert('country',array('id' => 702,'code' => 'SG','name'=>'Singapore','region' => 'ASIA'));
        $this->insert('country',array('id' => 703,'code' => 'SK','name'=>'Slovakia','region' => 'EUROPE'));
        $this->insert('country',array('id' => 704,'code' => 'VN','name'=>'Viet Nam','region' => 'ASIA'));
        $this->insert('country',array('id' => 705,'code' => 'SI','name'=>'Slovenia','region' => 'EUROPE'));
        $this->insert('country',array('id' => 706,'code' => 'SO','name'=>'Somalia','region' => 'AFRICA'));
        $this->insert('country',array('id' => 710,'code' => 'ZA','name'=>'South Africa','region' => 'AFRICA'));
        $this->insert('country',array('id' => 716,'code' => 'ZW','name'=>'Zimbabwe','region' => 'AFRICA'));
        $this->insert('country',array('id' => 724,'code' => 'ES','name'=>'Spain','region' => 'EUROPE'));
        $this->insert('country',array('id' => 728,'code' => 'SS','name'=>'South Sudan','region' => 'AFRICA'));
        $this->insert('country',array('id' => 732,'code' => 'EH','name'=>'Western Sahara','region' => 'AFRICA'));
        $this->insert('country',array('id' => 736,'code' => 'SD','name'=>'Sudan','region' => 'AFRICA'));
        $this->insert('country',array('id' => 740,'code' => 'SR','name'=>'Suriname','region' => 'AMERICA'));
        $this->insert('country',array('id' => 744,'code' => 'SJ','name'=>'Svalbard and Jan Mayen','region' => 'EUROPE'));
        $this->insert('country',array('id' => 748,'code' => 'SZ','name'=>'Swaziland','region' => 'AFRICA'));
        $this->insert('country',array('id' => 752,'code' => 'SE','name'=>'Sweden','region' => 'EUROPE'));
        $this->insert('country',array('id' => 756,'code' => 'CH','name'=>'Switzerland','region' => 'EUROPE'));
        $this->insert('country',array('id' => 760,'code' => 'SY','name'=>'Syrian Arab Republic','region' => 'ASIA'));
        $this->insert('country',array('id' => 762,'code' => 'TJ','name'=>'Tajikistan','region' => 'ASIA'));
        $this->insert('country',array('id' => 764,'code' => 'TH','name'=>'Thailand','region' => 'ASIA'));
        $this->insert('country',array('id' => 768,'code' => 'TG','name'=>'Togo','region' => 'AFRICA'));
        $this->insert('country',array('id' => 772,'code' => 'TK','name'=>'Tokelau','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 776,'code' => 'TO','name'=>'Tonga','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 780,'code' => 'TT','name'=>'Trinidad and Tobago','region' => 'AMERICA'));
        $this->insert('country',array('id' => 784,'code' => 'AE','name'=>'United Arab Emirates','region' => 'ASIA'));
        $this->insert('country',array('id' => 788,'code' => 'TN','name'=>'Tunisia','region' => 'AFRICA'));
        $this->insert('country',array('id' => 792,'code' => 'TR','name'=>'Turkey','region' => 'ASIA'));
        $this->insert('country',array('id' => 795,'code' => 'TM','name'=>'Turkmenistan','region' => 'ASIA'));
        $this->insert('country',array('id' => 796,'code' => 'TC','name'=>'Turks and Caicos Islands','region' => 'AMERICA'));
        $this->insert('country',array('id' => 798,'code' => 'TV','name'=>'Tuvalu','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 800,'code' => 'UG','name'=>'Uganda','region' => 'AFRICA'));
        $this->insert('country',array('id' => 804,'code' => 'UA','name'=>'Ukraine','region' => 'EUROPE'));
        $this->insert('country',array('id' => 807,'code' => 'MK','name'=>'Macedonia, the Former Yugoslav','region' => 'EUROPE'));
        $this->insert('country',array('id' => 818,'code' => 'EG','name'=>'Egypt','region' => 'AFRICA'));
        $this->insert('country',array('id' => 826,'code' => 'GB','name'=>'United Kingdom','region' => 'EUROPE'));
        $this->insert('country',array('id' => 831,'code' => 'GG','name'=>'Guernsey','region' => 'EUROPE'));
        $this->insert('country',array('id' => 832,'code' => 'JE','name'=>'Jersey','region' => 'EUROPE'));
        $this->insert('country',array('id' => 833,'code' => 'IM','name'=>'Isle of Man','region' => 'EUROPE'));
        $this->insert('country',array('id' => 834,'code' => 'TZ','name'=>'Tanzania, United Republic of','region' => 'AFRICA'));
        $this->insert('country',array('id' => 840,'code' => 'US','name'=>'United States','region' => 'AMERICA'));
        $this->insert('country',array('id' => 850,'code' => 'VI','name'=>'Virgin Islands, U.s.','region' => 'AMERICA'));
        $this->insert('country',array('id' => 854,'code' => 'BF','name'=>'Burkina Faso','region' => 'AFRICA'));
        $this->insert('country',array('id' => 858,'code' => 'UY','name'=>'Uruguay','region' => 'AMERICA'));
        $this->insert('country',array('id' => 860,'code' => 'UZ','name'=>'Uzbekistan','region' => 'ASIA'));
        $this->insert('country',array('id' => 862,'code' => 'VE','name'=>'Venezuela','region' => 'AMERICA'));
        $this->insert('country',array('id' => 876,'code' => 'WF','name'=>'Wallis and Futuna','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 882,'code' => 'WS','name'=>'Samoa','region' => 'OCEANIA'));
        $this->insert('country',array('id' => 887,'code' => 'YE','name'=>'Yemen','region' => 'ASIA'));
        $this->insert('country',array('id' => 894,'code' => 'ZM','name'=>'Zambia','region' => 'AFRICA'));
        $this->insert('country',array('id' => 895,'code' => 'tmp','name'=>'Slovak Republic','region' => 'other'));
        $this->insert('country',array('id' => 896,'code' => 'tmq','name'=>'Moldavia','region' => 'other'));
        $this->insert('country',array('id' => 897,'code' => 'tmr','name'=>'Kazachstan','region' => 'other'));
        $this->execute('ALTER TABLE  `request` ADD  `country_id` INT UNSIGNED NOT NULL AFTER  `user_ip` ,ADD INDEX (  `country_id` )');
        $this->update('request',array('country_id'=>1));
        $this->addForeignKey(
            'request_ibfk_10',
            'request',
            'country_id',
            'country',
            'id'
        );
	}

	public function down()
	{
        $this->dropForeignKey('request_ibfk_10','request');
        $this->dropTable('country');
        $this->dropColumn('request','country_id');
	}

}