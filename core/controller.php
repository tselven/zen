<?php

namespace Core;

use Config\Config;

class Controller
{
    /**
     * Render a view file with data.
     * 
     * @param string $viewPath The path of the view file
     * @param array $data The data array to be rendered.
     * @return string view that rendered.
     */
    public static function view($viewPath, $data = [])
    {
        extract($data);
        $view = Config::$root_path . "/views/{$viewPath}View.php";
        if (file_exists($view)) {
            ob_start();
            $content = file_get_contents($view);
            include Config::$root_path."/"."views/views.php";
            include $view;
            $content = ob_get_clean();
            header("Content-Type: text/html ");
            echo $content;
        } else {
            Controller::error("404");
        }
    }
    /**
     * Convert array to JSON and return to browser
     * @param array $data - Data that wat to convert
     */
    function JSON($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    public static function Image($img)
    {
        return Config::$root_url . "/image/{$img}";
    }
    /**
     * return the error view.
     * @param string $name - name of the file
     */
    public static function error($name)
    {
        header("Content-Type: text/html; charset=UTF-8");
        $page = Config::$root_path."/views/Errors/{$name}View.php";
        if(file_exists($page)){
            include $page;
        }
        else{

        }
    }
    function upload_file($file, $path)
    {
        // Check if file was uploaded without errors
        if (isset($_FILES[$file]) && $_FILES[$file]['error'] === UPLOAD_ERR_OK) {
            // File information
            $fileTmpPath = $_FILES[$file]['tmp_name'];
            $fileName = $_FILES[$file]['name'];
            $fileSize = $_FILES[$file]['size'];
            $fileType = $_FILES[$file]['type'];

            // Specify the directory where you want to store uploaded files
            $uploadDirectory = $_ENV['ROOT_DIR'] . '/assets' . $path;

            // Move the uploaded file to the specified directory
            $destPath = $uploadDirectory . $fileName;
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                echo "File $fileName uploaded successfully.";
            } else {
                echo "File upload failed!";
            }
        } else {
            echo "File upload error occurred.";
        }
    }


    /**
     * convert markdown to html
     * @param string $markdown  Markdown text
     * @return string  HTML string
     */
    function markdown($markdown)
    {
        // Convert headings
        $markdown = preg_replace('/^#\s+(.*)$/m', '<h1>$1</h1>', $markdown);
        $markdown = preg_replace('/^##\s+(.*)$/m', '<h2>$1</h2>', $markdown);
        $markdown = preg_replace('/^###\s+(.*)$/m', '<h3>$1</h3>', $markdown);
        $markdown = preg_replace('/^####\s+(.*)$/m', '<h4>$1</h4>', $markdown);
        $markdown = preg_replace('/^#####\s+(.*)$/m', '<h5>$1</h5>', $markdown);
        $markdown = preg_replace('/^######\s+(.*)$/m', '<h6>$1</h6>', $markdown);

        // Convert bold
        $markdown = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $markdown);
        $markdown = preg_replace('/\_\_(.*?)\_\_/s', '<strong>$1</strong>', $markdown);

        // Convert italic
        $markdown = preg_replace('/\*(.*?)\*/s', '<em>$1</em>', $markdown);
        $markdown = preg_replace('/\_(.*?)\_/s', '<em>$1</em>', $markdown);

        // Convert inline code
        $markdown = preg_replace('/`(.*?)`/s', '<code>$1</code>', $markdown);

        // Convert paragraphs
        $markdown = "<p>" . preg_replace('/\R{2,}/s', '</p><p>', $markdown) . "</p>";

        // Convert images
        $markdown = preg_replace('/!\[(.*?)\]\((.*?)\)/', '<img src="$2" alt="$1">', $markdown);

        // Convert lists
        $markdown = preg_replace('/^\*\s+(.*)$/m', '<li>$1</li>', $markdown);
        $markdown = preg_replace('/^(\s*)\*\s+(.*)$/m', '<ul><li>$2</li></ul>', $markdown);

        // Convert tables
        $markdown = preg_replace_callback('/\|(.+?)\|/', function ($matches) {
            $cells = explode('|', $matches[1]);
            $rowHtml = '';
            foreach ($cells as $cell) {
                $rowHtml .= '<td>' . trim($cell) . '</td>';
            }
            return '<tr>' . $rowHtml . '</tr>';
        }, $markdown);
        $markdown = preg_replace('/^.*$/m', '<table>$0</table>', $markdown);

        return $markdown;
    }
}
