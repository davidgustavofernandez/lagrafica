<?php

/**
 * Configuration, Global Settings
 * 
 * Configuration configure, set all the variables and constants necessary for the Framework.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 25/06/2012)
 * @package {SMVC} Simple Model View Controller
 */
/**
 *   class,
 * @subpackage Configuration
 * 
 * @example:
 * $c = new Configuration();
 */
class Configuration
{
    /**
     * __construct function
     * @see __construct()
     * Note: Constructor sets up
     */
    public function __construct()
    {
        $this->setConfigTimeZone();
        $this->setConfigIniSet();
        $this->setConfigConstants();
        $this->setRelateConstants();
        //$this->setConfigFacebookAPI();
    }
    /**
     * __destruct function
     * @see __destruct()
     * Note: Destroyer, erases the object
     */
    public function __destruct()
    {
        //unset($this); // deprecate
    }
    /**
     * setConfigTimeZone function
     * @uses date_default_timezone_set(), Function
     * Note: Set time use.
     */
    public function setConfigTimeZone()
    {
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        setlocale(LC_ALL, "es_ES");
        /**
         * TIME_UTC constant
         * Note: timezone
         */
        define("TIME_UTC", "UTC");
        /**
         * TIME_ZONE constant
         * Note: timezone
         */
        define("TIME_ZONE", "America/Argentina/Buenos_Aires");
        /**
         * TIME_ZONE_OFFSET constant
         * Note: Time Zone offset
         */
        define("TIME_ZONE_OFFSET", "-03:00");
        /**
         * W3C_DATETIME_FORMAT constant
         * Note: Time format See http://www.w3.org/TR/NOTE-datetime
         */
        define("W3C_DATETIME_FORMAT", "Y-m-d\TH:i:s");
        /**
         * DATETIME_FORMAT constant
         * Note: Time format
         */
        define("DATETIME_FORMAT", "Y-m-d H:i:s");
        /**
         * DATE_FORMAT constant
         * Note: Date format
         */
        define("DATE_FORMAT", "Y-m-d");
        /**
         * TIME_FORMAT constant
         * Note: Date format
         */
        define("TIME_FORMAT", "H:i:s");
    }
    /**
     * setConfigIniSet function
     * @uses ini_set(), Function
     * Note: I set Global variables. If allowed to use ini_set ()
     */
    public function setConfigIniSet()
    {
        /**
         * @uses error_repoting, mixed Parameters
         * Note: Error setting - E_ALL shows all the errors ^ E_NOTICE minus the news (optional)
         */
        ini_set("error_repoting", E_ALL ^ E_NOTICE);
        /**
         * @uses max_execution_time, mixed, Parameters
         * Note: Maximum execution time of a script.
         */
        ini_set("max_execution_time", 60 * 10);
        /**
         * @uses max_input_time, mixed, Parameters
         * Note: Maximum time in inputs.
         */
        ini_set("max_input_time", "600");
        /**
         * @uses log_errors, mixed, Parameters
         * Note: 0 disables the error reporting file
         */
        #ini_set("log_errors", 1);
        /**
         * @uses error_log, mixed, Parameters
         * Note: path to the file where you save the errors // respect the \\ (backslashes)
         */
        #ini_set("error_log", "\\errorlog\\error.txt");
        /**
         * @uses post_max_size, mixed, Parameters
         * Note: Defines the maximum weight that will be accepted by POST.
         */
        ini_set("post_max_size", "100M");
        /**
         * @uses upload_max_filesize, mixed, Parameters
         * Note: Define the weight that will be accepted for uploads.
         */
        ini_set("upload_max_filesize", "100M");
        /**
         * @uses memory_limit, mixed, Parameters
         * Note: Defines the available memory space on the server.
         */
        ini_set("memory_limit", "-1");
        /**
         * @uses display_errors, mixed, Parameters
         * Note: Determines if it shows errors on screen or not, at 0 it does not show errors
         */
        #ini_set("display_errors", 0);
        /**
         * @uses display_startup_errors, mixed, Parameters
         * Note: It determines if it shows errors when starting PHP or not, in 0 it does not show the errors
         */
        #ini_set("display_startup_errors", 0);
        /**
         * @uses log_errors_max_len, mixed, Parameters
         * Note: Determines the weight of the error log in 0 does not have maximum file weight errors.txt
         */
        #ini_set("log_errors_max_len", 0);
        /**
         * @uses ignore_repeated_errors, mixed, Parameters
         * Note: in 1 does not show repeated errors only one
         */
        #ini_set("ignore_repeated_errors", 0);
        /**
         * @uses track_errors, mixed, Parameters
         * Note: in 1 active error track
         */
        #ini_set("track_errors", 1);
    }
    /**
     * setConfigConstants function
     * @uses define(), Function
     * Note: Constant setting for all the Framework, URLs, paths, date, hours, encrypt, Database, mail etc.
     */
    public function setConfigConstants()
    {
        /**
         * CONFIG_NAME_SITE constant
         * Note: Display name of the Framework
         */
        define("CONFIG_NAME_SITE", "Agencia La Gráfica");
        /**
         * CONFIG_HOST constant
         * Note: Actual site HOST
         */
        define('CONFIG_HOST', $_SERVER['HTTP_HOST']);
        /**
         * CONFIG_SITE_HOST constant
         * Note: URL domain HTTP_HOST
         */
        if (isset($_SERVER['HTTPS'])) {
            define('CONFIG_SITE_HOST', "https://" . $_SERVER['HTTP_HOST'] . "/");
        } else {
            define('CONFIG_SITE_HOST', "http://" . $_SERVER['HTTP_HOST'] . "/");
        }
        /**
         * CONFIG_SITE_HOST constant
         * Note: URL full of site HTTP_HOST + PHP_SELF
         */
        if (isset($_SERVER['HTTPS'])) {
            define('CONFIG_REAL_URL', "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "");
        } else {
            define('CONFIG_REAL_URL', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "");
        }
        /**
         * CONFIG_EN_DESARROLLO constant
         * Note: Determines if you are in development environments or not STAGING / PRODUCTION
         */
        define('CONFIG_EN_DESARROLLO', ($_SERVER['HTTP_HOST'] == 'localhost' ? true : false));
        /**
         * CONFIG_EN_TESTING constant
         * Note: Determine if you are in a STAGING development environment
         */
        define('CONFIG_EN_TESTING', ($_SERVER['HTTP_HOST'] == 'developersba.com' ? true : false));
        /**
         * CONFIG_PREFIX_NAME_CONSTANTS constant
         * Note: Prefix name for constants / project variables
         */
        define("CONFIG_PREFIX_NAME_CONSTANTS", "AGENCIALAGRAFICA");
        /**
         * CONFIG_SESION_NAME_BACKEND constant
         * Note: Name of SESSION Back-end
         */
        define("CONFIG_SESION_NAME_BACK", CONFIG_PREFIX_NAME_CONSTANTS . "Back");
        /**
         * CONFIG_SESION_NAME_FRONT constant
         * Note: Name of SESSION fornt-end
         */
        define("CONFIG_SESION_NAME_FRONT", CONFIG_PREFIX_NAME_CONSTANTS . "Front");
        /**
         * CONFIG_SESION_NAME_ADMIN constant
         * Note: Nombre de SESSION
         */
        define("CONFIG_SESION_NAME_ADMIN", CONFIG_PREFIX_NAME_CONSTANTS . "Admin");
        /**
         * CONFIG_SESION_NAME_ADMINISTRADOR constant
         * Note: Name of SESSION Administrator panel
         */
        define("CONFIG_SESION_NAME_ADMINISTRADOR", CONFIG_PREFIX_NAME_CONSTANTS . "Administrador");
        /**
         * CONFIG_SESION_FLAG constant
         * Note: key x 20 characters
         */
        define("CONFIG_SESION_FLAG", "Qbk5955zRDb4Gatushzc");
        /**
         * CONFIG_SESION_NAME_BACK constant
         * Note: key x 100 characters
         */
        define("CONFIG_SESION_KEY_BACK", "qSo3G8kKyPTHCfRQmteo1BXkfLBkBvpWiBeeG4VpjxpEfzij769AOQNqd8XknzycIUE5jbhhDAHteHLnN3szCXfVUDKL6EFOpYD9");
        /**
         * CONFIG_SESION_NAME constant
         * Note: key Back-end x 100 characters
         */
        define("CONFIG_SESION_KEY_FRONT", "sKxUtoVInyvHHKRys7MB1jwum8i2sZbAL9jiNBDDBGz3NAKFhr7pXQUvuGxCqfTeXfxCXeGrpM9AYyCz4egSNe3IOgIsKqM15lTM");
        /**
         * CONFIG_SESION_NAME constant
         * Note: key Admin x 100 characters
         */
        define("CONFIG_SESION_KEY_ADMIN", "dVBL10PBrAJY5KxOAZBIoM4wD0hMYtC4RyaXsBTe455EWAXfqWhMa3Nmnfc9z5tgb0mfl57rNfl4N9zVTUT90hI0yRX8Srpgy7Wq");
        /**
         * CONFIG_SESION_NAME constant
         * Note: key Administrator x 100 characters
         */
        define("CONFIG_SESION_KEY_ADMINISTRADOR", "roNOG8bM8eXYauMrDLPnMnPXw0lZpPIZtNTJvSiMRRyeL7gCS0lxE7wgHvy3ZtmpP27eVOKSbq485GvkswHJzEBZMT2xUnp5JFc6");
        /**
         * CONFIG_DATE constant
         * Note: System date
         */
        define("CONFIG_DATE", date('F j, Y, H:i:s a'));
        /**
         * CONFIG_DATE_FRONT constant
         * Note: System date
         */
        define("CONFIG_DATE_FRONT", date(DATETIME_FORMAT));
        /**
         * CONFIG_REFERER constant
         * Note: Determine if we have HTTP_REFERER
         */
        define('CONFIG_REFERER', (isset($_SERVER['HTTP_REFERER']) ? true : false));
        /**
         * FOLDER_CONTROLLER constant
         * Note: Controllers folder
         */
        define("FOLDER_CONTROLLER", '_controller/');
        /**
         * FOLDER_MODEL constant
         * Note: Models folder
         */
        define('FOLDER_MODEL', '_model/');
        /**
         * FOLDER_VIEW, constant
         * Note: Views Folder
         */
        define('FOLDER_VIEW', '_view/');
        /**
         * FOLDER_LIB, constant
         * Note: Class library folder
         */
        define('FOLDER_LIB', '_lib/');
        /**
         * FOLDER_THEME, constant
         * Note: Templates folder
         */
        define('FOLDER_THEME', 'themes/skin/');
        /**
         * TEMPLATE_SKIN_FRONT, constant
         * Note: Skin folder and Front tpls
         */
        define('TEMPLATE_SKIN_FRONT', 'lagrafica');
        /**
         * TEMPLATE_SKIN_FRONT_ENTERPRISE, constant
         * Note: Skin folder and Front tpls enterprise
         */
        define('TEMPLATE_SKIN_FRONT_ENTERPRISE', 'lagrafica');
        /**
         * TEMPLATE_SKIN_BACKEND, constant
         * Note: Skin folder and Front tpls Backend
         */
        define('TEMPLATE_SKIN_BACKEND', 'lagrafica');
        /**
         * TEMPLATE_NAME_TITLE, constant
         * Note: HTML title
         */
        define('TEMPLATE_NAME_TITLE', CONFIG_NAME_SITE);
        /**
         * FILES_NAMES_SECURE, constant
         * Note: Upload of files. This variable indicates whether it is used in the file's ratural name or changed to a secure one.
         */
        define('FILES_NAMES_SECURE', true);
        /**
         * FILES_QUALITY, constant
         * Note: Indicates for the images that support compression what is the compression to apply to copies and new formats
         */
        define('FILES_QUALITY', 100);
        /**
         * CRYPT_VAR, constant
         * Note: It is the key that will be used in Crypt class x 250 characters
         */
        define('CRYPT_VAR', '4lG4jcNunllTf3FqYKry7TtmzM5hd1r633t6UkCLP31EELKmWRnzDlXoiP3oG0Oxg7voVVSgMgJVFrWUkaQzXXGdvXeKRbnzSGsv5rhDL07ZaiHim40KlUGGZnRo41eohLS4r00BHCAbdmkbWK2oUJ3zeIVAUd4MZfTwW8CgTvj1XuK8CvkT8O6xLq9j4bI0JOue8U72oMISAvt9ZVzc1qsRPQ45xyO4vIdFqVK0dbcU6GjvNcFR7G5aeD');
        /**
         * CRYPT_VAR_TXT, constant
         * Note: Setting of string to be encrypted to be used on different sides as forms x 2500 characters
         */
        define('CRYPT_VAR_TXT', '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');
        /**
         * CRYPT_VAR_USERS, constant
         * Note: It is the key that will be used in Crypt class of users x 2500 characters
         */
        define('CRYPT_VAR_USERS', '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');
        /**
         * CRYPT_VAR_WEB_SERVICE, constant
         * Note: It is the key that will be used to consume Sensitive data from web services x25 characters
         */
        define('CRYPT_VAR_WEB_SERVICE', '7jKyJMkX2TFyS030IdN_D=)o9');
        /**
         * CRYPT_VAR_WEB_SERVICE_KEY, constant
         * Note: It is the key that will be used to consume Administrators sensitive data from WS x50 characters
         */
        define('CRYPT_VAR_WEB_SERVICE_KEY', 'A47LgxO9JBnQfTmXiNMQFk08RMhw5FTtESHylfQTqQFienn94c');
        /**
         * COOKIE_ID, constant
         * Note: It is the id for COOKIE x30
         */
        define('COOKIE_ID', '606852494347647068527436793853');
        /**
         * COOKIE_CRYPT_VAR, constant
         * Note: It is the key that will be used in Crypt class COOKIE x 2500 characters
         */
        define('COOKIE_CRYPT_VAR', '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');
        /**
         * COOKIE_EXPIRE, constant
         * Note: Indicates whether the cookie expires or not
         */
        define('COOKIE_EXPIRE', false);
        /**
         * COOKIE_PATH, constant
         * Note: Path of cookie
         */
        define('COOKIE_PATH', '/');
        /**
         * COOKIE_NAME, constant
         * Note: It is the Name for COOKIE
         */
        define('COOKIE_NAME', 'DEVELOPERSBA');
        /**
         * COOKIE_SECURE, constant
         * Note: Indicates if the Cookie is SECURE
         */
        define('COOKIE_SECURE', false);
        /**
         * API_KEY, constant
         * Note: It is the key that will be used to consume Sensitive data from API x25 characters
         */
        define('API_KEY', 'Bm9DclOizZ8KYNeAuWKOgpctc');
        /**
         * DATABASE_SCAFFOLDING, constant, 
         * Note: It is the flag that indicates that the structure must be treated taking into account the COMMENTS of the rows of the tables
         */
        define('DATABASE_SCAFFOLDING', true);
        /**
         * PURGE_STRUCTURE_DATABASE, constant, 
         * Note: It is the flag that indicates that you have to purge the physical structure of the Database (_lib/database/structure/data.inc).
         */
        define('PURGE_STRUCTURE_DATABASE', true);
    }
    /**
     * setRelateConstants function
     * @uses CONFIG_EN_DESARROLLO, CONFIG_EN_TESTING, Constant
     * @uses define(), Function
     * Note: Setting of URLs, paths, Database, email etc. ACCORDING TO THREE ENVIRONMENTS: LOCAL / STAGING / PRODUCTION
     */
    public function setRelateConstants()
    {
        /**
         * Note: Compare if it is on own or end servers
         */
        if (CONFIG_EN_DESARROLLO) { // STAGING / INTERNAL development environment (local)
            // die("LOCAL missing configuration");
            /**
             * CONFIG_ADD_PATH constant
             * Note: Additional path of the root to the framework
             */
            define('CONFIG_ADD_PATH', 'proyectos/lagrafica.com/lagrafica/www/');
            /**
             * CONFIG_ADD_PATH constant
             * Note: Path of framework
             */
            define('CONFIG_ADD_PATH_BACK', 'framework/');
            /**
             * CONFIG_HOST_NAME_FRONTEND constant
             * Note: If have REQUEST slug chage the CONFIG_HOST_NAME_FRONTEND
             */
            define('CONFIG_HOST_NAME_FRONTEND', CONFIG_SITE_HOST . CONFIG_ADD_PATH);
            /**
             * CONFIG_HOST_NAME_BACKEND constant
             * Note: Url Back End
             */
            define('CONFIG_HOST_NAME_BACKEND', CONFIG_SITE_HOST . CONFIG_ADD_PATH . CONFIG_ADD_PATH_BACK);
            /**
             * CONFIG_URL_FRIENDLY constant
             * Note: Implement URL friendly
             */
            define('CONFIG_URL_FRIENDLY', true);
            /**
             * CONFIG_FRONT_PATH constant
             * Note: Fron path if you have it
             */
            define('CONFIG_FRONT_PATH', '');
            /**
             * CONFIG_DATABASE_VERSION constant
             * Note: Determine if you use MySQL (deprecate) or MySQLi
             */
            define('CONFIG_DATABASE_VERSION', 'Mysqli');
            /**
             * CONFIG_DB_PREFIX constant
             * Note: Prefix of the database
             */
            define('CONFIG_DB_PREFIX', 'lg_');
            /**
             * CONFIG_DB_HOST constant
             * Note: Host of the connection to the Database
             */
            define('CONFIG_DB_HOST', 'localhost');
            /**
             * CONFIG_DB_NAME constant
             * Note: Name of the Database
             */
            define('CONFIG_DB_NAME', 'lagrafica');
            /**
             * CONFIG_DB_USER constant
             * Note: User of the Database
             */
            define('CONFIG_DB_USER', 'root');
            /**
             * CONFIG_DB_PASS constant
             * Note: Password of the Database
             */
            define('CONFIG_DB_PASS', 'Fer_2468');
            /**
             * CONFIG_DB_PORT constant
             * Note: Port of the Database
             */
            define('CONFIG_DB_PORT', '3306');
            /**
             * CONFIG_TRIGGER constant
             * Note: Generates the injection log to the database, XML format
             */
            define('CONFIG_TRIGGER', false);
            /**
             * CONFIG_TRIGGER_PURGE constant
             * Note:Indicates whether to reset the injection log or add content
             */
            define('CONFIG_TRIGGER_PUGE', false);
            /**
             * CONFIG_TRIGGER_VARS constant
             * Note: Indicates whether the variables contained in $ _GET, $ _POST, $ _SESSION, $ _COOKIES are included
             * Note: WARNING!! TRUE is only for DEBUG does not allow INSERT
             */
            define('CONFIG_TRIGGER_VARS', false);
            /**
             * CONFIG_URL_WEBSERVICES constant
             * Note: Path for services
             */
            define('CONFIG_URL_WEBSERVICES', CONFIG_HOST_NAME_FRONTEND . 'api/webservices.php');
            /**
             * CONFIG_SENDER_EMAIL constant
             * Note: Determines if SMTP is going to be implemented for the sending of emails. (SMTP, SMTP_GMAIL, mail)
             */
            define('CONFIG_SENDER_EMAIL', 'SMTP');
            /**
             * PATH_MAIL_HTML constant
             * Note: Folder of the webmail
             */
            define('PATH_MAIL_HTML', '');
            /**
             * SMTP_DEBUG constant
             * Note: Allow debug mode to see messages of things that are happening
             */
            define('SMTP_DEBUG', false);
            /**
             * SMTP_AUTHENTICATION constant
             * Note: If SMTP uses authentication
             */
            define('SMTP_AUTHENTICATION', true);
            /**
             * SMTP_SECURE constant
             * Note: 
             */
            define('SMTP_SECURE', 'tls');
            /**
             * SMTP_SERVER constant
             * Note: Host Server
             */
            define('SMTP_SERVER', '');
            /**
             * SMTP_PORT constant
             * Note: Port SMTP
             */
            define('SMTP_PORT', 25);
            /**
             * SMTP_USER constant
             * Note: User SMTP
             */
            define('SMTP_USER', 'no-reply@');
            /**
             * SMTP_PASS constant
             * Note: Password SMTP
             */
            define('SMTP_PASS', '');
            /**
             * SMTP_WORD_WRAP constant
             * Note: Number o Word Wrap
             */
            define('SMTP_WORD_WRAP', 50);
            /**
             * FROM_EMAIL constant
             * Note: Email SMTP
             */
            define('FROM_EMAIL', 'no-reply@');
            /**
             * FROM_NAME constant
             * Note: Name of user
             */
            define('FROM_NAME', 'No Reply - ' . CONFIG_NAME_SITE);
            /**
             * header function
             * Note: Activate to force the use of UTF8.
             */
            header('Content-Type: text/html; charset=utf-8');
        } else if (CONFIG_EN_TESTING) { // STAGING / EXTERNAL client testing environment
            die("STAGING / EXTERNAL missing configuration");
            /**
             * CONFIG_ADD_PATH constant
             * Note: Additional path of the root to the framework
             */
            define('CONFIG_ADD_PATH', '/');
            /**
             * CONFIG_ADD_PATH constant
             * Note: Path of framework
             */
            define('CONFIG_ADD_PATH_BACK', 'framework/');
            /**
             * CONFIG_HOST_NAME_FRONTEND constant
             * Note: If have REQUEST slug chage the CONFIG_HOST_NAME_FRONTEND
             */
            define('CONFIG_HOST_NAME_FRONTEND', CONFIG_SITE_HOST . CONFIG_ADD_PATH);
            /**
             * CONFIG_HOST_NAME_BACKEND constant
             * Note: Url Back End
             */
            define('CONFIG_HOST_NAME_BACKEND', CONFIG_SITE_HOST . CONFIG_ADD_PATH . CONFIG_ADD_PATH_BACK);
            /**
             * CONFIG_URL_FRIENDLY constant
             * Note: Implement URL friendly
             */
            define('CONFIG_URL_FRIENDLY', true);
            /**
             * CONFIG_FRONT_PATH constant
             * Note: Fron path if you have it
             */
            define('CONFIG_FRONT_PATH', '');
            /**
             * CONFIG_DATABASE_VERSION constant
             * Note: Determine if you use MySQL (deprecate) or MySQLi
             */
            define('CONFIG_DATABASE_VERSION', 'Mysqli');
            /**
             * CONFIG_DB_PREFIX constant
             * Note: Prefix of the database
             */
            define('CONFIG_DB_PREFIX', 'lg_');
            /**
             * CONFIG_DB_HOST constant
             * Note: Host of the connection to the Database
             */
            define('CONFIG_DB_HOST', 'localhost');
            /**
             * CONFIG_DB_NAME constant
             * Note: Name of the Database
             */
            define('CONFIG_DB_NAME', 'lagrafica');
            /**
             * CONFIG_DB_USER constant
             * Note: User of the Database
             */
            define('CONFIG_DB_USER', '');
            /**
             * CONFIG_DB_PASS constant
             * Note: Password of the Database
             */
            define('CONFIG_DB_PASS', '');
            /**
             * CONFIG_DB_PORT constant
             * Note: Port of the Database
             */
            define('CONFIG_DB_PORT', '3306');
            /**
             * CONFIG_TRIGGER constant
             * Note: Generates the injection log to the database, XML format
             */
            define('CONFIG_TRIGGER', false);
            /**
             * CONFIG_TRIGGER_PURGE constant
             * Note:Indicates whether to reset the injection log or add content
             */
            define('CONFIG_TRIGGER_PUGE', false);
            /**
             * CONFIG_TRIGGER_VARS constant
             * Note: Indicates whether the variables contained in $ _GET, $ _POST, $ _SESSION, $ _COOKIES are included
             * Note: WARNING!! TRUE is only for DEBUG does not allow INSERT
             */
            define('CONFIG_TRIGGER_VARS', false);
            /**
             * CONFIG_URL_WEBSERVICES constant
             * Note: Path for services
             */
            define('CONFIG_URL_WEBSERVICES', CONFIG_HOST_NAME_FRONTEND . 'api/webservices.php');
            /**
             * CONFIG_SENDER_EMAIL constant
             * Note: Determines if SMTP is going to be implemented for the sending of emails. (SMTP, SMTP_GMAIL, mail)
             */
            define('CONFIG_SENDER_EMAIL', 'SMTP');
            /**
             * PATH_MAIL_HTML constant
             * Note: Folder of the webmail
             */
            define("PATH_MAIL_HTML", '/');
            /**
             * SMTP_DEBUG constant
             * Note: Allow debug mode to see messages of things that are happening
             */
            define("SMTP_DEBUG", 0);
            /**
             * SMTP_AUTHENTICATION constant
             * Note: If SMTP uses authentication
             */
            define("SMTP_AUTHENTICATION", true);
            /**
             * SMTP_SECURE constant
             * Note: 
             */
            define("SMTP_SECURE", 'ssl');
            /**
             * SMTP_SERVER constant
             * Note: Host Server
             */
            define("SMTP_SERVER", '');
            /**
             * SMTP_PORT constant
             * Note: Port SMTP
             */
            define("SMTP_PORT", 465);
            /**
             * SMTP_USER constant
             * Note: User SMTP
             */
            define("SMTP_USER", 'noreply@');
            /**
             * SMTP_PASS constant
             * Note: Password SMTP
             */
            define("SMTP_PASS", '');
            /**
             * SMTP_WORD_WRAP constant
             * Note: Number o Word Wrap
             */
            define("SMTP_WORD_WRAP", 50);
            /**
             * FROM_EMAIL constant
             * Note: Email SMTP
             */
            define("FROM_EMAIL", 'noreply@');
            /**
             * FROM_NAME constant
             * Note: Name of user
             */
            define("FROM_NAME", 'No Reply - ' . CONFIG_NAME_SITE);
            /**
             * header function
             * Note: Activate to force the use of UTF8.
             */
            header('Content-Type: text/html; charset=utf-8');
        } else { // PRODUCION / ONLINE Entorno final
            // die('Missing production constants');
            /**
             * CONFIG_ADD_PATH constant
             * Note: Additional path of the root to the framework
             */
            define('CONFIG_ADD_PATH', '');
            /**
             * CONFIG_ADD_PATH constant
             * Note: Path of framework
             */
            define('CONFIG_ADD_PATH_BACK', 'framework/');
            /**
             * CONFIG_HOST_NAME_FRONTEND constant
             * Note: If have REQUEST slug chage the CONFIG_HOST_NAME_FRONTEND
             */
            define('CONFIG_HOST_NAME_FRONTEND', CONFIG_SITE_HOST . CONFIG_ADD_PATH);
            /**
             * CONFIG_HOST_NAME_BACKEND constant
             * Note: Url Back End
             */
            define('CONFIG_HOST_NAME_BACKEND', CONFIG_SITE_HOST . CONFIG_ADD_PATH . CONFIG_ADD_PATH_BACK);
            /**
             * CONFIG_URL_FRIENDLY constant
             * Note: Implement URL friendly
             */
            define('CONFIG_URL_FRIENDLY', true);
            /**
             * CONFIG_FRONT_PATH constant
             * Note: Fron path if you have it
             */
            define('CONFIG_FRONT_PATH', '');
            /**
             * CONFIG_DATABASE_VERSION constant
             * Note: Determine if you use MySQL (deprecate) or MySQLi
             */
            define('CONFIG_DATABASE_VERSION', 'Mysqli');
            /**
             * CONFIG_DB_PREFIX constant
             * Note: Prefix of the database
             */
            define('CONFIG_DB_PREFIX', 'lg_');
            /**
             * CONFIG_DB_HOST constant
             * Note: Host of the connection to the Database
             */
            define('CONFIG_DB_HOST', 'localhost');
            /**
             * CONFIG_DB_NAME constant
             * Note: Name of the Database
             */
            define('CONFIG_DB_NAME', 'lagrafica');
            /**
             * CONFIG_DB_USER constant
             * Note: User of the Database
             */
            define('CONFIG_DB_USER', 'lagrafica');
            /**
             * CONFIG_DB_PASS constant
             * Note: Password of the Database
             */
            define('CONFIG_DB_PASS', 'yAkOE53rycOg');
            /**
             * CONFIG_DB_PORT constant
             * Note: Port of the Database
             */
            define('CONFIG_DB_PORT', '3306');
            /**
             * CONFIG_TRIGGER constant
             * Note: Generates the injection log to the database, XML format
             */
            define('CONFIG_TRIGGER', false);
            /**
             * CONFIG_TRIGGER_PURGE constant
             * Note:Indicates whether to reset the injection log or add content
             */
            define('CONFIG_TRIGGER_PUGE', false);
            /**
             * CONFIG_TRIGGER_VARS constant
             * Note: Indicates whether the variables contained in $ _GET, $ _POST, $ _SESSION, $ _COOKIES are included
             * Note: WARNING!! TRUE is only for DEBUG does not allow INSERT
             */
            define('CONFIG_TRIGGER_VARS', false);
            /**
             * CONFIG_URL_WEBSERVICES constant
             * Note: Path for services
             */
            define('CONFIG_URL_WEBSERVICES', CONFIG_HOST_NAME_FRONTEND . 'api/webservices.php');
            /**
             * CONFIG_SENDER_EMAIL constant
             * Note: Determines if SMTP is going to be implemented for the sending of emails. (SMTP, SMTP_GMAIL, mail)
             */
            define('CONFIG_SENDER_EMAIL', 'SMTP');
            /**
             * PATH_MAIL_HTML constant
             * Note: Folder of the webmail
             */
            define("PATH_MAIL_HTML", '/');
            /**
             * SMTP_DEBUG constant
             * Note: Allow debug mode to see messages of things that are happening
             */
            define("SMTP_DEBUG", 0);
            /**
             * SMTP_AUTHENTICATION constant
             * Note: If SMTP uses authentication
             */
            define("SMTP_AUTHENTICATION", true);
            /**
             * SMTP_SECURE constant
             * Note: 
             */
            define("SMTP_SECURE", 'ssl');
            /**
             * SMTP_SERVER constant
             * Note: Host Server
             */
            define("SMTP_SERVER", 'a2plcpnl0114.prod.iad2.secureserver.net');
            /**
             * SMTP_PORT constant
             * Note: Port SMTP
             */
            define("SMTP_PORT", 465);
            /**
             * SMTP_USER constant
             * Note: User SMTP
             */
            define("SMTP_USER", 'respondemos@agencialagrafica.com');
            /**
             * SMTP_PASS constant
             * Note: Password SMTP
             */
            define("SMTP_PASS", 'E&[A2npeqgaS');
            /**
             * SMTP_WORD_WRAP constant
             * Note: Number o Word Wrap
             */
            define("SMTP_WORD_WRAP", 50);
            /**
             * FROM_EMAIL constant
             * Note: Email SMTP
             */
            define("FROM_EMAIL", 'respondemos@agencialagrafica.com');
            /**
             * FROM_NAME constant
             * Note: Name of user
             */
            define("FROM_NAME", 'Contacto - Agencia La Gráfica');
            /**
             * header function
             * Note: Activate to force the use of UTF8.
             */
            header('Content-Type: text/html; charset=utf-8');
        }
    }
    /**
     * getExtensionsAvailable function
     * @uses , Function
     * Note: List of supported file extensions to upload and download into the system
     */
    public function getExtensionsAvailable()
    {
        $extensions = array(".ico", ".mp4", ".webm", ".flv", ".f4v", ".avi", ".mov", ".mpeg", ".mpeg4", ".mkv", ".m4v", ".jpg", ".jpeg", ".gif", ".png", ".svg", ".txt", ".pdf", ".doc", ".ppt", ".xls", ".xlsx", ".csv", ".pptx", ".docx", ".zip", ".rar", ".sql", ".html");
        return $extensions;
    }
    /**
     * setExeptionsControllers function
     * @uses , Function
     * Note: Setting Exceptions for controllers. If you add the name of a controller you will have to generate a custom VIEWER AND MODEL CONTROLLER from the TPL_Controller.php, TPL_Model.php, TPL_View.php
     */
    public function setExceptions()
    {
        $exceptions = array('settingsController', 'startController', 'loginController', 'sectionsController', 'tasksController', 'importsController', 'waitingController');
        return $exceptions;
    }
    /**
     * setRestrictControllers function
     * @uses , Function
     * Note: I set restrictions on access to controllers, restriction for webservices
     */
    public function setRestrictControllers()
    {
        $exceptions = array('administratorsController', 'administrators_permissionsController', 'administrators_permissions_relationsController', 'startController', 'loginController', 'usersController');
        return $exceptions;
    }
    /**
     * setExeptionsControllersApi function
     * @uses , Function
     * Note: Setting Exceptions for controllers. If you add the name of a controller you will have to generate a custom VIEWER AND MODEL CONTROLLER from the TPL_Controller.php, TPL_Model.php, TPL_View.php
     */
    public function setExceptionsApi()
    {
        $exceptions = array('startController', 'loginController');
        return $exceptions;
    }
    /**
     * setRestrictControllersApi function
     * @uses , Function
     * Note: I set restrictions on access to controllers, restriction for webservices
     */
    public function setRestrictControllersApi()
    {
        $exceptions = array('administratorsController', 'administrators_permissionsController', 'administrators_permissions_relationsController', 'startController', 'loginController');
        return $exceptions;
    }
}
