<?php

use Illuminate\Database\Eloquent\Model;

if (!function_exists("handle_relations")) {

    function handle_relations(string $relations, array $possible_relations, Model $model)
    {
        if (strpos($relations, ",")) {
            $exploded_relations = explode(",", $relations);
            $all_relations_exists = true;

            for ($i = 0; $i < count($exploded_relations); $i++) {
                if (!in_array($exploded_relations[$i], $possible_relations)) {
                    $all_relations_exists = false;
                    break;
                }
            }

            if ($all_relations_exists) {
                $model = $model->with($exploded_relations);
            } else {
                abort(400, "The request's relations are not supported");
            }
        } else {
            if (in_array($relations, $possible_relations)) {
                $model = $model->with($relations);
            } else {
                abort(400, "The request's relation is not supported");
            }
        }

        return $model;
    }
}
if (!function_exists('convert_array')) {
    function convert_array(array $data)
    {
        $result = [];
        foreach ($data as $key => $piece) {
            $result[$key] = [];

            if ($piece["status"] ?? false) {
                $result[$key]["status"] = $piece["status"];
            }
            if ($piece["hardcase_code"] ?? false) {
                $result[$key]["hardcase_code"] = $piece["hardcase_code"];
            }
            if ($piece["fak_code"] ?? false) {
                $result[$key]["fak_code"] = $piece["fak_code"];
            }
            if ($piece["general_code"] ?? false) {
                $result[$key]["general_code"] = $piece["general_code"];
            }
            if ($piece["helmet_code"] ?? false) {
                $result[$key]["helmet_code"] = $piece["helmet_code"];
            }
            if ($piece["motor_code"] ?? false) {
                $result[$key]["motor_code"] = $piece["motor_code"];
            }
            if ($piece["item_code"] ?? false) {
                $result[$key]["item_code"] = $piece["item_code"];
            }
        }
        return $result;
    }
}
