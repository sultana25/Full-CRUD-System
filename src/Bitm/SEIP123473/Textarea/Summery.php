<?php
namespace App\Bitm\SEIP123473\Textarea;
use App\Bitm\SEIP123473\Message\Message;

class Summery
{
    public $id = "";
    public $name = "";
    public $summery = "";
    public $filterByName="";
    public $filterByTextarea="";
    public $search="";
    public $conn = "";
    public $deleted_at;


    public function prepare($data = array())
    {
        if(array_key_exists("name",$data)){
            $this->name= filter_var($data["name"],FILTER_SANITIZE_STRING);
        }
        if(array_key_exists("Summery",$data)){
            $this->summery= ($data["Summery"]);
        }
        if (array_key_exists("filterByName", $data)) {
            //echo !empty($data['filterByName']);
            //die();
            $this->filterByName = $data['filterByName'];
            //echo !empty($this->filterByName);
            //die();
        }
        if (array_key_exists("filterBySummery", $data)) {
            $this->filterByTextarea = $data['filterBySummery'];
            //Utility::dd($this->filterByCity);
            //die();
        }
        if (array_key_exists("search", $data)) {
            $this->search = $data['search'];
        }

        if (array_key_exists("id", $data)) {
            $this->id = $data["id"];
        }

        return $this;
    }


    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "atomicproject21") or die("Data is not connected");
    }


    public function store()
    {
        $query="INSERT INTO `atomicproject21`.`textarea` (`name`, `summery`) VALUES ( '".$this->name."', '".$this->summery."')";
        $result=mysqli_query($this->conn,$query);
        if($result) {
            Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Data has been stored successfully.
</div>");
            header("location:index.php");

        }


        else
        {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Failed!</strong> Data has not been stored successfully.
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
        if(!empty($this->filterByTextarea)){
            $whereClause.=" AND summery LIKE '%".$this->filterByTextarea."%'";
        }

        if(!empty($this->search)){
            $whereClause .= " AND description LIKE '%".$this->search."%' OR  name LIKE '%".$this->search."%'";
        }
        $allinfo=array();
        $query="SELECT * FROM `textarea` WHERE `deleted_at`IS NULL AND ". $whereClause;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $allinfo[]=$row;
        }
        return $allinfo;


    }


    public function view(){
        $query="SELECT * FROM `textarea` WHERE `id`=".$this->id;
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }


    public function update()
    {
        $query = "UPDATE `atomicproject21`.`textarea` SET `name` = '".$this->name."', `summery` = '".$this->summery."' WHERE `textarea`.`id` =".$this->id;
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
        $query = "DELETE FROM `atomicproject21`.`textarea` WHERE `textarea`.`id` = ".$this->id;
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
        $query = "UPDATE `atomicproject21`.`textarea` SET `deleted_at` = '" . $this->deleted_at . "' WHERE `textarea`.`id` = " . $this->id;
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
        $query="SELECT * FROM `textarea` WHERE `deleted_at`IS NOT NULL ";
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }


    public function recover()
    {
        $query = "UPDATE `atomicproject21`.`textarea` SET `deleted_at` = NULL WHERE `textarea`.`id` = " . $this->id;
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
            $query = "UPDATE `atomicproject21`.`textarea` SET `deleted_at` = NULL WHERE `textarea`.`id` IN (" .$IDs.")";
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

            $query = "DELETE FROM `atomicproject21`.`textarea` WHERE `textarea`.`id` IN (".$IDs.")";
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
        $query="SELECT COUNT(*) AS totalItem FROM `textarea` WHERE `deleted_at` IS NULL";
        $result=mysqli_query($this->conn,$query);
        $row=mysqli_fetch_assoc($result);
        return $row["totalItem"];
    }


    public function paginator($pageStartFrom=0,$limit=5)
    {

        $_allInfo=array();
        $query="SELECT * FROM `textarea` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$limit;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }
    public function allName(){
        $_allInfo= array();
        $query="SELECT name FROM `textarea`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allInfo[]=$row['name'];
        }
        return $_allInfo;

    }
    public function allTextarea(){
        $_allInfo= array();
        $query="SELECT summery FROM `textarea`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allInfo[]=$row['summery'];
        }
        return $_allInfo;

    }





}
