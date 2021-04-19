<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-10
 * Time: 00:45
 */

function search($agemin, $agemax, $popmin, $distmax, $arr, $sort)
{
    if (htmlspecialchars($agemin) != $agemin || htmlspecialchars($agemax) != $agemax
        || htmlspecialchars($popmin) != $popmin || htmlspecialchars($distmax) != $distmax
        || htmlspecialchars($sort) != $sort) {
        header('Location: ../view/search.php?error=script');
        exit ();
    }
    foreach ($arr as $k => $v) {
        if (htmlspecialchars($v) != $v) {
            header('Location: ../view/search.php?error=script');
            exit ();
        }
    }
    $array = [];
    $infos = new infos([]);
    if ($sort != 3 && $sort != 4) {
        $array = $infos->research_age($agemin, $agemax, $sort);
        foreach ($array as $k => $v) {
            $pop = $infos->recup_pop($v['id_usr']);
            if ($pop <= $popmin)
                unset ($array[$k]);
        }
        $loc = new location([]);
        $user = $loc->recup_lat_long();
        foreach ($array as $k => $v) {
            $dist = $loc->recup_lat_long_id($v['id_usr']);
            if (($meter = location::distance(intval($user['lat']), intval($user['long']),
                    intval($dist['lat']), intval($dist['long']))) > $distmax) {
                unset ($array[$k]);
            }
        }
        if (!empty($arr)) {
            foreach ($array as $k => $v) {
                $i = 0;
                $int = $infos->recup_inter_research($v['id_usr']);
                unset ($int['id']);
                unset ($int['id_usr']);
                foreach ($int as $k1 => $v1) {
                    if ($v1 == 0)
                        unset ($int[$k1]);
                }
                foreach ($int as $k1 => $v1) {
                    foreach ($arr as $k2 => $v2) {
                        if ($k1 == $v2)
                            $i = 1;
                    }
                }
                if ($i == 0)
                    unset ($array[$k]);
            }
        }
    } else if ($sort == 3 || $sort == 4) {
        $array = $infos->research_pop($popmin, $sort);
        foreach ($array as $k => $v) {
            $age = $infos->find_age($v['id_usr']);
            if ($age < $agemin || $age > $agemax)
                unset ($array[$k]);
        }
        $loc = new location([]);
        $user = $loc->recup_lat_long();
        foreach ($array as $k => $v) {
            $dist = $loc->recup_lat_long_id($v['id_usr']);
            if (($meter = location::distance(intval($user['lat']), intval($user['long']),
                    intval($dist['lat']), intval($dist['long']))) > $distmax) {
                unset ($array[$k]);
            }
        }
        if (!empty($arr)) {
            foreach ($array as $k => $v) {
                $i = 0;
                $int = $infos->recup_inter_research($v['id_usr']);
                unset ($int['id']);
                unset ($int['id_usr']);
                foreach ($int as $k1 => $v1) {
                    if ($v1 == 0)
                        unset ($int[$k1]);
                }
                foreach ($int as $k1 => $v1) {
                    foreach ($arr as $k2 => $v2) {
                        if ($k1 == $v2)
                            $i = 1;
                    }
                }
                if ($i == 0)
                    unset ($array[$k]);
            }
        }
    }
    $block = new infos([]);
    $arr = $block->recup_block();
    foreach ($array as $k => $v) {
        foreach ($arr as $k1 => $v1) {
            if ($v['id_usr'] == $v1['id_usr'])
                unset($array[$k]);
        }
    }
    $arr = $block->recup_blocker();
    foreach ($array as $k => $v) {
        foreach ($arr as $k1 => $v1) {
            if ($v['id_usr'] == $v1['id_blocker'])
                unset($array[$k]);
        }
    }
    return $array;
}
