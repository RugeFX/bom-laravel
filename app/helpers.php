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
                abort(400, "The requestes relations are not supported");
            }
        } else {
            if (in_array($relations, $possible_relations)) {
                $model = $model->with($relations);
            } else {
                abort(400, "The requestes relation is not supported");
            }
        }

        return $model;
    }
}
if(!function_exists('convert_array')){
    function convert_array(array $data)
    {
        $result = [];
        foreach ($data as $piece) {
            $result[$piece["item_code"]] = [];

            if ($piece["quantity"] ?? false) {
                $result[$piece["item_code"]]["quantity"] = $piece["quantity"];
            }
            if ($piece["bom_code"] ?? false) {
                $result[$piece["item_code"]]["bom_code"] = $piece["bom_code"];
            }
        }
        return $result;
    }
}
