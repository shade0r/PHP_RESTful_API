<?php

class ProductGateway 
{
    private Pdo $conn;
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    public function getAll () :array
    {
        $sql = "SELECT * FROM product";
        $stmt = $this->conn->query($sql);
        $result = [];
        while ($data= $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $data['is_available'] = (bool) $data['is_available'];
            $result[]= $data;
        }
        return $result;
    }
    public function create (array $data) :string
    {
        $sql = "INSERT INTO product (name,size,is_available) VALUES (:name,:size,:is_available)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":name",$data['name'],PDO::PARAM_STR);
        $stmt->bindValue(":size",$data['size'] ?? 0 ,PDO::PARAM_INT);
        $stmt->bindValue(":is_available",(bool) $data['is_available'] ?? false,PdO::PARAM_BOOL);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
    public function deleteAll() :void
    {
        $sql = "DELETE FROM product";
        $this->conn->query($sql);
    }
    public function get(int $id): array | false
    {
        $sql = "SELECT * FROM product WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data !== false)
        {
            $data['is_available'] = (bool) $data['is_available'];
        }
        return $data;
    }    
    public function update(array $current, array $new): int
    {
        $sql = "UPDATE product SET  name = :name, size = :size, is_available = :is_available WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":name", $new['name'] ?? $current['name'], PDO::PARAM_STR);      
        $stmt->bindValue(":size", $new['size'] ?? $current['size'], PDO::PARAM_INT);
        $stmt->bindValue(":is_available", $new['is_available'] ?? $current['is_available'], PDO::PARAM_BOOL);
        $stmt->bindValue(":id", $current['id'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();


    }
    public function delete(int $id): int
    {
        $sqlDele = "DELETE FROM product WHERE id = :id";
        $stmtDele = $this->conn->prepare($sqlDele);
        $stmtDele->bindValue(":id", $id, PDO::PARAM_INT);
        $stmtDele->execute();
        return $stmtDele->rowCount();

    }

}