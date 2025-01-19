    <?php

    use Core\Controller;
    use Core\Authenticate;
    class AuthController extends Controller{
        function login(){
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $auth = new Authenticate;
            $res = $auth->login($user,$pass);
            if($res != false){
                header("Location: /admin");
            }else{
                $_SESSION['errors'] = false;
                header("Location: /login");

            }
        }
        
    }