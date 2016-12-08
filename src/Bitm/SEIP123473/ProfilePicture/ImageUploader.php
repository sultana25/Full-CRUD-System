<?php
namespace App\Bitm\SEIP123473\ProfilePicture;
use App\Bitm\SEIP123473\Message\Message;
class ImageUploader
{
    public $id="";
    public $name="";
    public $image_name="";
    public $description;
    public $descriptionwohtml;
    public $filterByName="";
    public $search="";
    public $conn="";
    public $deleted_at;



    public function prepare($data=array())
{
    if(array_key_exists("name",$data))
    {
        $this->name=$data["name"];
    }
    if(array_key_exists("image",$data))
    {
        $this->image_name=$data["image"];
    }
    if(array_key_exists("description",$data)){
        $this->description= $data['description'];
    }
    if (array_key_exists("description", $data)) {
        $this->descriptionwohtml = strip_tags($data['description']);
    }
    if (array_key_exists("filterByName", $data)) {

        $this->filterByName = $data['filterByName'];

    }
    if (array_key_exists("search", $data)) {
        $this->search = $data['search'];
    }
    if(array_key_exists("id",$data))
    {
        $this->id=$data["id"];
    }
    return $this;

}


    public function __construct()
    {
        $this->conn=mysqli_connect("localhost","root","","atomicproject21")or die("Data connection is not connected successfully");
    }


    public function store()
    {
        $query="INSERT INTO `atomicproject21`.`profilepicture` (`id`, `name`, `images`, `description`, `descriptionwohtml`, `deleted_at`) VALUES (NULL, '".$this->name."', '".$this->image_name."', '".$this->description."', '".$this->descriptionwohtml."', NULL);";
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

        if(!empty($this->description)){
            $whereClause.=" AND description LIKE '%".$this->description."%'";
        }
        if(!empty($this->search)){
            $whereClause .= " AND description LIKE '%".$this->search."%' OR  name LIKE '%".$this->search."%'";
        }
        $allInfo=array();
        $query="SELECT * FROM `profilepicture` WHERE `deleted_at`IS NULL AND ". $whereClause;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $allInfo[]=$row;
        }
        return $allInfo;


    }


    public function view()
    {
        $query="SELECT * FROM `profilepicture` WHERE `id`=".$this->id;
        $result=mysqli_query($this->conn,$query);
        $row=mysqli_fetch_object($result);
        return $row;
    }




    public function update()
    {
        $query="UPDATE `atomicproject21`.`profilepicture` SET `name` = '".$this->name."', `images` = '".$this->image_name."', `description` = '".$this->description."', `descriptionwohtml` = '".$this->descriptionwohtml."' WHERE `profilepicture`.`id` =".$this->id;
        $result=mysqli_query($this->conn,$query);
        if($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Success!</strong> Data has been updated successfully.
</div>");
            header("location:index.php");

        }


        else
        {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Failed!</strong> Data has not been updated successfully.
</div>");
            header("location:index.php");
        }

    }

    public function delete()
    {
        $query="DELETE FROM `atomicproject21`.`profilepicture` WHERE `profilepicture`.`id` =".$this->id;
        $result=mysqli_query($this->conn,$query);
        if($result) {
            Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Data has been deleted successfully.
</div>");
            header("location:index.php");

        }


        else
        {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Failed!</strong> Data has not been deleted successfully.
</div>");
            header("location:index.php");
        }

    }

    public function trash()
    {
        $query="UPDATE `atomicproject21`.`profilepicture` SET `deleted_at` = '".$this->deleted_at."' WHERE `profilepicture`.`id` =".$this->id;
        $result=mysqli_query($this->conn,$query);
        if($result) {
            Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Data has been trashed successfully.
</div>");
            header("location:index.php");

        }


        else
        {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Failed!</strong> Data has not been trashed successfully.
</div>");
            header("location:index.php");
        }

    }


    public function trashed()
    {
        $allInfo=array();
        $query="SELECT * FROM `profilepicture` WHERE `deleted_at` IS NOT NULL";
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $allInfo[]=$row;
        }
        return $allInfo;

    }




    public function recover()
    {
        $query="UPDATE `atomicproject21`.`profilepicture` SET `deleted_at` = NULL WHERE `profilepicture`.`id` =".$this->id;
        $result=mysqli_query($this->conn,$query);
        if($result) {
            Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Data has been recovered successfully.
</div>");
            header("location:index.php");

        }


        else
        {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Failed!</strong> Data has not been recovered successfully.
</div>");
            header("location:index.php");
        }

    }



    public function recoverMultiple($idS=array())
    {
        if((is_array($idS))&&(count($idS)>0)) {
            $IDs =implode(",",$idS);
            $query = "UPDATE `atomicproject21`.`profilepicture` SET `deleted_at` = NULL WHERE `profilepicture`.`id` IN (" .$IDs.")";
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
        if((is_array($idS))&&(count($idS>0))) {
            $IDs=implode(",",$idS);
            $query = "DELETE FROM `atomicproject21`.`profilepicture` WHERE `profilepicture`.`id` IN (".$IDs.")";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong>Selected data has been deleted successfully.
</div>");
                header("location:index.php");

            } else {
                Message::message("<div class=\"alert alert-danger\">
  <strong>Failed!</strong>Selected data has not been deleted successfully.
</div>");
                header("location:index.php");
            }
        }

    }


    public function count()
    {
        $query="SELECT COUNT(*) AS totalItem FROM `profilepicture` WHERE `deleted_at` IS NULL";
        $result=mysqli_query($this->conn,$query);
        $row=mysqli_fetch_assoc($result);
        return $row["totalItem"];
    }


    public function paginator($pageStartFrom=0,$limit=5)
    {

        $_allInfo=array();
        $query="SELECT * FROM `profilepicture` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$limit;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }

    public function allName(){
        $_allName= array();
        $query="SELECT name FROM `profilepicture`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allName[]=$row['name'];
        }
        return  $_allName;

    }

    public function allDescription(){
        $_allDescription= array();
        $query="SELECT `descriptionwohtml` FROM `profilepicture`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allDescription[]=$row['descriptionwohtml'];
        }
        return  $_allDescription;
    }



}


?>