<style>
    .registration {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: blueviolet;
        text-shadow: 0px 2px 2px rgba(255, 255, 255, 0.4); 

    }
</style>

<?php



$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$RegNumber = $_POST['RegNumber'];
$Email = $_POST['Email'];
$Phone = $_POST['Phone'];
$User_address = $_POST['User_address'];
$Department = $_POST['Department'];
$_Year = $_POST['_Year'];
$_Event = $_POST['_Event'];
$College = $_POST['College'];
$City = $_POST['City'];
$AmountRecived = $_POST['AmountRecived'];
$Proof = $_POST['Proof'];



if (!empty($FirstName) || !empty($LastName) || !empty($RegNumber) || !empty($Email) || !empty($Phone) || !empty($User_address) || !empty($Department) || !empty($_year) || !empty($Event) || !empty($College) || !empty($City) || !empty($AmountRecived) || !empty($Proof)) {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "event_management";

    // conection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT Email From register where Email = ? Limit 1";
        $INSERT = "INSERT Into register(FirstName,LastName,RegNumber,Email,Phone,User_address,Department,_Year,_Event,College,City,AmountRecived,Proof)values(?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssssssssss", $FirstName, $LastName, $RegNumber, $Email, $Phone, $User_address, $Department, $_Year, $_Event, $College, $City, $AmountRecived, $Proof);
            $stmt->execute();
            echo "<h1 class='registration'>Your Registration is sucessfully completed.</h1>";
        } else {
            echo "<h1 class='registration'>You already registered.</h1>";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "<h1 class='registration'> All field are required.</h1>";
    die();
}
?>