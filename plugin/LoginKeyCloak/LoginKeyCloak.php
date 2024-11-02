<?php

require_once $global['systemRootPath'] . 'plugin/Plugin.abstract.php';

class LoginKeycloak extends PluginAbstract {

    public function getTags() {
        return array(
            PluginTags::$FREE,
            PluginTags::$LOGIN,
        );
    }
    public function getDescription() {
        global $global;
        $obj = $this->getLogin();
        $name = $obj->type;
        $str = "Login with {$name} OAuth Integration";
        $str .= "<br><a href='{$obj->linkToDevelopersPage}'>Get {$name} ID and Key</a>"
        . "<br>Valid OAuth redirect URIs: <strong>{$global['webSiteRootURL']}objects/login.json.php?type=$name</strong>"
        . "<br>For mobile a Valid OAuth redirect URIs: <strong>{$global['webSiteRootURL']}plugin/MobileManager/oauth2.php?type=$name</strong>";
        return $str;
    }

    public function getName() {
        return "LoginKeycloak";
    }

    public function getUUID() {
        return "b11c9be1-b619-4ef5-be1b-a1cd9ef265b7";
    }

    public function getPluginVersion() {
        return "1.0";   
    }    
        
    public function getEmptyDataObject() {
        global $global;
        $obj = new stdClass();
                
        $obj->url = "";
        $obj->realm = "";
        $obj->id = "";
        $obj->key = "";
        return $obj;
    }
    
    public function getLogin() {
        $obj = new stdClass();
        $obj->class = "btn btn-danger btn-block"; 
        $obj->icon = "fab fa-openid"; 
        $obj->type = "Keycloak";
        $obj->linkToDevelopersPage = "https://sso.codecubers.com";         
        return $obj;
    }
    
}
