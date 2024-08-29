<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Infrastructure\Enum;

enum CountryCodeEnum: string
{
    // Africa
    case DZ = 'DZ'; // Algeria
    case AO = 'AO'; // Angola
    case BJ = 'BJ'; // Benin
    case BW = 'BW'; // Botswana
    case BF = 'BF'; // Burkina Faso
    case BI = 'BI'; // Burundi
    case CM = 'CM'; // Cameroon
    case CV = 'CV'; // Cape Verde
    case CF = 'CF'; // Central African Republic
    case TD = 'TD'; // Chad
    case KM = 'KM'; // Comoros
    case CG = 'CG'; // Congo (Brazzaville)
    case CD = 'CD'; // Congo (Kinshasa)
    case DJ = 'DJ'; // Djibouti
    case EG = 'EG'; // Egypt
    case GQ = 'GQ'; // Equatorial Guinea
    case ER = 'ER'; // Eritrea
    case SZ = 'SZ'; // Eswatini
    case ET = 'ET'; // Ethiopia
    case GA = 'GA'; // Gabon
    case GM = 'GM'; // Gambia
    case GH = 'GH'; // Ghana
    case GN = 'GN'; // Guinea
    case GW = 'GW'; // Guinea-Bissau
    case CI = 'CI'; // Ivory Coast
    case KE = 'KE'; // Kenya
    case LS = 'LS'; // Lesotho
    case LR = 'LR'; // Liberia
    case LY = 'LY'; // Libya
    case MG = 'MG'; // Madagascar
    case MW = 'MW'; // Malawi
    case ML = 'ML'; // Mali
    case MR = 'MR'; // Mauritania
    case MU = 'MU'; // Mauritius
    case MA = 'MA'; // Morocco
    case MZ = 'MZ'; // Mozambique
    case NA = 'NA'; // Namibia
    case NE = 'NE'; // Niger
    case NG = 'NG'; // Nigeria
    case RW = 'RW'; // Rwanda
    case ST = 'ST'; // Sao Tome and Principe
    case SN = 'SN'; // Senegal
    case SC = 'SC'; // Seychelles
    case SL = 'SL'; // Sierra Leone
    case SO = 'SO'; // Somalia
    case ZA = 'ZA'; // South Africa
    case SS = 'SS'; // South Sudan
    case SD = 'SD'; // Sudan
    case TZ = 'TZ'; // Tanzania
    case TG = 'TG'; // Togo
    case TN = 'TN'; // Tunisia
    case UG = 'UG'; // Uganda
    case ZM = 'ZM'; // Zambia
    case ZW = 'ZW'; // Zimbabwe

    // Asia
    case AF = 'AF'; // Afghanistan
    case AM = 'AM'; // Armenia
    case AZ = 'AZ'; // Azerbaijan
    case BH = 'BH'; // Bahrain
    case BD = 'BD'; // Bangladesh
    case BT = 'BT'; // Bhutan
    case BN = 'BN'; // Brunei
    case KH = 'KH'; // Cambodia
    case CN = 'CN'; // China
    case CY = 'CY'; // Cyprus
    case GE = 'GE'; // Georgia
    case IN = 'IN'; // India
    case ID = 'ID'; // Indonesia
    case IR = 'IR'; // Iran
    case IQ = 'IQ'; // Iraq
    case IL = 'IL'; // Israel
    case JP = 'JP'; // Japan
    case JO = 'JO'; // Jordan
    case KZ = 'KZ'; // Kazakhstan
    case KW = 'KW'; // Kuwait
    case KG = 'KG'; // Kyrgyzstan
    case LA = 'LA'; // Laos
    case LB = 'LB'; // Lebanon
    case MY = 'MY'; // Malaysia
    case MV = 'MV'; // Maldives
    case MN = 'MN'; // Mongolia
    case MM = 'MM'; // Myanmar
    case NP = 'NP'; // Nepal
    case KP = 'KP'; // North Korea
    case OM = 'OM'; // Oman
    case PK = 'PK'; // Pakistan
    case PS = 'PS'; // Palestine
    case PH = 'PH'; // Philippines
    case QA = 'QA'; // Qatar
    case SA = 'SA'; // Saudi Arabia
    case SG = 'SG'; // Singapore
    case KR = 'KR'; // South Korea
    case LK = 'LK'; // Sri Lanka
    case SY = 'SY'; // Syria
    case TW = 'TW'; // Taiwan
    case TJ = 'TJ'; // Tajikistan
    case TH = 'TH'; // Thailand
    case TR = 'TR'; // Turkey
    case TM = 'TM'; // Turkmenistan
    case AE = 'AE'; // United Arab Emirates
    case UZ = 'UZ'; // Uzbekistan
    case VN = 'VN'; // Vietnam
    case YE = 'YE'; // Yemen

    // Europe
    case AL = 'AL'; // Albania
    case AD = 'AD'; // Andorra
    case AT = 'AT'; // Austria
    case BY = 'BY'; // Belarus
    case BE = 'BE'; // Belgium
    case BA = 'BA'; // Bosnia and Herzegovina
    case BG = 'BG'; // Bulgaria
    case HR = 'HR'; // Croatia
    case CZ = 'CZ'; // Czech Republic
    case DK = 'DK'; // Denmark
    case EE = 'EE'; // Estonia
    case FI = 'FI'; // Finland
    case FR = 'FR'; // France
    case DE = 'DE'; // Germany
    case GR = 'GR'; // Greece
    case HU = 'HU'; // Hungary
    case IS = 'IS'; // Iceland
    case IE = 'IE'; // Ireland
    case IT = 'IT'; // Italy
    case LV = 'LV'; // Latvia
    case LI = 'LI'; // Liechtenstein
    case LT = 'LT'; // Lithuania
    case LU = 'LU'; // Luxembourg
    case MT = 'MT'; // Malta
    case MD = 'MD'; // Moldova
    case MC = 'MC'; // Monaco
    case ME = 'ME'; // Montenegro
    case NL = 'NL'; // Netherlands
    case MK = 'MK'; // North Macedonia
    case NO = 'NO'; // Norway
    case PL = 'PL'; // Poland
    case PT = 'PT'; // Portugal
    case RO = 'RO'; // Romania
    case RU = 'RU'; // Russia
    case SM = 'SM'; // San Marino
    case RS = 'RS'; // Serbia
    case SK = 'SK'; // Slovakia
    case SI = 'SI'; // Slovenia
    case ES = 'ES'; // Spain
    case SE = 'SE'; // Sweden
    case CH = 'CH'; // Switzerland
    case UA = 'UA'; // Ukraine
    case GB = 'GB'; // United Kingdom
    case VA = 'VA'; // Vatican City

    // North America
    case AG = 'AG'; // Antigua and Barbuda
    case BS = 'BS'; // Bahamas
    case BB = 'BB'; // Barbados
    case BZ = 'BZ'; // Belize
    case CA = 'CA'; // Canada
    case CR = 'CR'; // Costa Rica
    case CU = 'CU'; // Cuba
    case DM = 'DM'; // Dominica
    case DO = 'DO'; // Dominican Republic
    case SV = 'SV'; // El Salvador
    case GD = 'GD'; // Grenada
    case GT = 'GT'; // Guatemala
    case HT = 'HT'; // Haiti
    case HN = 'HN'; // Honduras
    case JM = 'JM'; // Jamaica
    case MX = 'MX'; // Mexico
    case NI = 'NI'; // Nicaragua
    case PA = 'PA'; // Panama
    case KN = 'KN'; // Saint Kitts and Nevis
    case LC = 'LC'; // Saint Lucia
    case VC = 'VC'; // Saint Vincent and the Grenadines
    case TT = 'TT'; // Trinidad and Tobago
    case US = 'US'; // United States

    // Oceania
    case AU = 'AU'; // Australia
    case FJ = 'FJ'; // Fiji
    case KI = 'KI'; // Kiribati
    case MH = 'MH'; // Marshall Islands
    case FM = 'FM'; // Micronesia
    case NR = 'NR'; // Nauru
    case NZ = 'NZ'; // New Zealand
    case PW = 'PW'; // Palau
    case PG = 'PG'; // Papua New Guinea
    case WS = 'WS'; // Samoa
    case SB = 'SB'; // Solomon Islands
    case TO = 'TO'; // Tonga
    case TV = 'TV'; // Tuvalu
    case VU = 'VU'; // Vanuatu

    // South America
    case AR = 'AR'; // Argentina
    case BO = 'BO'; // Bolivia
    case BR = 'BR'; // Brazil
    case CL = 'CL'; // Chile
    case CO = 'CO'; // Colombia
    case EC = 'EC'; // Ecuador
    case GY = 'GY'; // Guyana
    case PY = 'PY'; // Paraguay
    case PE = 'PE'; // Peru
    case SR = 'SR'; // Suriname
    case UY = 'UY'; // Uruguay
    case VE = 'VE'; // Venezuela

    public function isEurope(): bool
    {
        return match ($this) {
            self::AL, self::AD, self::AT, self::BY, self::BE,
            self::BA, self::BG, self::HR, self::CZ, self::CY,
            self::EE, self::FI, self::FR, self::DE, self::GR,
            self::HU, self::IS, self::IE, self::IT, self::LV,
            self::LI, self::LT, self::LU, self::MT, self::MD,
            self::MC, self::ME, self::NL, self::MK, self::NO,
            self::PL, self::PT, self::RO, self::RU, self::SM,
            self::RS, self::SK, self::SI, self::ES, self::SE,
            self::CH, self::UA, self::VA, self::DK => true,
            default => false,
        };
    }
}
