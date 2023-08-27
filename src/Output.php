<?php 
namespace NanoBlockTech\Stamp;
class Output {
    /** 
    * Hold stamp container gd image container
    * @var resource $image
    */
    private $image;

     /** 
    * Hold stamp class version
    * @var string $version
    */
    private $version = "";


    /** 
    * Initialize stamp output class instance
    * @param resource $image
    * @param string $version
    */
    public function __construct($image, $version) {
        $this->image = $image;
        $this->version = $version;
    }

    /** 
    * Save stamp generated image
    * @param string $filepath
    */
    public function saveImage($filepath) {
        imagepng($this->image, $filepath);
    }
    
    /** 
    * Display stamp generated image in browser
    */
    public function showImage() {
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: public, must-revalidate, max-age=0');
        //header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/png');
        imagepng($this->image);
    }

    /** 
    * Download stamp generated image
    * @param string $filepath to extract name
    */
    public function downloadImage($filepath) {
        header('Content-Description: File Transfer');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: public, must-revalidate, max-age=0');
        header('Pragma: public');
        header('X-Generator: nanoStamp ' . $this->version);
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Content-Type: image/png');

        if (!isset($_SERVER['HTTP_ACCEPT_ENCODING']) || empty($_SERVER['HTTP_ACCEPT_ENCODING'])) {
            header('Content-Length: ' . strlen($this->image));
        }
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        imagepng($this->image);
    }

    /** 
    * Create stamp generated image
    * @param string $filepath 
    * @param string $flag D = Download, S = Save, I = Display 
    */
    public function create($filepath, $flag = "I"){
        if($flag == "D"){
            $this->downloadImage($filepath);
        }else if($flag == "S"){
            $this->saveImage($filepath);
        }else{
            $this->showImage();
        }
    }
}