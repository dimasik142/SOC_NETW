<?php
$connect = oci_connect("system", "ivanov", "localhost/xe");
if (!$connect){
    echo "Невозможно подключится к базе: " . var_dump( OCIError() );
    die();
}

$email = 'dimasik142@epages.su';
$pass = 'asdasd';
$var1 = 2;
$var2 = "Scott12222221";
$var3 = "Scott1";

$sql1 = "insert into USERS (EMAIL, PASSWORD) values ('".$var2."', '".$var3."')";
$s1 = oci_parse($connect, $sql1);
oci_execute ($s1, OCI_DEFAULT);

oci_commit($connect);
oci_close($connect);


$connect = $this->connection();
$sqlQuery = $this->makeSelectString(
    'users_data',
    [
        'NAME' => 'user_id',
        'VALUE' => $id
    ],
    '*'
);
$stid = oci_parse($connect, $sqlQuery);
$r = oci_execute($stid);
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    return $row;
}
OCICommit($connect);