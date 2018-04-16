<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('APPNAME',"e-SIMPADU");
define('KOTA',"Kalsel");
define('OWNER',"NAMA KANTOR YANG MENGGUNAKAN APLIKASI ");
define('ALAMAT'," Jl. A. Yani Km 1-300 - Kalimantan Selatan");
define('tahap',"5"); //JUMLAH TAHAPAN PROGRES LAYANAN (PENDAFTARAN SAMPAI SELESAI)

/* tidak perlu di rubah karena akan mempegaruhi sistem */
define('APPFOOTER',"Copyright &copy;&nbsp;2016 - Mitra-TIK");
define('dokumen_url','files/dokumen/'); 
define('profile_url','files/profile/');

$config['base_url'] = '';
$config['index_page'] = '';
$config['uri_protocol']	= 'AUTO';
$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['allow_get_array']	= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']	= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';
$config['encryption_key'] = 'APRISUHARTOJOYORAHARJO1234567890';
$config['sess_cookie_name']	= 'ci_session';
$config['sess_expiration']	= 7200;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']	= 'ci_sessions';
$config['sess_match_ip']	= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 300;

$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;
$config['global_xss_filtering'] = TRUE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = TRUE;
$config['proxy_ips'] = '';


/* End of file config.php */
/* Location: ./application/config/config.php */
