    <?php
    use Core\Controller;
    use Models\users;
    class UsersController extends Controller{
        function index(){
            $users = new users();
            $res = $users->get();
            echo $this->JSON($res);
        }
    }