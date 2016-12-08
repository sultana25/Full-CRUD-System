<?php
namespace App\Bitm\SEIP123473\City;
use App\Bitm\SEIP123473\Message\Message;

class City
{
    public $id = "";
    public $name = "";
    public $city = "";
    public $description;
    public $descriptionwohtml;
    public $filterByName="";
    public $filterByCity="";
    public $search="";
    public $conn = "";
    public $deleted_at;


    public function prepare($data = array())
    {
        if (array_key_exists("name", $data)) {
            $this->name = filter_var($data["name"], FILTER_SANITIZE_STRING);
        }

        if (array_key_exists("City", $data)) {
            $this->city = ($data["City"]);
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
        if (array_key_exists("filterByCity", $data)) {
            $this->filterByCity = $data['filterByCity'];
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
        $query="INSERT INTO `atomicproject21`.`city` ( `name`, `city_name`, `description`, `descriptionwohtml`) VALUES ('".$this->name."', '".$this->city."', '".$this->description."', '".$this->descriptionwohtml."')";
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
        if(!empty($this->filterByCity)){
            $whereClause.=" AND city_name LIKE '%".$this->filterByCity."%'";
        }

        if(!empty($this->description)){
            $whereClause.=" AND description LIKE '%".$this->description."%'";
        }
        if(!empty($this->search)){
            $whereClause .= " AND description LIKE '%".$this->search."%' OR  name LIKE '%".$this->search."%' OR  city_name LIKE '%".$this->search."%'";
        }
        $allinfo=array();
        $query="SELECT * FROM `city` WHERE `deleted_at`IS NULL AND ". $whereClause;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $allinfo[]=$row;
        }
        return $allinfo;


    }


    public function view()
    {
        $qurey="SELECT * FROM `city` WHERE `id`=".$this->id;
        $result=mysqli_query($this->conn,$qurey);
        $row=mysqli_fetch_assoc($result);
        return $row;
    }


    public function update()
    {
        $query = "UPDATE `atomicproject21`.`city` SET `name` = '".$this->name."', `city_name` = '".$this->city."', `description` = '".$this->description."', `descriptionwohtml` = '".$this->descriptionwohtml."' WHERE `city`.`id` =".$this->id;
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
        $query = "DELETE FROM `atomicproject21`.`city` WHERE `city`.`id` = ".$this->id;
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
        $query = "UPDATE `atomicproject21`.`city` SET `deleted_at` = '" . $this->deleted_at . "' WHERE `city`.`id` = " . $this->id;
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
        $query="SELECT * FROM `city` WHERE `deleted_at`IS NOT NULL ";
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }


    public function recover()
    {
        $query = "UPDATE `atomicproject21`.`city` SET `deleted_at` = NULL WHERE `city`.`id` = " . $this->id;
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
            $query = "UPDATE `atomicproject21`.`city` SET `deleted_at` = NULL WHERE `city`.`id` IN (" .$IDs.")";
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

            $query = "DELETE FROM `atomicproject21`.`city` WHERE `city`.`id` IN (".$IDs.")";
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
        $query="SELECT COUNT(*) AS totalItem FROM `city` WHERE `deleted_at` IS NULL";
        $result=mysqli_query($this->conn,$query);
        $row=mysqli_fetch_assoc($result);
        return $row["totalItem"];
    }


    public function paginator($pageStartFrom=0,$limit=5)
    {

        $_allInfo=array();
        $query="SELECT * FROM `city` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$limit;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }
    public function allName(){
        $_allInfo= array();
        $query="SELECT name FROM `city`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allInfo[]=$row['name'];
        }
        return $_allInfo;

    }
    public function allCity(){
        $_allInfo= array();
        $query="SELECT city_name FROM `city`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allInfo[]=$row['city_name'];
        }
        return $_allInfo;

    }

    public function allDescription(){
        $_allDescription= array();
        $query="SELECT `descriptionwohtml` FROM `city`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allDescription[]=$row['descriptionwohtml'];
        }
        return  $_allDescription;
    }




}
