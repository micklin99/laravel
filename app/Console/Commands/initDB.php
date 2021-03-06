<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Models\State;
use App\Models\Country;

class initDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'loads a database with initial startup data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function checkDatabaseTable( $table )
    {
    
       if (! Schema::hasTable( $table ))
       {
         $this->error("'" . $table . "' table does not exist.  Run 'php artisan migrate'.");
	 return false;
       }

       $size = DB::table( $table )->count();

       if ($size > 0)
       {
         $this->error("'" . $table . "' table has previously been loaded and contains " .
	             $size . " rows.");
         return false;
       }

       return true;
    }

    private function loadStates()
    {
       $states = array(
              array( "abbrev"=>'AL', "name"=>'ALABAMA' ),
	      array( "abbrev"=>'AK', "name"=>'ALASKA' ),
	      array( "abbrev"=>'AZ', "name"=>'ARIZONA' ),
       	      array( "abbrev"=>'AR', "name"=>'ARKANSAS' ),
       	      array( "abbrev"=>'CA', "name"=>'CALIFORNIA' ),
       	      array( "abbrev"=>'CO', "name"=>'COLORADO' ),
       	      array( "abbrev"=>'CT', "name"=>'CONNECTICUT' ),
       	      array( "abbrev"=>'DE', "name"=>'DELAWARE' ),
       	      array( "abbrev"=>'DC', "name"=>'DISTRICT OF COLUMBIA' ),
       	      array( "abbrev"=>'FL', "name"=>'FLORIDA' ),
       	      array( "abbrev"=>'GA', "name"=>'GEORGIA' ),
       	      array( "abbrev"=>'HI', "name"=>'HAWAII' ),
       	      array( "abbrev"=>'ID', "name"=>'IDAHO' ),
       	      array( "abbrev"=>'IL', "name"=>'ILLINOIS' ),
       	      array( "abbrev"=>'IN', "name"=>'INDIANA' ),
       	      array( "abbrev"=>'IA', "name"=>'IOWA' ),
       	      array( "abbrev"=>'KS', "name"=>'KANSAS' ),
       	      array( "abbrev"=>'KY', "name"=>'KENTUCKY' ),
       	      array( "abbrev"=>'LA', "name"=>'LOUISIANA' ),
       	      array( "abbrev"=>'ME', "name"=>'MAINE' ),
       	      array( "abbrev"=>'MD', "name"=>'MARYLAND' ),
       	      array( "abbrev"=>'MA', "name"=>'MASSACHUSETTS' ),
       	      array( "abbrev"=>'MI', "name"=>'MICHIGAN' ),
       	      array( "abbrev"=>'MN', "name"=>'MINNESOTA' ),
       	      array( "abbrev"=>'MS', "name"=>'MISSISSIPPI' ),
       	      array( "abbrev"=>'MO', "name"=>'MISSOURI' ),
       	      array( "abbrev"=>'MT', "name"=>'MONTANA' ),
       	      array( "abbrev"=>'NE', "name"=>'NEBRASKA' ),
       	      array( "abbrev"=>'NV', "name"=>'NEVADA' ),
       	      array( "abbrev"=>'NH', "name"=>'NEW HAMPSHIRE' ),
       	      array( "abbrev"=>'NJ', "name"=>'NEW JERSEY' ),
       	      array( "abbrev"=>'NM', "name"=>'NEW MEXICO' ),
       	      array( "abbrev"=>'NY', "name"=>'NEW YORK' ),
       	      array( "abbrev"=>'NC', "name"=>'NORTH CAROLINA' ),
       	      array( "abbrev"=>'ND', "name"=>'NORTH DAKOTA' ),
       	      array( "abbrev"=>'OH', "name"=>'OHIO' ),
       	      array( "abbrev"=>'OK', "name"=>'OKLAHOMA' ),
       	      array( "abbrev"=>'OR', "name"=>'OREGON' ),
       	      array( "abbrev"=>'PA', "name"=>'PENNSYLVANIA' ),
       	      array( "abbrev"=>'RI', "name"=>'RHODE ISLAND' ),
       	      array( "abbrev"=>'SC', "name"=>'SOUTH CAROLINA' ),
       	      array( "abbrev"=>'SD', "name"=>'SOUTH DAKOTA' ),
       	      array( "abbrev"=>'TN', "name"=>'TENNESSEE' ),
       	      array( "abbrev"=>'TX', "name"=>'TEXAS' ),
       	      array( "abbrev"=>'UT', "name"=>'UTAH' ),
       	      array( "abbrev"=>'VT', "name"=>'VERMONT' ),
       	      array( "abbrev"=>'VA', "name"=>'VIRGINIA' ),
       	      array( "abbrev"=>'WA', "name"=>'WASHINGTON' ),
       	      array( "abbrev"=>'WV', "name"=>'WEST VIRGINIA' ),
       	      array( "abbrev"=>'WI', "name"=>'WISCONSIN' ),
       	      array( "abbrev"=>'WY', "name"=>'WYOMING' )
       );

       $numStates = count($states);

       for ($i = 0; $i < $numStates; $i++)
       {
	  $state = new State();
	  $state->id     = $i+1;
          $state->abbrev = $states[$i]["abbrev"];
          $state->name   = $states[$i]["name"];
          $state->save();
       }      
       
       $this->info("loaded " . $numStates . " rows into 'states' table.");
    }


    private function loadCountries()
    {
	$countries = array(
	    array( "fips"=>'AA', "name"=>'ARUBA'),
	    array( "fips"=>'AC', "name"=>'ANTIGUA AND BARBUDA'),
	    array( "fips"=>'AF', "name"=>'AFGHANISTAN'),
	    array( "fips"=>'AG', "name"=>'ALGERIA'),
	    array( "fips"=>'AI', "name"=>'ASCENSION ISLAND'),
	    array( "fips"=>'AJ', "name"=>'AZERBAIJAN'),
	    array( "fips"=>'AL', "name"=>'ALBANIA'),
	    array( "fips"=>'AM', "name"=>'ARMENIA'),
	    array( "fips"=>'AN', "name"=>'ANDORRA'),
	    array( "fips"=>'AO', "name"=>'ANGOLA'),
	    array( "fips"=>'AQ', "name"=>'AMERICAN SAMOA'),
	    array( "fips"=>'AR', "name"=>'ARGENTINA'),
	    array( "fips"=>'AS', "name"=>'AUSTRALIA'),
	    array( "fips"=>'AT', "name"=>'ASHMORE AND CARTIER ISLANDS'),
	    array( "fips"=>'AU', "name"=>'AUSTRIA'),
	    array( "fips"=>'AV', "name"=>'ANGUILLA'),
	    array( "fips"=>'AX', "name"=>'ANTIGUA, ST. KITTS, NEVIS, BARBUDA'),
	    array( "fips"=>'AY', "name"=>'ANTARCTICA'),
	    array( "fips"=>'AZ', "name"=>'AZORES'),
	    array( "fips"=>'BA', "name"=>'BAHRAIN'),
	    array( "fips"=>'BB', "name"=>'BARBADOS'),
	    array( "fips"=>'BC', "name"=>'BOTSWANA'),
	    array( "fips"=>'BD', "name"=>'BERMUDA'),
	    array( "fips"=>'BE', "name"=>'BELGIUM'),
	    array( "fips"=>'BF', "name"=>'BAHAMAS THE'),
	    array( "fips"=>'BG', "name"=>'BANGLADESH'),
	    array( "fips"=>'BH', "name"=>'BELIZE'),
	    array( "fips"=>'BK', "name"=>'BOSNIA AND HERZEGOVINA'),
	    array( "fips"=>'BL', "name"=>'BOLIVIA'),
	    array( "fips"=>'BM', "name"=>'BURMA'),
	    array( "fips"=>'BN', "name"=>'BENIN'),
	    array( "fips"=>'BO', "name"=>'BELARUS'),
	    array( "fips"=>'BP', "name"=>'SOLOMON ISLANDS'),
	    array( "fips"=>'BQ', "name"=>'NAVASSA ISLAND'),
	    array( "fips"=>'BR', "name"=>'BRAZIL'),
	    array( "fips"=>'BS', "name"=>'BASSAS DA INDIA'),
	    array( "fips"=>'BT', "name"=>'BHUTAN'),
	    array( "fips"=>'BU', "name"=>'BULGARIA'),
	    array( "fips"=>'BV', "name"=>'BOUVET ISLAND'),
	    array( "fips"=>'BX', "name"=>'BRUNEI'),
	    array( "fips"=>'BY', "name"=>'BURUNDI'),
	    array( "fips"=>'BZ', "name"=>'BELGIUM AND LUXEMBOURG'),
	    array( "fips"=>'CA', "name"=>'CANADA'),
	    array( "fips"=>'CB', "name"=>'CAMBODIA'),
	    array( "fips"=>'CC', "name"=>'CEUTA AND MELILLA'),
	    array( "fips"=>'CD', "name"=>'CHAD'),
	    array( "fips"=>'CE', "name"=>'SRI LANKA'),
	    array( "fips"=>'CF', "name"=>'CONGO'),
	    array( "fips"=>'CG', "name"=>'ZAIRE'),
	    array( "fips"=>'CH', "name"=>'CHINA'),
	    array( "fips"=>'CI', "name"=>'CHILE'),
	    array( "fips"=>'CJ', "name"=>'CAYMAN ISLANDS'),
	    array( "fips"=>'CK', "name"=>'COCOS (KEELING) ISLANDS'),
	    array( "fips"=>'CL', "name"=>'CAROLINE ISLANDS'),
	    array( "fips"=>'CM', "name"=>'CAMEROON'),
	    array( "fips"=>'CN', "name"=>'COMOROS'),
	    array( "fips"=>'CO', "name"=>'COLOMBIA'),
	    array( "fips"=>'CP', "name"=>'CANARY ISLANDS'),
	    array( "fips"=>'CQ', "name"=>'NORTHERN MARIANA ISLANDS'),
	    array( "fips"=>'CR', "name"=>'CORAL SEA ISLANDS'),
	    array( "fips"=>'CS', "name"=>'COSTA RICA'),
	    array( "fips"=>'CT', "name"=>'CENTRAL AFRICAN REPUBLIC'),
	    array( "fips"=>'CU', "name"=>'CUBA'),
	    array( "fips"=>'CV', "name"=>'CAPE VERDE'),
	    array( "fips"=>'CW', "name"=>'COOK ISLANDS'),
	    array( "fips"=>'CY', "name"=>'CYPRUS'),
	    array( "fips"=>'CZ', "name"=>'CANTON ISLAND'),
	    array( "fips"=>'DA', "name"=>'DENMARK'),
	    array( "fips"=>'DJ', "name"=>'DJIBOUTI'),
	    array( "fips"=>'DO', "name"=>'DOMINICA'),
	    array( "fips"=>'DQ', "name"=>'JARVIS ISLAND'),
	    array( "fips"=>'DR', "name"=>'DOMINICAN REPUBLIC'),
	    array( "fips"=>'DY', "name"=>'DEMOCRATIC YEMEN'),
	    array( "fips"=>'EC', "name"=>'ECUADOR'),
	    array( "fips"=>'EG', "name"=>'EGYPT'),
	    array( "fips"=>'EI', "name"=>'IRELAND'),
	    array( "fips"=>'EK', "name"=>'EQUATORIAL GUINEA'),
	    array( "fips"=>'EN', "name"=>'ESTONIA'),
	    array( "fips"=>'ER', "name"=>'ERITREA'),
	    array( "fips"=>'ES', "name"=>'EL SALVADOR'),
	    array( "fips"=>'ET', "name"=>'ETHIOPIA'),
	    array( "fips"=>'EU', "name"=>'EUROPA ISLAND'),
	    array( "fips"=>'EZ', "name"=>'CZECH REPUBLIC'),
	    array( "fips"=>'FG', "name"=>'FRENCH GUIANA'),
	    array( "fips"=>'FI', "name"=>'FINLAND'),
	    array( "fips"=>'FJ', "name"=>'FIJI'),
	    array( "fips"=>'FK', "name"=>'FALKLAND ISLANDS (ISLAS MALVINAS)'),
	    array( "fips"=>'FM', "name"=>'MICRONESIA, FEDERATED STATES OF'),
	    array( "fips"=>'FO', "name"=>'FAROE ISLANDS'),
	    array( "fips"=>'FP', "name"=>'FRENCH POLYNESIA'),
	    array( "fips"=>'FQ', "name"=>'BAKER ISLAND'),
	    array( "fips"=>'FR', "name"=>'FRANCE'),
	    array( "fips"=>'FS', "name"=>'FRENCH SOUTHERN AND ANTARCTIC LANDS'),
	    array( "fips"=>'GA', "name"=>'GAMBIA  THE'),
	    array( "fips"=>'GB', "name"=>'GABON'),
	    array( "fips"=>'GG', "name"=>'GEORGIA'),
	    array( "fips"=>'GH', "name"=>'GHANA'),
	    array( "fips"=>'GI', "name"=>'GIBRALTAR'),
	    array( "fips"=>'GJ', "name"=>'GRENADA'),
	    array( "fips"=>'GK', "name"=>'GUERNSEY'),
	    array( "fips"=>'GL', "name"=>'GREENLAND'),
	    array( "fips"=>'GM', "name"=>'GERMANY'),
	    array( "fips"=>'GO', "name"=>'GLORIOSO ISLANDS'),
	    array( "fips"=>'GP', "name"=>'GUADELOUPE'),
	    array( "fips"=>'GQ', "name"=>'GUAM'),
	    array( "fips"=>'GR', "name"=>'GREECE'),
	    array( "fips"=>'GT', "name"=>'GUATEMALA'),
	    array( "fips"=>'GV', "name"=>'GUINEA'),
	    array( "fips"=>'GY', "name"=>'GUYANA'),
	    array( "fips"=>'GZ', "name"=>'GAZA STRIP'),
	    array( "fips"=>'HA', "name"=>'HAITI'),
	    array( "fips"=>'HK', "name"=>'HONG KONG'),
	    array( "fips"=>'HM', "name"=>'HEARD ISLAND AND MCDONALD ISLANDS'),
	    array( "fips"=>'HO', "name"=>'HONDURAS'),
	    array( "fips"=>'HQ', "name"=>'HOWLAND ISLAND'),
	    array( "fips"=>'HR', "name"=>'CROATIA'),
	    array( "fips"=>'HU', "name"=>'HUNGARY'),
	    array( "fips"=>'IC', "name"=>'ICELAND'),
	    array( "fips"=>'ID', "name"=>'INDONESIA'),
	    array( "fips"=>'IM', "name"=>'MAN  ISLE OF'),
	    array( "fips"=>'IN', "name"=>'INDIA'),
	    array( "fips"=>'IO', "name"=>'BRITISH INDIAN OCEAN TERRITORY'),
	    array( "fips"=>'IP', "name"=>'CLIPPERTON ISLAND'),
	    array( "fips"=>'IR', "name"=>'IRAN'),
	    array( "fips"=>'IS', "name"=>'ISRAEL'),
	    array( "fips"=>'IT', "name"=>'ITALY'),
	    array( "fips"=>'IV', "name"=>'COTE D\'IVOIRE'),
	    array( "fips"=>'IW', "name"=>'ISRAEL-JORDAN DMZ'),
	    array( "fips"=>'IZ', "name"=>'IRAQ'),
	    array( "fips"=>'JA', "name"=>'JAPAN'),
	    array( "fips"=>'JE', "name"=>'JERSEY'),
	    array( "fips"=>'JM', "name"=>'JAMAICA'),
	    array( "fips"=>'JN', "name"=>'JAN MAYEN'),
	    array( "fips"=>'JO', "name"=>'JORDAN'),
	    array( "fips"=>'JQ', "name"=>'JOHNSTON ATOLL'),
	    array( "fips"=>'JU', "name"=>'JUAN DE NOVA ISLAND'),
	    array( "fips"=>'KE', "name"=>'KENYA'),
	    array( "fips"=>'KG', "name"=>'KYRGYZSTAN'),
	    array( "fips"=>'KN', "name"=>'KOREA, NORTH'),
	    array( "fips"=>'KQ', "name"=>'KINGMAN REEF'),
	    array( "fips"=>'KR', "name"=>'KIRIBATI'),
	    array( "fips"=>'KS', "name"=>'KOREA, SOUTH'),
	    array( "fips"=>'KT', "name"=>'CHRISTMAS ISLAND'),
	    array( "fips"=>'KU', "name"=>'KUWAIT'),
	    array( "fips"=>'KZ', "name"=>'KAZAKHSTAN'),
	    array( "fips"=>'LA', "name"=>'LAOS'),
	    array( "fips"=>'LC', "name"=>'ST. LUCIA AND ST. VINCENT'),
	    array( "fips"=>'LE', "name"=>'LEBANON'),
	    array( "fips"=>'LG', "name"=>'LATVIA'),
	    array( "fips"=>'LH', "name"=>'LITHUANIA'),
	    array( "fips"=>'LI', "name"=>'LIBERIA'),
	    array( "fips"=>'LN', "name"=>'SOUTHERN LINE ISLANDS'),
	    array( "fips"=>'LO', "name"=>'SLOVAKIA'),
	    array( "fips"=>'LQ', "name"=>'PALMYRA ATOLL'),
	    array( "fips"=>'LS', "name"=>'LIECHTENSTEIN'),
	    array( "fips"=>'LT', "name"=>'LESOTHO'),
	    array( "fips"=>'LU', "name"=>'LUXEMBOURG'),
	    array( "fips"=>'LY', "name"=>'LIBYA'),
	    array( "fips"=>'MA', "name"=>'MADAGASCAR'),
	    array( "fips"=>'MB', "name"=>'MARTINIQUE'),
	    array( "fips"=>'MC', "name"=>'MACAU'),
	    array( "fips"=>'MD', "name"=>'MOLDOVA'),
	    array( "fips"=>'ME', "name"=>'MADEIRA'),
	    array( "fips"=>'MF', "name"=>'MAYOTTE'),
	    array( "fips"=>'MG', "name"=>'MONGOLIA'),
	    array( "fips"=>'MH', "name"=>'MONTSERRAT'),
	    array( "fips"=>'MI', "name"=>'MALAWI'),
	    array( "fips"=>'MK', "name"=>'MACEDONIA'),
	    array( "fips"=>'ML', "name"=>'MALI'),
	    array( "fips"=>'MM', "name"=>'BURMA (MYANMAR)'),
	    array( "fips"=>'MN', "name"=>'MONACO'),
	    array( "fips"=>'MO', "name"=>'MOROCCO'),
	    array( "fips"=>'MP', "name"=>'MAURITIUS'),
	    array( "fips"=>'MQ', "name"=>'MIDWAY ISLANDS'),
	    array( "fips"=>'MR', "name"=>'MAURITANIA'),
	    array( "fips"=>'MT', "name"=>'MALTA'),
	    array( "fips"=>'MU', "name"=>'OMAN'),
	    array( "fips"=>'MV', "name"=>'MALDIVES'),
	    array( "fips"=>'MW', "name"=>'MONTENEGRO'),
	    array( "fips"=>'MX', "name"=>'MEXICO'),
	    array( "fips"=>'MY', "name"=>'MALAYSIA'),
	    array( "fips"=>'MZ', "name"=>'MOZAMBIQUE'),
	    array( "fips"=>'NC', "name"=>'NEW CALEDONIA'),
	    array( "fips"=>'NE', "name"=>'NIUE'),
	    array( "fips"=>'NF', "name"=>'NORFOLK ISLAND'),
	    array( "fips"=>'NG', "name"=>'NIGER'),
	    array( "fips"=>'NH', "name"=>'VANUATU'),
	    array( "fips"=>'NI', "name"=>'NIGERIA'),
	    array( "fips"=>'NL', "name"=>'NETHERLANDS'),
	    array( "fips"=>'NO', "name"=>'NORWAY'),
	    array( "fips"=>'NP', "name"=>'NEPAL'),
	    array( "fips"=>'NR', "name"=>'NAURU'),
	    array( "fips"=>'NS', "name"=>'SURINAME'),
	    array( "fips"=>'NT', "name"=>'NETHERLANDS ANTILLES'),
	    array( "fips"=>'NU', "name"=>'NICARAGUA'),
	    array( "fips"=>'NZ', "name"=>'NEW ZEALAND'),
	    array( "fips"=>'OW', "name"=>'OCEAN WEATHER STATIONS'),
	    array( "fips"=>'PA', "name"=>'PARAGUAY'),
	    array( "fips"=>'PC', "name"=>'PITCAIRN ISLANDS'),
	    array( "fips"=>'PE', "name"=>'PERU'),
	    array( "fips"=>'PF', "name"=>'PARACEL ISLANDS'),
	    array( "fips"=>'PG', "name"=>'SPRATLY ISLANDS'),
	    array( "fips"=>'PI', "name"=>'PHOENIX ISLANDS'),
	    array( "fips"=>'PK', "name"=>'PAKISTAN'),
	    array( "fips"=>'PL', "name"=>'POLAND'),
	    array( "fips"=>'PM', "name"=>'PANAMA'),
	    array( "fips"=>'PN', "name"=>'NORTH PACIFIC ISLANDS'),
	    array( "fips"=>'PO', "name"=>'PORTUGAL'),
	    array( "fips"=>'PP', "name"=>'PAPUA NEW GUINEA'),
	    array( "fips"=>'PS', "name"=>'PALAU - TRUST TERRITORY OF THE PACIFIC ISLANDS'),
	    array( "fips"=>'PU', "name"=>'GUINEA-BISSAU'),
	    array( "fips"=>'PZ', "name"=>'SOUTH PACIFIC ISLANDS'),
	    array( "fips"=>'QA', "name"=>'QATAR'),
	    array( "fips"=>'RE', "name"=>'REUNION AND ASSOCIATED ISLANDS'),
	    array( "fips"=>'RM', "name"=>'MARSHALL ISLANDS'),
	    array( "fips"=>'RO', "name"=>'ROMANIA'),
	    array( "fips"=>'RP', "name"=>'PHILIPPINES'),
	    array( "fips"=>'RQ', "name"=>'PUERTO RICO'),
	    array( "fips"=>'RS', "name"=>'RUSSIA'),
	    array( "fips"=>'RW', "name"=>'RWANDA'),
	    array( "fips"=>'SA', "name"=>'SAUDI ARABIA'),
	    array( "fips"=>'SB', "name"=>'ST. PIERRE AND MIQUELON'),
	    array( "fips"=>'SC', "name"=>'ST. KITTS AND NEVIS'),
	    array( "fips"=>'SE', "name"=>'SEYCHELLES'),
	    array( "fips"=>'SF', "name"=>'SOUTH AFRICA'),
	    array( "fips"=>'SG', "name"=>'SENEGAL'),
	    array( "fips"=>'SH', "name"=>'ST. HELENA'),
	    array( "fips"=>'SI', "name"=>'SLOVENIA'),
	    array( "fips"=>'SK', "name"=>'SARAWAK AND SABA'),
	    array( "fips"=>'SL', "name"=>'SIERRA LEONE'),
	    array( "fips"=>'SM', "name"=>'SAN MARINO'),
	    array( "fips"=>'SN', "name"=>'SINGAPORE'),
	    array( "fips"=>'SO', "name"=>'SOMALIA'),
	    array( "fips"=>'SP', "name"=>'SPAIN'),
	    array( "fips"=>'SR', "name"=>'SERBIA'),
	    array( "fips"=>'SS', "name"=>'ST. MAARTEN'),
	    array( "fips"=>'ST', "name"=>'ST. LUCIA'),
	    array( "fips"=>'SU', "name"=>'SUDAN'),
	    array( "fips"=>'SV', "name"=>'SVALBARD'),
	    array( "fips"=>'SW', "name"=>'SWEDEN'),
	    array( "fips"=>'SX', "name"=>'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS'),
	    array( "fips"=>'SY', "name"=>'SYRIA'),
	    array( "fips"=>'SZ', "name"=>'SWITZERLAND'),
	    array( "fips"=>'TC', "name"=>'UNITED ARAB EMIRATES'),
	    array( "fips"=>'TD', "name"=>'TRINIDAD AND TOBAGO'),
	    array( "fips"=>'TE', "name"=>'TROMELIN ISLAND'),
	    array( "fips"=>'TH', "name"=>'THAILAND'),
	    array( "fips"=>'TI', "name"=>'TAJIKISTAN'),
	    array( "fips"=>'TK', "name"=>'TURKS AND CAICOS ISLANDS'),
	    array( "fips"=>'TL', "name"=>'TOKELAU'),
	    array( "fips"=>'TN', "name"=>'TONGA'),
	    array( "fips"=>'TO', "name"=>'TOGO'),
	    array( "fips"=>'TP', "name"=>'SAO TOME AND PRINCIPE'),
	    array( "fips"=>'TS', "name"=>'TUNISIA'),
	    array( "fips"=>'TU', "name"=>'TURKEY'),
	    array( "fips"=>'TV', "name"=>'TUVALU'),
	    array( "fips"=>'TW', "name"=>'TAIWAN'),
	    array( "fips"=>'TX', "name"=>'TURKMENISTAN'),
	    array( "fips"=>'TZ', "name"=>'TANZANIA'),
	    array( "fips"=>'UA', "name"=>'FORMER USSR (ASIA)'),
	    array( "fips"=>'UE', "name"=>'FORMER USSR (EUROPE)'),
	    array( "fips"=>'UG', "name"=>'UGANDA'),
	    array( "fips"=>'UK', "name"=>'UNITED KINGDOM'),
	    array( "fips"=>'UP', "name"=>'UKRAINE'),
	    array( "fips"=>'US', "name"=>'UNITED STATES'),
	    array( "fips"=>'UV', "name"=>'BURKINA FASO'),
	    array( "fips"=>'UY', "name"=>'URUGUAY'),
	    array( "fips"=>'UZ', "name"=>'UZBEKISTAN'),
	    array( "fips"=>'VC', "name"=>'ST. VINCENT AND THE GRENADINES'),
	    array( "fips"=>'VE', "name"=>'VENEZUELA'),
	    array( "fips"=>'VI', "name"=>'VIRGIN ISLANDS (BRITISH)'),
	    array( "fips"=>'VM', "name"=>'VIETNAM'),
	    array( "fips"=>'VQ', "name"=>'VIRGIN ISLANDS (U.S.)'),
	    array( "fips"=>'VT', "name"=>'VATICAN CITY'),
	    array( "fips"=>'WA', "name"=>'NAMIBIA'),
	    array( "fips"=>'WE', "name"=>'WEST BANK'),
	    array( "fips"=>'WF', "name"=>'WALLIS AND FUTUNA'),
	    array( "fips"=>'WI', "name"=>'WESTERN SAHARA'),
	    array( "fips"=>'WQ', "name"=>'WAKE ISLAND'),
	    array( "fips"=>'WS', "name"=>'WESTERN SAMOA'),
	    array( "fips"=>'WZ', "name"=>'SWAZILAND'),
	    array( "fips"=>'YM', "name"=>'YEMEN'),
	    array( "fips"=>'YU', "name"=>'YUGOSLAVIA & FORMER TERRITORY'),
	    array( "fips"=>'YY', "name"=>'ST. MARTEEN, ST. EUSTATIUS, AND SABA'),
	    array( "fips"=>'ZA', "name"=>'ZAMBIA'),
	    array( "fips"=>'ZI', "name"=>'ZIMBABWE'),
	    array( "fips"=>'ZM', "name"=>'SAMOA'),
	    array( "fips"=>'ZZ', "name"=>'ST. MARTIN AND ST. BARTHOLOMEW')
	);

       $numCountries = count($countries);

       for ($i = 0; $i < $numCountries; $i++)
       {
	  $country = new Country();
	  $country->id     = $i+1;
          $country->fips   = $countries[$i]["fips"];
          $country->name   = $countries[$i]["name"];
          $country->save();
       }      
       
       $this->info("loaded " . $numCountries . " rows into 'countries' table.");
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
	// determine if table exists and is empty

	$retval1 = $this->checkDatabaseTable( 'states' );
	$retval2 = $this->checkDatabaseTable( 'countries' );

	if ($retval1 && $retval2)
	{
	    $this->loadStates();
	    $this->loadCountries();
	}
       
       return ($retval1 && $retval2);
    }
}
