<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Escaptcha
{
    private $answer = null;
    private $captchaID = 0;

    public function __construct( $params ) {

        $this->captchaID = 'math_captcha_' . $params['id'];

        // Set the captcha result from last generated captcha and unset it from the session
        if ( isset($_SESSION[$this->captchaID]) ) {
            $this->answer = intval($_SESSION[$this->captchaID]);
            unset($_SESSION[$this->captchaID]);
        }

    }

    public function get_html () {

        $font = RESPATH . 'fonts/captcha.ttf';
        $code = '';
        $height = 40; $width = 120; $length = 5;
        $font_size = $height * 0.75; // font size will be 75% of the image height
        $possible = '1234567890';

        for ($i=0; $i<$length; $i++) {
            $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
        }

        $_SESSION[$this->captchaID] = $code;

        $image = imagecreate($width, $height) or trigger_error('Cannot initialize new GD image stream', E_USER_ERROR);

        // Set colors
        $background_color = imagecolorallocate($image, 255, 255, 255);
        $text_color = imagecolorallocate($image, 20, 40, 100);
        $noise_color = imagecolorallocate($image, 100, 120, 180);

        // Generate random dots in background
        for( $i=0; $i<($width*$height)/3; $i++ ) {
            imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
        }

        // Generate random lines in background
        for( $i=0; $i<($width*$height)/200; $i++ ) {
            imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
        }

        // Create textbox and add text
        $textbox = imagettfbbox($font_size, 0, $font, $code) or die('Error in imagettfbbox function');
        $x = ($width - $textbox[4])/2;
        $y = ($height - $textbox[5])/2;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');

        header('Content-Type: image/png');

        imagepng($image);
        imagedestroy($image);
    }

    public function check_captcha ( $answer ) {

        // Check if math captcha has been generated
        if ( $this->answer === null ) {
            return false;
        }

        // Validate captcha
        if ( $this->answer === (int) trim($answer) ) {
            return true;
        }
        else {
            return false;
        }

    }
}
?>