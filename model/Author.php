<?php
require_once 'config/config.php';
class Author
{
    private $author_id;
    private $author_name;
    private $author_img;

    public function __construct($author_id, $author_name, $author_img)
    {
        $this->author_id = $author_id;
        $this->author_name = $author_name;
        $this->author_img = $author_img;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    public function getAuthorName()
    {
        return $this->author_name;
    }

    public function setAuthorName($author_name)
    {
        $this->author_name = $author_name;
    }

    public function getAuthorImg()
    {
        return $this->author_img;
    }

    public function setAuthorImg($author_img)
    {
        $this->author_img = $author_img;
    }

    public static function getAll()
    {
        $sql = 'SELECT * FROM tacgia';
        $stmt = $conn->query($sql);

        $authors = [];
        while ($row = $stmt->fetch()) {
            $author = new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
            array_push($authors, $author);
        }
        return $authors;
    }

    public function add()
    {
        $sql = 'INSERT INTO tacgia (ma_tgia, ten_tgia, hinh_tgia) VALUES(:author_id, :author_name, :author_avt)';
        $stmt = $conn->prepare($sql);
        $stmt->bindvalue('author_id', $author_id);
        $stmt->bindvalue('author_name', $author_name);
        $stmt->bindvalue('author_avt', $author_avt);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function getById($id)
    {
        $sql = 'SELECT * FROM tacgia WHERE ma_tgia = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindvalue('id', $id);
        $stmt->execute();

        $row = $stmt->fetch();
        $author = new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
        return $author;
    }

    public function editAuthor($author_id, $author_name, $author_avt)
    {
        $sql = 'UPDATE tacgia SET ten_tgia = :author_name, hinh_tgia = :author_avt WHERE ma_tgia = :author_id';
        $stmt = $conn->prepare($sql);
        $stmt->bindvalue('author_id', $author_id);
        $stmt->bindvalue('author_name', $author_name);
        $stmt->bindvalue('author_avt', $author_avt);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function delete()
    {
        $sql = 'DELETE FROM tacgia WHERE ma_tgia = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindvalue('id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
