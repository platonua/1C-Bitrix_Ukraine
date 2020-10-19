<?
global $MESS; 
$PathInstall = str_replace('\\', '/', __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen('/index.php'));
IncludeModuleLangFile($PathInstall.'/install.php');
include($PathInstall.'/version.php');

if(class_exists('platon_paysystem')) return;

class platon_paysystem extends CModule
{ 
    var $MODULE_ID = "platon.paysystem";
    public $MODULE_VERSION; 
    public $MODULE_VERSION_DATE; 
    public $MODULE_NAME; 
    public $MODULE_DESCRIPTION; 
    public $PARTNER_NAME; 
    public $PARTNER_URI; 
    public $MODULE_GROUP_RIGHTS = 'N';
    public $NEED_MAIN_VERSION = '16.5.4';
    public $NEED_MODULES = array('sale');

    public function __construct()
    { 
        $arModuleVersion = array(); 

        $path = str_replace('\\', '/', __FILE__); 
        $path = substr($path, 0, strlen($path) - strlen('/index.php')); 
        include($path.'/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        { 
            $this->MODULE_VERSION = $arModuleVersion['VERSION']; 
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE']; 
        } 

        $this->PARTNER_NAME = GetMessage("PLATON_PAYSYSTEM_PARTNER_NAME");
        $this->PARTNER_URI = 'http://platon.com.ua/';

        $this->MODULE_NAME = GetMessage('PLATON_PAYSYSTEM_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('PLATON_PAYSYSTEM_MODULE_DESCRIPTION');
    } 
	
	function InstallDB(){
		global $APPLICATION, $DB, $errors;
		RegisterModule($this->MODULE_ID);
        $res = $DB->Query('CREATE TABLE IF NOT EXISTS `platon_recurring_payments_code` (
  `Id` int(11) NOT NULL auto_increment,
  `user` char(32) NOT NULL,
  `card` char(4) NOT NULL,
  `rc_id` varchar(32) NOT NULL,
  `rc_token` char(32) NOT NULL,
  PRIMARY KEY  (`Id`)
)',true);
		return true;
	}

	function UnInstallDB(){
		global $APPLICATION, $DB, $errors;
		COption::RemoveOption($this->MODULE_ID);
		UnRegisterModule($this->MODULE_ID);
		return true;
	}

	function InstallEvents(){
		return true;
	}

	function UnInstallEvents(){
		return true;
	}
	
	function InstallFiles(){
		$rez = CopyDirFiles(
			$_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/'.$this->MODULE_ID.'/install/sale_payment', 
			$_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/include/sale_payment', true, true
		); 
		return true;
	}
	
	function UnInstallFiles(){
		DeleteDirFilesEx('/bitrix/php_interface/include/sale_payment/platon_paysystem/');
		return true;
	}
	
    public function DoInstall()
    { 
        if (is_array($this->NEED_MODULES) && !empty($this->NEED_MODULES))
            foreach ($this->NEED_MODULES as $module)
                if (!IsModuleInstalled($module)) 
                    $this->ShowForm('ERROR', GetMessage('PLATON_PAYSYSTEM_NEED_MODULES', array('#MODULE#' => $module)));

        if (strlen($this->NEED_MAIN_VERSION)<=0 || version_compare(SM_VERSION, $this->NEED_MAIN_VERSION)>=0)
        { 
            
			$this->InstallDB();
			$this->InstallFiles();
			$this->InstallEvents();
				
            $this->ShowForm('OK', GetMessage('MOD_INST_OK'));
        } 
        else 
            $this->ShowForm('ERROR', GetMessage('STDNK_EASYPAY_NEED_RIGHT_VER', array('#NEED#' => $this->NEED_MAIN_VERSION))); 
    } 

    public function DoUninstall() 
    { 
		$this->UnInstallDB();
		$this->UnInstallEvents();
		$this->UnInstallFiles();
		
        
        $this->ShowForm('OK', GetMessage('MOD_UNINST_OK')); 
    } 

    private function ShowForm($type, $message, $buttonName='')
    {
        $keys = array_keys($GLOBALS);
        for($i=0; $i<count($keys); $i++)
            if($keys[$i]!='i' && $keys[$i]!='GLOBALS' && $keys[$i]!='strTitle' && $keys[$i]!='filepath') 
                global ${$keys[$i]}; 

        $PathInstall = str_replace('\\', '/', __FILE__); 
        $PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen('/index.php')); 
        IncludeModuleLangFile($PathInstall.'/install.php'); 

        $APPLICATION->SetTitle(GetMessage('PLATON_PAYSYSTEM_MODULE_NAME'));
        include($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php');
        echo CAdminMessage::ShowMessage(array('MESSAGE' => $message, 'TYPE' => $type)); 
        ?> 
        <form action="<?= $APPLICATION->GetCurPage()?>" method="get"> 
        <p> 
            <input type="hidden" name="lang" value="<?= LANG?>" /> 
            <input type="submit" value="<?= strlen($buttonName) ? $buttonName : GetMessage('MOD_BACK')?>" /> 
        </p> 
        </form> 
        <? 
        include($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php');
        die(); 
    } 
} 
?>