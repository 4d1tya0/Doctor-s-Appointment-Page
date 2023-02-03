<?php

$search_category= $_POST["search"];
$search_area= $_POST["area"];


if(isset($_POST["search"]) && isset($_POST["area"])){

//echo $search_category;
//echo $search_area;

//Connect to database
$host= "localhost";
$dbuser= "id20211132_aditya";
$dbpass= "BrgRP|3#(x)!br>8";
$dbname= "id20211132_doctorsdb";

$conn=new mysqli($host, $dbuser, $dbpass, $dbname);

$sql= "SELECT ID, DoctorName, DoctorInfo, DoctorImage from doctors
        where DoctorCategory like '%".$search_category."%' and 
         DoctorArea like '%".$search_area."%'  ";

$result= $conn->query($sql);

$data='<div class="servicesectiontitle">Doctors found in your area</div>
        <div class="servicesectiontitle">Doctors found in your area</div>';
$doctor_data="";

if($result->num_rows > 0){
    
    while($row = $result->fetch_assoc()){
        $doctorid= $row["ID"];
        $doctorname= $row["DoctorName"];
        $doctorinfo= $row["DoctorInfo"];
        $doctorimage= $row["DoctorImage"];

        $doctor_data=$doctor_data.'<div class="searchdoctorsection">
                                    <b class="searchdoctordesc"
                                      ><p class="how-well-does">'.$doctorinfo.'</p>
                                    </b
                                    ><b class="searchdoctortitle">'.$doctorname.'</b
                                    ><button class="searchdoctorbox" id="searchDoctorBox">
                                      <img class="doctoricon" alt="" src="'.$doctorimage.'" />
                                    </button>
                                  </div>';
    }

    

}else{
    $data='<div class="servicesectiontitle">No Doctor found in your area</div>';
}

}else{
    $data='<div class="servicesectiontitle">Bad Query</div>';
}

$data=$data.$doctor_data;
echo $data;
?>