<?php
namespace app\helpers;

use Yii;
use yii\base\Component;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\caching\FileCache;
use app\models\User;
use yii\di\Instance;

class AppHelper extends Component
{
  const STATUS_ACTIVE=1;
  const STATUS_INACTIVE=2;
  protected $query=null;
  protected $lookups=[];
  protected $lookupsDeleted=[];
  protected $tables=[];
  private $useCache=true;
  private $cache=null;
  // in seconds
  private $cacheTimeout=120;

  public function __construct()
  {
    $this->cache=Instance::ensure('cache', FileCache::className());
    $this->query=new Query();

    $this->lookups['countries']['vals']=['' => '',
      'CA' => 'Canada',
      'US' => 'USA',
      'DZ' => 'Algeria',
      'AD' => 'Andorra',
      'AO' => 'Angola',
      'AI' => 'Anguilla',
      'AG' => 'Antigua &amp; Barbuda',
      'AR' => 'Argentina',
      'AM' => 'Armenia',
      'AW' => 'Aruba',
      'AU' => 'Australia',
      'AT' => 'Austria',
      'AZ' => 'Azerbaijan',
      'BS' => 'Bahamas',
      'BH' => 'Bahrain',
      'BD' => 'Bangladesh',
      'BB' => 'Barbados',
      'BY' => 'Belarus',
      'BE' => 'Belgium',
      'BZ' => 'Belize',
      'BJ' => 'Benin',
      'BM' => 'Bermuda',
      'BT' => 'Bhutan',
      'BO' => 'Bolivia',
      'BA' => 'Bosnia Herzegovina',
      'BW' => 'Botswana',
      'BR' => 'Brazil',
      'BN' => 'Brunei',
      'BG' => 'Bulgaria',
      'BF' => 'Burkina Faso',
      'BI' => 'Burundi',
      'KH' => 'Cambodia',
      'CM' => 'Cameroon',
      'CV' => 'Cape Verde Islands',
      'KY' => 'Cayman Islands',
      'CF' => 'Central African Republic',
      'CL' => 'Chile',
      'CN' => 'China',
      'CO' => 'Colombia',
      'KM' => 'Comoros',
      'CG' => 'Congo',
      'CK' => 'Cook Islands',
      'CR' => 'Costa Rica',
      'HR' => 'Croatia',
      'CU' => 'Cuba',
      'CY' => 'Cyprus North',
      'CY' => 'Cyprus South',
      'CZ' => 'Czech Republic',
      'DK' => 'Denmark',
      'DJ' => 'Djibouti',
      'DM' => 'Dominica',
      'DO' => 'Dominican Republic',
      'EC' => 'Ecuador',
      'EG' => 'Egypt',
      'SV' => 'El Salvador',
      'GQ' => 'Equatorial Guinea',
      'ER' => 'Eritrea',
      'EE' => 'Estonia',
      'ET' => 'Ethiopia',
      'FK' => 'Falkland Islands',
      'FO' => 'Faroe Islands',
      'FJ' => 'Fiji',
      'FI' => 'Finland',
      'FR' => 'France',
      'GF' => 'French Guiana',
      'PF' => 'French Polynesia',
      'GA' => 'Gabon',
      'GM' => 'Gambia',
      'GE' => 'Georgia',
      'DE' => 'Germany',
      'GH' => 'Ghana',
      'GI' => 'Gibraltar',
      'GR' => 'Greece',
      'GL' => 'Greenland',
      'GD' => 'Grenada',
      'GP' => 'Guadeloupe',
      'GU' => 'Guam',
      'GT' => 'Guatemala',
      'GN' => 'Guinea',
      'GW' => 'Guinea - Bissau',
      'GY' => 'Guyana',
      'HT' => 'Haiti',
      'HN' => 'Honduras',
      'HK' => 'Hong Kong',
      'HU' => 'Hungary',
      'IS' => 'Iceland',
      'IN' => 'India',
      'ID' => 'Indonesia',
      'IR' => 'Iran',
      'IQ' => 'Iraq',
      'IE' => 'Ireland',
      'IL' => 'Israel',
      'IT' => 'Italy',
      'JM' => 'Jamaica',
      'JP' => 'Japan',
      'JO' => 'Jordan',
      'KZ' => 'Kazakhstan',
      'KE' => 'Kenya',
      'KI' => 'Kiribati',
      'KP' => 'Korea North',
      'KR' => 'Korea South',
      'KW' => 'Kuwait',
      'KG' => 'Kyrgyzstan',
      'LA' => 'Laos',
      'LV' => 'Latvia',
      'LB' => 'Lebanon',
      'LS' => 'Lesotho',
      'LR' => 'Liberia',
      'LY' => 'Libya',
      'LI' => 'Liechtenstein',
      'LT' => 'Lithuania',
      'LU' => 'Luxembourg',
      'MO' => 'Macao',
      'MK' => 'Macedonia',
      'MG' => 'Madagascar',
      'MW' => 'Malawi',
      'MY' => 'Malaysia',
      'MV' => 'Maldives',
      'ML' => 'Mali',
      'MT' => 'Malta',
      'MH' => 'Marshall Islands',
      'MQ' => 'Martinique',
      'MR' => 'Mauritania',
      'YT' => 'Mayotte',
      'MX' => 'Mexico',
      'FM' => 'Micronesia',
      'MD' => 'Moldova',
      'MC' => 'Monaco',
      'MN' => 'Mongolia',
      'MS' => 'Montserrat',
      'MA' => 'Morocco',
      'MZ' => 'Mozambique',
      'MN' => 'Myanmar',
      'NA' => 'Namibia',
      'NR' => 'Nauru',
      'NP' => 'Nepal',
      'NL' => 'Netherlands',
      'NC' => 'New Caledonia',
      'NZ' => 'New Zealand',
      'NI' => 'Nicaragua',
      'NE' => 'Niger',
      'NG' => 'Nigeria',
      'NU' => 'Niue',
      'NF' => 'Norfolk Islands',
      'NP' => 'Northern Marianas',
      'NO' => 'Norway',
      'OM' => 'Oman',
      'PW' => 'Palau',
      'PA' => 'Panama',
      'PG' => 'Papua New Guinea',
      'PY' => 'Paraguay',
      'PE' => 'Peru',
      'PH' => 'Philippines',
      'PL' => 'Poland',
      'PT' => 'Portugal',
      'PR' => 'Puerto Rico',
      'QA' => 'Qatar',
      'RE' => 'Reunion',
      'RO' => 'Romania',
      'RU' => 'Russia',
      'RW' => 'Rwanda',
      'SM' => 'San Marino',
      'ST' => 'Sao Tome &amp; Principe',
      'SA' => 'Saudi Arabia',
      'SN' => 'Senegal',
      'CS' => 'Serbia',
      'SC' => 'Seychelles',
      'SL' => 'Sierra Leone',
      'SG' => 'Singapore',
      'SK' => 'Slovak Republic',
      'SI' => 'Slovenia',
      'SB' => 'Solomon Islands',
      'SO' => 'Somalia',
      'ZA' => 'South Africa',
      'ES' => 'Spain',
      'LK' => 'Sri Lanka',
      'SH' => 'St. Helena',
      'KN' => 'St. Kitts',
      'SC' => 'St. Lucia',
      'SD' => 'Sudan',
      'SR' => 'Suriname',
      'SZ' => 'Swaziland',
      'SE' => 'Sweden',
      'CH' => 'Switzerland',
      'SI' => 'Syria',
      'TW' => 'Taiwan',
      'TJ' => 'Tajikstan',
      'TH' => 'Thailand',
      'TG' => 'Togo',
      'TO' => 'Tonga',
      'TT' => 'Trinidad &amp; Tobago',
      'TN' => 'Tunisia',
      'TR' => 'Turkey',
      'TM' => 'Turkmenistan',
      'TM' => 'Turkmenistan',
      'TC' => 'Turks &amp; Caicos Islands',
      'TV' => 'Tuvalu',
      'UG' => 'Uganda',
      'GB' => 'UK',
      'UA' => 'Ukraine',
      'AE' => 'United Arab Emirates',
      'UY' => 'Uruguay',
      'UZ' => 'Uzbekistan',
      'VU' => 'Vanuatu',
      'VA' => 'Vatican City',
      'VE' => 'Venezuela',
      'VN' => 'Vietnam',
      'VG' => 'Virgin Islands - British',
      'VI' => 'Virgin Islands - US',
      'WF' => 'Wallis &amp; Futuna',
      'YE' => 'Yemen',
      'ZM' => 'Zambia',
      'ZW' => 'Zimbabwe'];

    $this->lookups['states']['vals']=['' => '',
      ' ' => '---- Canada States ----',
      'AB' => 'Alberta',
      'BC' => 'British Columbia',
      'MB' => 'Manitoba',
      'NB' => 'New Brunswick',
      'NL' => 'Newfoundland and Labrador',
      'NS' => 'Nova Scotia',
      'ON' => 'Ontario',
      'PE' => 'Prince Edward Island',
      'QC' => 'Quebec',
      'SK' => 'Saskatchewan',
      'NT' => 'Northwest Territories',
      'NU' => 'Nunavut',
      'YT' => 'Yukon',
      '  ' => '---- US States ----',
      'AL' => 'Alabama',
      'AK' => 'Alaska',
      'AZ' => 'Arizona',
      'AR' => 'Arkansas',
      'CA' => 'California',
      'CO' => 'Colorado',
      'CT' => 'Connecticut',
      'DE' => 'Delaware',
      'DC' => 'District Of Columbia',
      'FL' => 'Florida',
      'GA' => 'Georgia',
      'HI' => 'Hawaii',
      'ID' => 'Idaho',
      'IL' => 'Illinois',
      'IN' => 'Indiana',
      'IA' => 'Iowa',
      'KS' => 'Kansas',
      'KY' => 'Kentucky',
      'LA' => 'Louisiana',
      'ME' => 'Maine',
      'MD' => 'Maryland',
      'MA' => 'Massachusetts',
      'MI' => 'Michigan',
      'MN' => 'Minnesota',
      'MS' => 'Mississippi',
      'MO' => 'Missouri',
      'MT' => 'Montana',
      'NE' => 'Nebraska',
      'NV' => 'Nevada',
      'NH' => 'New Hampshire',
      'NJ' => 'New Jersey',
      'NM' => 'New Mexico',
      'NY' => 'New York',
      'NC' => 'North Carolina',
      'ND' => 'North Dakota',
      'OH' => 'Ohio',
      'OK' => 'Oklahoma',
      'OR' => 'Oregon',
      'PA' => 'Pennsylvania',
      'RI' => 'Rhode Island',
      'SC' => 'South Carolina',
      'SD' => 'South Dakota',
      'TN' => 'Tennessee',
      'TX' => 'Texas',
      'UT' => 'Utah',
      'VT' => 'Vermont',
      'VA' => 'Virginia',
      'WA' => 'Washington',
      'WV' => 'West Virginia',
      'WI' => 'Wisconsin',
      'WY' => 'Wyoming',
      'AS' => 'American Samoa',
      'GU' => 'Guam',
      'MP' => 'Northern Mariana Islands',
      'PR' => 'Puerto Rico',
      'UM' => 'United States Minor Outlying Islands',
      'VI' => 'Virgin Islands'];

    $this->lookups['probabilities']['vals']=['' => '', '15' => '15', '25' => '25', '50' => '50', '75' => '75', '90' => '90', '100' => '100'];
    $this->lookups['allday']['vals']=['0' => '', '1' => Yii::t('main', 'Allday')];

    $this->lookupsDeleted['countries']=[];
    $this->lookupsDeleted['states']=[];
    $this->lookupsDeleted['probabilities']=[];
    $this->lookupsDeleted['allday']=[];
  }

  public function getLookupValueColumnName($pTable)
  {
    $columns[]='id';
    $columns[]='deleted_at';

    switch ($pTable)
    {
      case 'users':
      case 'accounts':
      case 'opportunities':
        $columns[]='name as value';
      break;

      case 'leads':
      case 'contacts':
        $columns[]='concat(first_name, " ", last_name) as value';
      break;

      default:
        $columns[]='value';
        $columns[]='description';
    }

    return $columns;
  }

  public function getLookupDataFull($pTable)
  {
    $requiresCache=in_array($pTable, ['countries', 'states', 'probabilities']) ? false : true;

    if ($requiresCache && $this->useCache)
    {
      $cached=$this->cache->get($pTable);
      if ($cached !== false)
        return $cached;
    }

    if (empty($this->lookups[$pTable]))
    {
      // $where=$pTable=='users' ? ' status="active" ' : '';
      $this->query=new Query();
      $this->query->select($this->getLookupValueColumnName($pTable))
        ->from($pTable);
      // ->where($where);

      if (stripos($pTable, 'lkp_') !== false)
        $this->query->orderBy('idxpos asc');

      $rows=$this->query->all();
      // $rows=DB::select("select id, $column as value, deleted_at from $pTable $where");

      $lookups=['vals' => ['' => ''], 'descs' => ['' => '']];
      $this->lookupsDeleted[$pTable]=[];

      foreach ($rows as $row)
      {
        if ($row['deleted_at'])
          $this->lookupsDeleted[$pTable][$row['id']]=1;
        else
        {
          $rowId=$row['id'];

          $lookups['vals'][$rowId]=$row['value'];
          $lookups['descs'][$rowId]=isset($row['description']) ? $row['description'] : null;
        }
      }

      $this->lookups[$pTable]=$lookups;
    }

    if ($requiresCache && $this->useCache)
      $this->cache->set($pTable, $this->lookups[$pTable], $this->cacheTimeout);

    return $this->lookups[$pTable];
  }

  public function getLookupData($pTable, $excludeIds=null)
  {
    $table=$this->getLookupDataFull($pTable);

    if (is_array($excludeIds))
    {
      $tmp=[];

      foreach ($table['vals'] as $k=>$v)
        if (!in_array($k, $excludeIds))
          $tmp[$k]=$v;

      return $tmp;
    }

    return $table['vals'];
  }

  public function getLookupValue($pTable='', $pId=null, $pTooltip=true)
  {
    if (empty($pId))
      return '';

    $rows=$this->getLookupDataFull($pTable);

    if (empty($rows))
      return '';

    $value='';
    if (isset($rows['vals'][$pId]))
      $value.=Html::encode($rows['vals'][$pId]);

    if ($pTooltip && !empty($rows['descs'][$pId]))
      $value.='<span title="' . Html::encode($rows['descs'][$pId]) . '" " data-toggle="tooltip" class="glyphicon glyphicon-question-sign tooltip-icon"></span>';

    return $value;
  }

  public function getLookupDescription($pTable='', $pId=null)
  {
    if (empty($pId))
      return '';

    $rows=$this->getLookupDataFull($pTable);

    if (empty($rows))
      return '';

    return isset($rows[$pId]) ? $rows[$pId][1] : '';
  }

  public function getLookupValueHistory($pField='', $pModel='', $pId=null)
  {
    // @formatter:off
    // this mapping is required to simplify history field lookups
    switch ($pField)
    {
      case 'owner_id': $table='users'; break;
      case 'account_id': $table='accounts'; break;
      case 'account2_id': $table='accounts'; break;
      case 'account3_id': $table='accounts'; break;
      case 'contact_id': $table='contacts'; break;
      case 'state': $table='states'; break;
      case 'state_other': $table='states'; break;
      case 'country': $table='countries'; break;
      case 'probability': $table='probabilities'; break;
      case 'country_other': $table='countries'; break;

      case 'lead_source_id': $table='lkp_lead_source'; break;
      case 'industry_id': $table='lkp_industry'; break;
      case 'rating_id': $table='lkp_rating'; break;

      case 'type_id': $table='lkp_' . strtolower($pModel) . '_type'; break;
      case 'status_id': $table='lkp_' . strtolower($pModel) . '_status'; break;
      case 'category_id': $table='lkp_' . strtolower($pModel) . '_category'; break;
      case 'category2_id': $table='lkp_' . strtolower($pModel) . '_category'; break;
      case 'category3_id': $table='lkp_' . strtolower($pModel) . '_category'; break;
      case 'ownership_id': $table='lkp_' . strtolower($pModel) . '_ownership'; break;

      case 'stage_id': $table='lkp_opportunity_stage'; break;

      case 'allday': $table='allday'; break;
      case 'priority_id': $table='lkp_' . strtolower($pModel) . '_priority'; break;

      default: return HTML::encode($pId);
    }

    return $this->getLookupValue($table, $pId, false);
    // @formatter:on
  }

  public function getValueFromTable($pTable='', $pId=null)
  {
    if (empty($pId))
      return '';

    if (!isset($this->tables[$pTable]))
      $this->tables[$pTable]=[];

    if (!isset($this->tables[$pTable][$pId]))
    {
      $this->query=new Query();
      $this->query->select($this->getLookupValueColumnName($pTable))
        ->from($pTable)
        ->where(['id' => $pId]); // ->where($where);
      $result=$this->query->one();

      $this->tables[$pTable][$pId]=is_array($result) ? Html::encode($result['value']) : '';
    }

    return $this->tables[$pTable][$pId];
  }

  public function getCachedUser($pId=null)
  {
    if ($this->useCache)
    {
      $table='users-cache';

      if (!isset($this->tables[$table]))
        $this->tables[$table]=[];

      if (!isset($this->tables[$table][$pId]))
        $this->tables[$table][$pId]=User::findOne($pId);

      return $this->tables[$table][$pId];
    }

    return User::findOne($pId);
  }

  public function getDbName()
  {
    $dsn=explode('dbname=', Yii::$app->db->dsn);

    return $dsn[1];
  }

  public function arr2Csv($pArr, $pHeader=null)
  {
    $csv='';

    // put header on first line
    // multiple columns?
    if (is_array($pHeader))
    {
      foreach ($pHeader as $h)
        $csv.='"' . str_ireplace('"', '""', $h) . '",';
      $csv.="\n";
    }
    else if ($pHeader)
      $csv.='"' . str_ireplace('"', '""', $pHeader) . '"' . "\n";

      // add data rows
    foreach ($pArr as $v1)
    {
      // multiple columns?
      if (is_array($v1))
      {
        foreach ($v1 as $v2)
          $csv.='"' . str_ireplace('"', '""', $v2) . '",';

        $csv.="\n";
      }
      else
        $csv.='"' . str_ireplace('"', '""', $v1) . '"' . "\n";
    }

    // cleanup
    $csv=preg_replace("/,$/im", '', $csv);

    return $csv;
  }

  public function getRandomColor()
  {
    return '#' . dechex(rand(20, 240)) . dechex(rand(20, 240)) . dechex(rand(20, 240));
  }

  /**
   *
   * @param related type name; ie: Contact
   * @return array
   */
  public function getRelatedTypeInfo($pTypeName)
  {
    $pTypeName=empty($pTypeName) ? 'contact' : strtolower($pTypeName);

    switch ($pTypeName)
    {
      case 'contact':
        return [1, 'contacts', Yii::t('main', 'Contact Name')];
      case 'account':
        return [2, 'accounts', Yii::t('main', 'Account Name')];
      case 'opportunity':
        return [3, 'opportunities', Yii::t('main', 'Opportunity Name')];
      default:
        return [1, 'contacts', Yii::t('main', 'Contact Name')];
    }
  }

  public function getRelatedTypeId($pTypeName)
  {
    return $this->getRelatedTypeInfo($pTypeName)[0];
  }

  public function getRelatedTypeName($pTypeId)
  {
    switch ($pTypeId)
    {
      case 1:
        return 'Contact';
      case 2:
        return 'Account';
      case 3:
        return 'Opportunity';
      default:
        return 'Contact';
    }
  }

  public function getActivityAddNewRelatedButton($activityId='')
  {
    $action=$activityId ? 'activity/addrelated' : 'activity/create';

    return '
<div class="btn-group btn-success button-new-index-page button-new-with-menu">
	<button type="button" class="btn btn-success">' . Yii::t('main', 'Add New') . '</button>
	<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu btn-success" role="menu">
		<li>' . Html::a(Yii::t('main', 'Contact'), Url::to([$action, 'id' => $activityId, 'related_type' => 'Contact'])) . '</li>
		<li>' . Html::a(Yii::t('main', 'Account'), Url::to([$action, 'id' => $activityId, 'related_type' => 'Account'])) . '</li>
		<li>' . Html::a(Yii::t('main', 'Opportunity'), Url::to([$action, 'id' => $activityId, 'related_type' => 'Opportunity'])) . '</li>
	</ul>
</div>';
  }
}
