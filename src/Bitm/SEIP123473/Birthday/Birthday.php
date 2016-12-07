<?php
namespace App\Bitm\SEIP123473\Birthday;
use App\Bitm\SEIP123473\Message\Message;

class Birthday
{
    public $id;
    public $name;
    public $birthday;
    public $description;
    public $descriptionwohtml;
    public $filterByName="";
    public $filterByBirthday="";
    public $search="";
    public $conn;
    public $deleted_at;

    public function prepare($data=""){
        if(array_key_exists("name",$data)){
            $this->name= filter_var($data["name"],FILTER_SANITIZE_STRING);
        }
        if(array_key_exists("Birthday",$data)){
            $this->birthday= ($data["Birthday"]);
        }
        if(array_key_exists("description",$data)){
            $this->description= $data['description'];
        }
        if (array_key_exists("description", $data)) {
            $this->descriptionwohtml = strip_tags($data['description']);
        }
        if (array_key_exists("filterByName", $data)) {
            //echo !empty($data['filterByName']);
            //die();
            $this->filterByName = $data['filterByName'];
            //echo !empty($this->filterByName);
            //die();
        }
        if (array_key_exists("filterByBirthday", $data)) {
            $this->filterByBirthday = $data['filterByBirthday'];
            //Utility::dd($this->filterByBirthday);
            //die();
        }
        if (array_key_exists("search", $data)) {
            $this->search = $data['search'];
        }
        if(array_key_exists("id",$data)){
            $this->id= $data['id'];
        }

        return $this;

    }



    public function __construct()
    {
        $this->conn=mysqli_connect("localhost","root","","atomicproject21");
    }
    public function store()
    {
        $query="INSERT INTO `atomicproject21`.`birthday` ( `name`, `birthdate`, `description`, `descriptionwohtml`) VALUES ('".$this->name."', '".$this->birthday."', '".$this->description."', '".$this->descriptionwohtml."')";
        $result=mysqli_query($this->conn,$query);
        if($result)
        {
            Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Data has been stored successfully.
</div>");
            header("location:index.php");
        }
        else
        {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Failed!</strong> Data has been not stored successfully.
</div>");
            header("location:index.php");
        }
    }

    public function index()
    {
        $whereClause = "1=1";
        if(!empty($this->filterByName)){
            $whereClause.=" AND name LIKE '%".$this->filterByName."%'";
        }
        if(!empty($this->filterByBirthday)){
            $whereClause.=" AND birthdate LIKE '%".$this->filterByBirthday."%'";
        }

        if(!empty($this->description)){
            $whereClause.=" AND description LIKE '%".$this->description."%'";
        }
        if(!empty($this->search)){
            $whereClause .= " AND description LIKE '%".$this->search."%' OR  name LIKE '%".$this->search."%' OR  birthdate LIKE '%".$this->search."%'";
        }
        $_allInfo=array();
        $query="SELECT * FROM `birthday` WHERE `deleted_at`IS NULL AND ". $whereClause;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }



    public function view(){
        $query="SELECT * FROM `birthday` WHERE `id`=".$this->id;
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_object($result);
        return $row;
    }



    public function update()
    {
        $query = "UPDATE `atomicproject21`.`birthday` SET `name` = '".$this->name."', `birthdate` = '".$this->birthday."', `description` = '".$this->description."', `descriptionwohtml` = '".$this->descriptionwohtml."' WHERE `birthday`.`id` =".$this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Updated!</strong> Data has been Updated successfully.
</div>");
            header('Location:index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been updated  successfully.
    </div>");
            header('Location:index.php');
        }

    }


    public function delete()
    {
        $query = "DELETE FROM `atomicproject21`.`birthday` WHERE `birthday`.`id` =" . $this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Deleted!</strong> Data has been deleted successfully.
</div>");
            header('Location:index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been deleted  successfully.
    </div>");
            header('Location:index.php');


        }


    }


    public function trash()
    {
        $this->deleted_at = time();
        $query = "UPDATE `atomicproject21`.`birthday` SET `deleted_at` = '" . $this->deleted_at . "' WHERE `birthday`.`id` = " . $this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Updated!</strong> Data has been trashed successfully.
</div>");
            header('Location:index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been trashed  successfully.
    </div>");
            header('Location:index.php');
        }


    }



    public function trashed()
    {
        $_allInfo=array();
        $query="SELECT * FROM `birthday` WHERE `deleted_at` IS NOT NULL ";
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }


    public function recover()
    {
        $query = "UPDATE `atomicproject21`.`birthday` SET `deleted_at` = NULL WHERE `birthday`.`id` = " . $this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Recovered!</strong> Data has been recovered successfully.
</div>");
            header('Location:index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been recovered  successfully.
    </div>");
            header('Location:index.php');
        }


    }

    public function recoverMultiple($idS=array())
    {
        if((is_array($idS))&&(count($idS)>0)) {
            $IDs =implode(",",$idS);
            $query = "UPDATE `atomicproject21`.`birthday` SET `deleted_at` = NULL WHERE `birthday`.`id` IN (" .$IDs.")";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                Message::message("<div class=\"alert alert-info\">
  <strong>Recovered!</strong>Selected data has been recovered successfully.
</div>");
                header('Location:index.php');

            } else {
                Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong>Selected data has not been recovered  successfully.
    </div>");
                header('Location:index.php');
            }
        }


    }


    public function deleteMultiple($idS=array())
    {
        if((is_array($idS))&&(count($idS)>0)) {
            $IDs=implode(",",$idS);

            $query = "DELETE FROM `atomicproject21`.`birthday` WHERE `birthday`.`id` IN (".$IDs.")";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                Message::message("<div class=\"alert alert-info\">
  <strong>Deleted!</strong>Selected data has been deleted successfully.
</div>");
                header('Location:index.php');

            } else {
                Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Selected data has not been deleted  successfully.
    </div>");
                header('Location:index.php');


            }
        }


    }
    public function count()
    {
        $query="SELECT COUNT(*) AS totalItem FROM `birthday` WHERE `deleted_at` IS NULL";
        $result=mysqli_query($this->conn,$query);
        $row=mysqli_fetch_assoc($result);
        return $row["totalItem"];
    }


    public function paginator($pageStartFrom=0,$limit=5)
    {

        $_allInfo=array();
        $query="SELECT * FROM `birthday` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$limit;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }

    public function allName(){
        $_allInfo= array();
        $query="SELECT name FROM `birthday`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allInfo[]=$row['name'];
        }
        return $_allInfo;

    }
    public function allBirthday(){
        $_allInfo= array();
        $query="SELECT birthdate FROM `birthday`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allInfo[]=$row['birthdate'];
        }
        return $_allInfo;

    }

    public function allDescription(){
        $_allDescription= array();
        $query="SELECT `descriptionwohtml` FROM `birthday`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allDescription[]=$row['descriptionwohtml'];
        }
        return  $_allDescription;
    }


}