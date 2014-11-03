<?php
define("MODULE_ADMIN_REQUIRED_PERMISSION", "kundenbereich_upload");
define("MODULE_ADMIN_HEADLINE", "Kundenbereich");
?>

<?php
function customer_list(){

    $users = getUsers();
echo "<ol>";
     for($i = 0; $i < count($users); $i++){
         $data = getUserByName($users[$i]);
         echo "<li>" . 
         '<a href="index.php?action=module_settings&module=kundenbereich&user=' . $data["id"] . '">' . $data["username"] . "</a></li>";
         }


}

function kundenbereich_admin(){

if(isset($_REQUEST["user"])){

} else{

  customer_list();
}
    
     }

?>
