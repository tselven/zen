    <?php
    use Core\Controller;
    class AdminController extends Controller{
        function index(){
            $this->view('Admin/index');
        }
        function login(){
            $this->view('Admin/login');
        }
    }