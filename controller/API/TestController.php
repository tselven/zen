    <?php
    use Core\Controller;
    use Core\Scripts;
    class TestController extends Controller{
        function run(){
            $cmd = new Scripts;
            $res = $cmd->run('test.py');
            return $this->json($res);
        }
    }