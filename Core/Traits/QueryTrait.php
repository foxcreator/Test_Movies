<?php

namespace Core\Traits;

use PDO;

trait QueryTrait
{
    use ConnectionTrait;

    static protected string|null $tableName = '';

    public static function all()
    {
        $query = 'SELECT * FROM ' . static::$tableName;
        return static::connect()->query($query)->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function find(int $id)
    {
        $query = "SELECT * FROM " . static::$tableName . " WHERE id = :id";

        $query = static::connect()->prepare($query);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchObject(static::class);
    }

    public static function save(array $data)
    {
        $vars = static::prepareQueryVars($data);
        $query = 'INSERT INTO ' . static::$tableName . '(' . $vars['keys'] . ') VALUES (' . $vars['placeholders'] . ')';
        $query = static::connect()->prepare($query);

        foreach ($data as $key => $value){
            $query->bindValue(":{$key}", $value);
        }

        $query->execute();

        return (int)static::connect()->lastInsertId();
    }

    public static function delete(int $id)
    {
        $query = "DELETE FROM " . static::$tableName . " WHERE id = :id";

        $query = static::connect()->prepare($query);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
//        dd($query);

        $query->execute();
    }

    public static function update(array $data, $id)
    {
        $vars = static::prepareQueryVars($data);

        $query = 'UPDATE ' . static::$tableName . ' SET ';
        $query .= static::buildPlaceholders($data);
        $query .= ' WHERE id=:id';

        $stmt = static::connect()->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}" , $value);
        }
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return static::find($id);
    }

    private static function buildPlaceholders(array $data):string
    {
        $ph = [];

        foreach ($data as $key => $value) {
            $ph[] = "{$key}=:{$key}";
        }

        return implode(',', $ph);
    }

    public static function prepareQueryVars(array $fields)
    {
        $keys = array_keys($fields);
        $placeholders = preg_filter('/^/', ':', $keys);

        return [
            'keys' => implode(',', $keys),
            'placeholders' => implode(',', $placeholders)
        ];
    }

    protected static function countRow()
    {
        $query = "SELECT COUNT(*) FROM " . static::$tableName;

        $query = static::connect()->prepare($query);
        $query->execute();

        return $query->fetchColumn();
    }

    public static function paginate($limit)
    {
        $page = $_GET['page'] ?? 1;
        $offset = $limit * ($page - 1);
        $totalPages = ceil(static::countRow() / $limit);

        $query = "SELECT * FROM " . static::$tableName . " LIMIT " . $limit . " OFFSET " . $offset;

        $query = static::connect()->prepare($query);
        $query->execute();

        $movies = $query->fetchAll(PDO::FETCH_CLASS, static::class);

        $pagData = [
            'movies' => $movies,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ];

        return $pagData;
    }

}
