<?php

namespace model;

use components\AppModel;

class Feedback extends AppModel
{
    public static $rules = array(
        'name' => 'required',
        'email' => 'required',
    );

    public static $table = 'feedback';

    public static function update($attributes)
    {
        parent::init();

        $attrNames = array_keys($attributes);
        $attrFilterNames = array_map(function ($v) {return ':' . $v;}, $attrNames);

        $values = '';
        foreach ($attributes as $value => $attribute) {
            if ($value == 'id') {
                continue;
            }
            $values .= "{$value}=:{$value},";
        }
        $values = substr($values, 0, -1);

        $sql = "Update " . self::$table . " SET " . $values . " WHERE id=" . $attributes['id'];

        $stmt = self::$pdo->prepare($sql);


        foreach ($attrNames as $key => $attribute) {
            if ($key == 'id' || $attrFilterNames[$key] == ':id') {
                continue;
            }

            $stmt->bindParam($attrFilterNames[$key], $attributes[$attribute], \PDO::PARAM_STR);
        }

        $stmt->execute();
    }

    public static function setStatus($id, $status) {
        parent::init();

        $sql = "UPDATE " . self::$table . " SET status=\"{$status}\" WHERE id={$id}";

        $stmt = self::$pdo->prepare($sql);

        $stmt->execute();
    }
}
