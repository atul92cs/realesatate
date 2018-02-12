<?php
class DbOperation
{
  private $con;
  function __construct()
  {
    require_once dirname(__FILE__).'/dbconnect.php';
	$db=new DbConnect();
	$this->con=$db->connect();
  }
   function getProjects()
  {
      $stmt=$this->con->prepare("SELECT project_id,project_name,project_city,project_type,possesion_type,project_price,project_address FROM projects WHERE project_prior = 'featured'");
	  $stmt->execute();
	  $stmt->bind_result($id,$name,$city,$type,$possesion,$price,$address);
	  $property=array();
	  while($stmt->fetch())
	  {
	    $temp=array();
		$temp['proId']=$id;
		$temp['Name']=$name;
		$temp['City']=$city;
		$temp['Type']=$type;
		$temp['Possesion']=$possesion;
		$temp['Price']=$price;
		$temp['Address']=$address;
		array_push($property,$temp);
		
	  }
	  return $property;
  }  
   function getProjectsbyCity($city)
    {
		$stmt=$this->con->prepare("SELECT project_id,project_name,project_city,project_type,possesion_type,project_price,project_address FROM projects WHERE project_city=?");
		$stmt->bind_param("s",$city);
		$stmt->execute();
		$stmt->bind_result($id,$name,$city,$type,$possesion,$price,$address);
		$property=array();
		while($stmt->fetch())
		{
			$temp=array();
			$temp['proId']=$id;
		$temp['Name']=$name;
		$temp['City']=$city;
		$temp['Type']=$type;
		$temp['Possesion']=$possesion;
		$temp['Type']=$type;
			$temp['Price']=$price;
		$temp['Address']=$address;
		array_push($property,$temp);
			
		}
		
		 return $property;
	}   
    function getCities()
	{
	
	        $stmt=$this->con->prepare("SELECT DISTINCT project_city FROM projects");
			$stmt->execute();
			$stmt->bind_result($city);
			$cities=array();
			while($stmt->fetch())
			{
				$temp=array();
				$temp['City']=$city;
				array_push($cities,$temp);
			}
			return $cities;
	}
	function getRentables($city)
	{
		$stmt=$this->con->prepare("SELECT project_id,project_name,project_city,project_type,project_price,project_address FROM projects WHERE possesion_type='rental' AND project_city=?");
	    $stmt->bind_param("s",$city);
		$stmt->execute();
		$stmt->bind_result($id,$name,$city,$type,$price,$address);
		$property=array();
		while($stmt->fetch())
		{
			$temp=array();
			$temp['proId']=$id;
		$temp['Name']=$name;
		$temp['City']=$city;
		$temp['Type']=$type;
		
		$temp['Type']=$type;
			$temp['Price']=$price;
		$temp['Address']=$address;
		array_push($property,$temp);
			
		}
		
		 return $property;
	}
	function getSaleables($city)
	{
	  $stmt=$this->con->prepare("SELECT project_id,project_name,project_city,project_type,project_price,project_address FROM projects WHERE possesion_type='sale' AND project_city=?");
	    $stmt->bind_param("s",$city);
		$stmt->execute();
		$stmt->bind_result($id,$name,$city,$type,$price,$address);
		$property=array();
		while($stmt->fetch())
		{
			$temp=array();
			$temp['proId']=$id;
		$temp['Name']=$name;
		$temp['City']=$city;
		$temp['Type']=$type;
		
		$temp['Type']=$type;
			$temp['Price']=$price;
		$temp['Address']=$address;
		array_push($property,$temp);
			
		}
		
		 return $property;
	}
	function getTypes()
	{
		$stmt=$this->con->prepare("SELECT project_name,project_image FROM project_types");
		$stmt->execute();
		$stmt->bind_result($type,$image);
		$type=array();
		while($stmt->fetch())
		{
			$temp=array();
			$temp['type']=$type;
			$temp['image']=$image;
			array_push($type,$temp);
		}
		return $type;
	}
}

?>