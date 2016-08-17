<?php

namespace components;

use main\Application;

class AppModel
{
    protected static $pdo;
    
    protected $attributes = array();
    public static $table;
    protected static $model;

    public static $errors = array();
    public static $rules = array();

    private static $inited = false;

    protected static function init()
    {
        if (!self::$inited) {
            self::$pdo = Application::pdo();
            $model = get_called_class();
            self::$model = $model;
            self::$table = $model::$table;
            self::$rules = $model::$rules;
            self::$inited = true;
        }
    }

    public static function validate(&$attributes)
    {
        self::init();

        $attributes = self::clear($attributes);

        foreach (self::$rules as $attr => $rule) {
            if ($rule == 'required') {
                if (empty($attributes[$attr])) {
                    self::$errors[$attr] = "Field <strong>{$attr}</strong> should not be empty";
                }
            }
        }

        return empty(self::$errors);
    }

    public static function getErrors()
    {
        return self::$errors;
    }

    public static function getAll($sort = [])
    {
        self::init();

        $sql = 'SELECT * FROM ' . self::$table;
        if ($sort) {
            if (!empty($sort['column'])) {
                $sql .= ' ORDER BY ' . $sort['column'];
            }
            if (!empty($sort['direction'])) {
                $sql .= ' ' . $sort['direction'];
            }
        }

        $allData = self::$pdo->query($sql)->fetchAll();
        $allData = self::prepare($allData);

        return $allData;
    }
    
    public static function get($attributes = [])
    {
        self::init();

        if (empty($attributes)) {
            return self::getAll();
        }

        $condition = '';

        $isFirst = true;
        foreach ($attributes as $attr => $value) {
            if ($isFirst) {
                $condition .= "$attr=\"$value\"";
                $isFirst = false;
                continue;
            }

            $condition .= " AND $attr=\"$value\"";
        }

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $condition;

        $data = self::$pdo->query($sql)->fetchObject();

        return $data;
    }

    public static function remove($id)
    {
        self::init();

        $sql = 'DELETE FROM ' . self::$table . ' WHERE id =  :id';
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function insert($data)
    {
        $this->attributes = $data;
    }

    public function store()
    {
        $attrNames = array_keys($this->attributes);
        $attrFilterNames = array_map(function ($v) {return ':' . $v;}, $attrNames);

        $attrNamesString = join(',', $attrNames);
        $attrFilterNamesString = join(',', $attrFilterNames);

        $sql = "INSERT INTO " . self::$table . " ({$attrNamesString}) VALUES ({$attrFilterNamesString})";

        $stmt = self::$pdo->prepare($sql);

        foreach ($attrNames as $key => $attribute) {
            $stmt->bindParam($attrFilterNames[$key], $this->attributes[$attribute], \PDO::PARAM_STR);
        }

        $stmt->execute();
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    private static function clear($attributes)
    {
        foreach ($attributes as $key => &$attribute) {
            if ($key == 'submit') {
                unset($attributes[$key]);
                continue;
            }

            $attribute = trim($attribute);
            $attribute = stripslashes($attribute);
            $attribute = htmlspecialchars($attribute);
        }

        return $attributes;
    }

    private static function prepare($data = [])
    {
        foreach ($data as &$attributes) {
            $attributes = array_map(
                function ($v) {
                    return html_entity_decode($v);
                },
                $attributes
            );
        }

        return $data;
    }
}
