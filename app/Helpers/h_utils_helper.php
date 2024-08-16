<?php

if (!function_exists("array_group_by_key")) {
    function array_group_by_key(array $aTableToGroup, string $strNameColumnGroup) {
        $aReturn = array();

        foreach($aTableToGroup as $aLineTable){
            $aReturn[$aLineTable[$strNameColumnGroup]] = $aLineTable;
        }

        return $aReturn;
    }
}