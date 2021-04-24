<?php

namespace App\Model\MyFunctions;

class Functions {

    public static function Code_($nom, $id = 0, $lenght_id = 0) {
        $str = $nom;
        $str = preg_replace('#Ç#', 'C', $str);
        $str = preg_replace('#ç#', 'c', $str);
        $str = preg_replace('#è|é|ê|ë#', 'e', $str);
        $str = preg_replace('#È|É|Ê|Ë#', 'E', $str);
        $str = preg_replace('#à|á|â|ã|ä|å#', 'a', $str);
        $str = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $str);
        $str = preg_replace('#ì|í|î|ï#', 'i', $str);
        $str = preg_replace('#Ì|Í|Î|Ï#', 'I', $str);
        $str = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $str);
        $str = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $str);
        $str = preg_replace('#ù|ú|û|ü#', 'u', $str);
        $str = preg_replace('#Ù|Ú|Û|Ü#', 'U', $str);
        $str = preg_replace('#ý|ÿ#', 'y', $str);
        $str = preg_replace('#Ý#', 'Y', $str);
        $str = preg_replace("#'|’|;|,|:#", '-', $str);
        $str = preg_replace('#"#', '-', $str);

        $mots = explode(' ', $str);
        $mots_concat = '';
        foreach ($mots as $i => $m):
            $mots_concat .= ($i == 0 ? '' : '-') . strtolower($m);
        endforeach;
        if($id > 0)
            $mots_concat .= '_';
        return sprintf("%s" . ($id ? '%0' . $lenght_id . "d" : ''), $mots_concat, $id);
    }

    public static function getAutoIncrementValue($table) {
        // $connection = ConnectionManager::get('default');
        // $result = $connection->execute("SELECT auto_increment FROM information_schema.tables WHERE table_name='" . $table . "' AND table_schema='luqman'")->fetch('assoc');
        // return $result['auto_increment'];
    }

}
