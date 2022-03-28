<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function submit(Request $request) {
        $people_arr = [];
        $persons = [];
        $titles = ["Mr","Mister","Mrs","Ms","Dr","Prof"];
        if (($handle = fopen($request->file('file'), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                for ($i = 0; $i < $num; $i++) {
                    $data[$i] = str_replace("&", "and", $data[$i]);
                    if (!empty($data[$i]) && in_array(explode(" ", $data[$i])[0], $titles)) {
                        $data_array = explode("and", $data[$i]);
                        array_push($people_arr, $data_array);
                    }
                }
            }
            foreach ($people_arr as $key => $people) {
                foreach ($people as $key2 => $indiv) {
                    $person = [];
                    $indiv = explode(" ",trim(str_replace('.','',$indiv)));
                    if(count($people) == 2) {
                        if($key2 == 0 && count($indiv) < 2) {
                            $arr = explode(" ",trim($people_arr[$key][1]));
                            array_push($indiv,end($arr));
                        }
                        $person['title'] = $indiv[0];
                        if(count($indiv) > 2 && isset($indiv[1]) && strlen($indiv[1])>1){
                            $person['first_name'] = $indiv[1];
                            $person['initial'] = $indiv[1][0] ?? null;
                        }
                        else {
                            $person['first_name'] = null;
                            $person['initial'] = null;
                        }
                        $person['last_name'] = end($indiv);
                        array_push($persons,$person);
                    }
                    else {
                        $people_arr[$key] = $indiv;
                        $person['title'] = $indiv[0];
                        if(count($indiv) > 2){
                            if(isset($indiv[1]) && strlen($indiv[1])>1) {
                                $person['first_name'] = $indiv[1];
                                $person['initial'] = $indiv[1][0];;
                            }
                            else {
                                $person['first_name'] = null;
                                $person['initial'] = $indiv[1];
                            }
                        }
                        else {
                            $person['first_name'] = null;
                            $person['initial'] = null;
                        }
                        $person['last_name'] = end($indiv);
                        array_push($persons,$person);
                    }
                    $people_arr[$key]['count'] = count($people);
                }
            }
            fclose($handle);
            return view('persons',compact('persons'));
        }
    }
}
