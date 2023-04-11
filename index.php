<!-- <?php require("reg.php") ?> -->

<html>
    <head>
        <title>index page</title>
    </head>
    <body>
        <form method="POST" action="" >
            <input type="text" name="username">name<br>
            <input type="password" name="password">password<br>
            <input type="submit" name="submit">
        </form>
        <!-- <p class="error"><php echo @$user->error ?></p>
        <p class="success"><php echo @$user->success ?> </p> -->
    </body>


    <?php
class reg2{
    private $username;
    private $password;
    public $error="";
    public $success="";
    private $storage="json.json";
    private $stored_users;
    private $new_user;//array
    public function __construct($username,$password){
        echo "in constructor".$_POST['username']." ". $_POST['password'];
        $this->username=$username;
        $this->password=$password;
        //json decode------json obj to php obj 2nd parameter as true will return ans as array else anz
        //file_get_contens-----file to string
        $x=file_get_contents($this->storage);
        $this->stored_users=json_decode($x,true);//json obj to php obj
        $this->new_user=[
            "username" => $this->username,
            "password" => $this->password,
        ];
        if($this->checkuser()){
            $this->insertuser();
        }

    }

private function checkuser(){
    if(empty($this->username) || empty($this->password)){
        //$this->error="both are needed";
        return false;

    }
    else{
        return true;
    }
}
private function checkexist(){
    foreach($this->stored_users  as $user){
        if ($user['username']==$this->username){
           // $this->error="existing user";
        return true;
        }
    }
    return false;
}
private function insertuser(){
    if($this->checkexist()==FALSE){
        array_push($this->stored_users,$this->new_user);
        if(file_put_contents($this->storage,json_encode($this->stored_users,JSON_PRETTY_PRINT))){
            // return $this->success="success fully registerd";
            
        }
        // else{
        //     return $this->error="try agin";
        // }
    }
}
}
?>
<?php 
if(isset($_POST["submit"])){
    $user=new reg2($_POST['username'],$_POST['password']);
    //echo "the deatilas".$_POST['username']." ". $_POST['password'];
}
?>


</html>


