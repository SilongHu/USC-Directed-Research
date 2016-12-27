<?php
    function scrap_material($doc, $url, $description, $title) {
        if (strpos($url, 'sephora.com') !== FALSE) {
            return array();
        }
        $tmp_result = array();
        $final_result = array();
        $dic = array(
                        1 => 'canvas',
                        2 => 'cashmere',
                        3 => 'chiffon',
                        4 => 'corduroy',
                        5 => 'cotton',
                        6 => array ('denim', 'chambray', 'jeans', 'jean'),
                        7 => 'felt',
                        8 => array ('flannel', 'plaid'),
                        9 => 'fleece',
                        10 => 'fur',
                        11 => 'goose',
                        12 => array ('lace', 'lacey'),
                        13 => 'leather',
                        14 => 'linen',
                        15 => 'neoprene',
                        16 => 'rubber',
                        17 => 'satin',
                        18 => 'silk',
                        19 => array ('suede', 'nubuck'),
                        20 => array ('synthetic', 'rayon', 'spandex', 'viscose', 'polyester', 'elastane', 'lycra', 'nylon', 'acrylic', 'acetate', 'polyurethane', 'poly'),
                        21 => array ('tulle', 'tulled'),
                        22 => 'tweed',
                        23 => 'velvet',
                        24 => 'wool'
                    );
        
        $description=strip_tags($description);
        $description=str_replace("\t",' ',$description);
        $description=str_replace("\n",' ',$description);
        $description=str_replace("\r",' ',$description);
        
        $description = strtolower($description . ' ' . $title);
        
        $description_arr = explode(' ', $description);
        
        foreach ($description_arr as $word) {
            foreach ($dic as $k => $material) {
                if (is_array($material)) {
                    for ($i = 0; $i < count($material); $i++) {
                        if (strpos($word, $material[$i]) !== FALSE && is_material($word, $material[$i])) {
                            $tmp_result[] = $k;
                            break;
                        }
                    }
                }
                else {
                    if (strpos($word, $material) !== FALSE && is_material($word, $material)) {
                        $tmp_result[] = $k;
                    }
                }
            }
        }
        
        $unique_result = array_unique($tmp_result);
        foreach ($unique_result as $materialID) {
            if ($materialID) {
                if (is_array($dic[$materialID])) {
                    // $final_result[$tmp_result[$i]] = ucfirst($dic[$tmp_result[$i]][0]);
                    $final_result[] = array ('MaterialID' => (string)$materialID, 'Material' => ucfirst($dic[$materialID][0]));
                }
                else {
                    // $final_result[$tmp_result[$i]] = ucfirst($dic[$tmp_result[$i]]);
                    $final_result[] = array ('MaterialID' => (string)$materialID, 'Material' => ucfirst($dic[$materialID]));
                }
            }
        }
        
        return $final_result;
    }
    
    /**
     * Check whether a word containing chars of material indicates the material
     * @param string $description : A single word from description
     * @param string $material : A kind of material from $dic
     * @return bool : whether the word indicating a material
     */
    function is_material($description, $material) {
        if (strlen($description) == 0 && strlen($material) != 0) {
            // echo "Description error";
            return false;
        }
        if (strlen($description) != 0 && strlen($material) == 0) {
            // echo "Material error";
            return false;
        }
        
        if ($description == $material) {
            return true;
        }
        else {
            $des_len = strlen($description);
            $mtr_len = strlen($material);
            if ($des_len <= $mtr_len) {
                return false;
            }
            
            $p = strpos($description, $material);
            if ($p == 0 ) {
                //echo "POST===desc: $description" . ", material: $material" . '<br>';
                //$rs = preg_match('/^[a-z]+/', substr($description, $mtr_len), $match);
                //print_r($rs);
                if (preg_match('/^[a-z]+/', substr($description, $mtr_len))) {
                    // echo 111 . $description . '<br>';
                    return false;
                }
            }
            else if (strpos($description, $material) == ($des_len - $mtr_len)) {
                //echo "PRE====desc: $description" . ", material: $material" . '<br>';
                //$p = strpos($description, $material);
                //$rs = preg_match('/[a-z]+$/', substr($description, 0, strpos($description, $material)));
                //print_r($rs);
                if (preg_match('/[a-z]+$/', substr($description, 0, $p))) {
                    // echo 222 . $description . '<br>';
                    return false;
                }
            }
            else {
                // $p = strpos($description, $material);
                if (preg_match('/^[a-z]+/', substr($description, ($p + $mtr_len)))) {
                    // echo 333 . $description . '<br>';
                    return false;
                }
                if (preg_match('/[a-z]+$/', substr($description, 0, $p))) {
                    // echo 444 . $description . '<br>';
                    return false;
                }
            }
        }
        
        return true;    
    }

?>