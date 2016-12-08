<?php
namespace App\Bitm\SEIP123473\Hobby;
use App\Bitm\SEIP123473\Message\Message;

class Hobby
{
    public $id="";
    public $firstname="";
    public $lastname="";
    public $hobby="";
    public $description;
    public $descriptionwohtml;
    public $filterByFirstname="";
    public $filterByLastname="";
    public $filterByHobby="";
    public $search="";
    public $conn="";
    public $deleted_at;


    public function prepare($data=array())
    {
        if( array_key_exists("fname",$data))
        {
            $this->firstname=filter_var($data["fname"],FILTER_SANITIZE_STRING);
        }
        if (array_key_exists("lname",$data))
        {
            $this->lastname=filter_var($data["lname"],FILTER_SANITIZE_STRING);
        }
        if (array_key_exists("Hobby",$data))
        {
            $this->hobby=filter_var($data["Hobby"],FILTER_SANITIZE_STRING);
        }
        if(array_key_exists("description",$data)){
            $this->description= $data['description'];
        }
        if (array_key_exists("description", $data)) {
            $this->descriptionwohtml = strip_tags($data['description']);
        }
        if (array_key_exists("filterByFirstname", $data)) {
            //echo !empty($data['filterByName']);
            //die();
            $this->filterByFirstname = $data['filterByFirstname'];
            //echo !empty($this->filterByName);
            //die();
        }
        if (array_key_exists("filterByLastname", $data)) {
            //echo !empty($data['filterByName']);
            //die();
            $this->filterByLastname = $data['filterByLastname'];
            //echo !empty($this->filterByName);
            //die();
        }
        if (array_key_exists("filterByHobby", $data)) {
            $this->filterByHobby = $data['filterByHobby'];
            //Utility::dd($this->filterByCity);
            //die();
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
        $this->conn=mysqli_connect("localhost","root","","atomicproject21") or die("Data is not connected");
    }


    public function store()
    {
        $query="INSERT INTO `atomicproject21`.`hobby` ( `firstname`, `lastname`, `hobby`, `description`, `descriptionwohtml`) VALUES ( '".$this->firstname."', '".$this->lastname."', '".$this->hobby."', '".$this->description."', '".$this->descriptionwohtml."')";
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
        if(!empty($this->filterByFirstname)){
            $whereClause.=" AND firstname LIKE '%".$this->filterByFirstname."%'";
        }
        if(!empty($this->filterByLastname)){
            $whereClause.=" AND lastname LIKE '%".$this->filterByLastname."%'";
        }
        if(!empty($this->filterByHobby)){
            $whereClause.=" AND hobby LIKE '%".$this->filterByHobby."%'";
        }

        if(!empty($this->description)){
            $whereClause.=" AND description LIKE '%".$this->description."%'";
        }
        if(!empty($this->search)){
            $whereClause .= " AND description LIKE '%".$this->search."%' OR  firstname LIKE '%".$this->search."%' OR  lastname LIKE '%".$this->search."%' OR  hobby LIKE '%".$this->search."%'";
        }
        $allinfo=array();
        $query="SELECT * FROM `hobby` WHERE `deleted_at`IS NULL AND ". $whereClause;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $allinfo[]=$row;
        }
        return $allinfo;


    }


    public function view()
    {
        $qurey="SELECT * FROM `hobby` WHERE `id`=".$this->id;
        $result=mysqli_query($this->conn,$qurey);
        $row=mysqli_fetch_assoc($result);
        return $row;
    }


    public function update()
    {
        $query="UPDATE `atomicproject21`.`hobby` SET `firstname` = 'f".$this->firstname."', `lastname` = '".$this->lastname."', `hobby` = '".$this->hobby."', `description` = '".$this->description."', `descriptionwohtml` = '".$this->descriptionwohtml."' WHERE `hobby`.`id` =".$this->id ;;
        $result=mysqli_query($this->conn,$query);
        if($result) {
            Message::message("<div class=\"alert alert-success\">
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
        $query="DELETE FROM `atomicproject21`.`hobby` WHERE `hobby`.`id` = ".$this->id;
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
        $query="UPDATE `atomicproject21`.`hobby` SET `deleted_at` = '".$this->deleted_at."' WHERE `hobby`.`id`  = ".$this->id;
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
        $allhobby=array();
        $query="SELECT * FROM `hobby` WHERE `deleted_at` IS NOT NULL";
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $allhobby[]=$row;
        }
        return $allhobby;

    }




    public function recover()
    {
        $query="UPDATE `atomicproject21`.`hobby` SET `deleted_at`= NULL WHERE `hobby`.`id` = ".$this->id;
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
            $query = "UPDATE `atomicproject21`.`hobby` SET `deleted_at` = NULL WHERE `hobby`.`id` IN (" .$IDs.")";
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
            $query = "DELETE FROM `atomicproject21`.`hobby` WHERE `hobby`.`id` IN (".$IDs.")";
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
        $query="SELECT COUNT(*) AS totalItem FROM `hobby` WHERE `deleted_at` IS NULL";
        $result=mysqli_query($this->conn,$query);
        $row=mysqli_fetch_assoc($result);
        return $row["totalItem"];
    }


    public function paginator($pageStartFrom=0,$limit=5)
    {

        $_allInfo=array();
        $query="SELECT * FROM `hobby` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$limit;
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }

    public function allFirstname(){
        $_allInfo= array();
        $query="SELECT firstname FROM `hobby`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allInfo[]=$row['firstname'];
        }
        return $_allInfo;

    }
    public function allLastname(){
        $_allInfo= array();
        $query="SELECT lastname FROM `hobby`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allInfo[]=$row['lastname'];
        }
        return $_allInfo;

    }
    public function allHobby(){
        $_allInfo= array();
        $query="SELECT hobby FROM `hobby`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allInfo[]=$row['hobby'];
        }
        return $_allInfo;

    }

    public function allDescription(){
        $_allDescription= array();
        $query="SELECT `descriptionwohtml` FROM `hobby`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allDescription[]=$row['descriptionwohtml'];
        }
        return  $_allDescription;
    }





}