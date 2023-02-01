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
        where DoctorArea like '%".$search_area."%' and
        DcotorCategory like '%".$search_category."%' ";

$result= $conn->query($sql);

if($result->num_rows > 0){
    
    while($row = $result->fetch_assoc()){
        $doctorid= $row["ID"];
        $doctorname= $row["DoctorName"];
        $doctorinfo= $row["DoctorInfo"];
        $doctorimage= $row["DoctorImage"];

        $doctor_data["DocName"]= $doctorname;
        $doctor_data["DocInfo"]= $doctorinfo;
        $doctor_data["DocImage"]= $doctorimage;

        $data[$doctorId]= $doctor_data;
    }

    $data["Result"]="True";
    $data["Message"]="Doctor data fetched successfully";

}else{
    $data["Result"]="False";
    $data["Message"]="No Doctors found";
}

}else{
    $data["Result"] = "False";
    $data["Message"]= "Bad Query";
}


// Sending response back to the request
echo json_encode($data, JSON_UNESCAPED_SLASHES);


?>