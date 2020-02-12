<?php
session_start();
require_once 'Dboperation.php';
// session_destroy();
class Registration {

    private $conn,$userId = 0;
    // global $data;
    
    function __construct() {
        $this->conn = new DbConnect;
    }

        // function getValue($sectionName, $fieldName, $returnType = "") {
        //     return isset($this->data[$sectionName][$fieldName]) ? $this->data[$sectionName][$fieldName] : $this->getSessionvalue($sectionName, $fieldName, $returnType);
        // }
        
        function getValue($sectionName, $fieldName, $returnType = "") {
            return isset($this->data[$sectionName][$fieldName]) ? $this->data[$sectionName][$fieldName] : $returnType;
        }

    
    function getSessionvalue($sectionName, $fieldName, $returnType) {
        return isset($_SESSION[$sectionName][$fieldName]) ? $_SESSION[$sectionName][$fieldName] : $returnType;
    }

    function setSessionValue($sectionName) {
        return isset($_POST[$sectionName]) ? $_SESSION[$sectionName] = $_POST[$sectionName] : "";   
    }


    function setQueryValues($section, $custId = 0 ){
        if($section == "account"){
            return $this->setData($section, $_POST[$section], $custId);          
        } else if ($section == "address") {
            return $this->setData($section, $_POST[$section], $custId);
        } else if ($section == "otherInfo") {
            return $this->setData($section, $_POST[$section], $custId);
        }
    }

    function updateQueryValues($section, $custId ){
        if($section == "account"){
            return $this->updateData($section, $_POST[$section], $custId);          
        } else if ($section == "address") {
            return $this->updateData($section, $_POST[$section], $custId);
        } else if ($section == "otherInfo") {
            return $this->updateData($section, $_POST[$section], $custId);
        }
    }

    function updateData($section,$data, $custId) {
        switch ($section) {
            case "account" :
                $account = $this->converterAccount($data);
                $tableName = "customers";   
                $field = "customerId";
                return $this->conn->update($account, $tableName, $field, $custId);
                break;

            case "address" : 
                $address = $this->converterAddress($data, $custId);
                $tableName = "customer_address";
                $field = "customerId";
                return $this->conn->update($address, $tableName, $field, $custId);
                break;
            
            case "otherInfo" :
                $otherInfo = $this->converterOtherInfo($data, $custId);
                $tableName = "customer_additional_info";  
                $field = "customerId";
                foreach($otherInfo as $key => $value) {
                    $where = "$field = $custId AND "
                    $id = $this->conn->update($other, $tableName, $condition);    
                }

                return $id;
                break;
        }
    }

    function setData($section,$data, $custId) {
        switch ($section) {
            case "account" :
                $account = $this->converterAccount($data);
                $tableName = "customers";   
                return $this->conn->insert($account, $tableName);
                break;

            case "address" : 
                $address = $this->converterAddress($data, $custId);
                $tableName = "customer_address";
                return $this->conn->insert($address, $tableName);
                break;
            
            case "otherInfo" :
                $otherInfo = $this->converterOtherInfo($data, $custId);
                $tableName = "customer_additional_info";  
                foreach($otherInfo as $other) {
                    $id = $this->conn->insert($other, $tableName);    
                }
                return $id;
                break;
        }
    }

    function converterAccount($data) {
        $account = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'prefix':
                    $account['customerPrefix'] = "'$value'";
                    break;
                
                case 'txtFirstName':
                    $account['customerFirstName'] = "'$value'";
                    break;
                
                case 'txtLastName':
                    $account['customerLastName'] = "'$value'";
                    break;

                case 'birthDate':
                    $account['customerDateBirth'] = "'$value'";
                    break;

                case 'txtPhone':
                    $account['customerPhone'] = "'$value'";
                    break;
                    
                case 'txtEmail':
                    $account['customerEmail'] = "'$value'";
                    break;
                
                case 'txtPassword':
                    $account['customerPassword'] = "'$value'";
                    break;
            }
        }
        return $account;
    }

    function converterAddress($data, $custId) {
        $account = [];
        $account['customerId'] = $custId;
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'addressLine1':
                    $account['custAddAddressLine1'] = "'$value'";
                    break;
                
                case 'addressLine2':
                    $account['custAddAddressLine2'] = "'$value'";
                    break;
                
                case 'txtCompany':
                    $account['custAddCompany'] = "'$value'";
                    break;

                case 'txtState':
                    $account['custAddState'] = "'$value'";
                    break;

                case 'txtCountry':
                    $account['custAddCountry'] = "'$value'";
                    break;
                    
                case 'txtPostalCode':
                    $account['custAddPostCode'] = "'$value'";
                    break;
            }
        }
        return $account;
    }

    function converterOtherInfo($data, $custId) {
        $other = [];
        foreach($data as $key => $value) {
            if(is_array($value)) {
                $value = implode(",", $value);
            }
            $row['custInfoFieldKey'] = "'$key'";
            $row['custInfoFieldValue'] = "'$value'"; 
            $row['customerId'] = $custId;
            array_push($other, $row);
        }
        return $other;
    }

    function prepareFetchAll() {    
        return $this->conn->fetchAll();
    }

    function prepareFetchRow($custId) {
        $tableName = ['customers', 'customer_address', 'customer_additional_info'];
        $field = 'customerId';
        $condition = "$tableName[0].$field = $custId";
        $this->data['account'] = mysqli_fetch_assoc($this->conn->fetchRow($tableName[0], $condition));
        $condition = "$tableName[1].$field = $custId";
        $this->data['address'] = mysqli_fetch_assoc($this->conn->fetchRow($tableName[1], $condition));
        $condition = "$tableName[2].$field = $custId";
        
        $result = $this->conn->fetchRow($tableName[2], $condition);
        while($row = mysqli_fetch_assoc($result)) {

            // print_r($row);
            if($row['custInfoFieldKey'] == 'txtYourSelf') {
                $this->data['otherInfo'][$row['custInfoFieldKey']] = $row['custInfoFieldValue'];
            } else {
                $this->data['otherInfo'][$row['custInfoFieldKey']] = explode(",",$row['custInfoFieldValue']);
            }
            
        }
        // print_r($this->data);
    }
    

}
?>