<?php
session_start();
unset ( $_SESSION['empId'] );
unset ( $_SESSION['empFullname'] );
unset ( $_SESSION['posCode'] );
unset ( $_SESSION['posName'] );
unset ( $_SESSION['deptCode'] );
unset ( $_SESSION['deptName'] );
unset ( $_SESSION['currentLat'] );
unset ( $_SESSION['currentLot'] );
unset ( $_SESSION['roleCode'] );
unset ( $_SESSION['roleName'] );
unset ( $_SESSION['adActive'] );
unset ( $_SESSION['branchCode'] );
unset ( $_SESSION['branchName'] );
unset ( $_SESSION['branchLat'] );
unset ( $_SESSION['branchLot'] );
unset ( $_SESSION['camera'] );

session_destroy();
header("Location:index.php");
?>