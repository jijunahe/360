<?php
/**
 * Encrypt Files Class
 * @author devpy
 * @version 1.0
 */
namespace Byte;
 
class Cipher {
 
    protected $cipher;
    protected $key;
    protected $blockSize;
    protected $data;
    private $iv;
    private $mode;
 
    public function __construct( $text = null, $key = null, $bsize = null, $mode = null ){
 
        // -> Default Options
        $this->setData( $text );
        $this->setKey( $key );
        $this->setCipher($bsize);
        $this->setMode( $mode );
        $this->setIV('');
 
 
    }
 
    public function setData( $text_plain ){
 
        if( !empty($text_plain) ){
            $this->data = $text_plain;
        }
 
    }
 
    public function setKey( $key ){
 
        $this->key = $key;
 
    }
 
    public function setMode( $mode ){
 
        switch( $mode ){
 
            case 'ecb':
                $this->mode = MCRYPT_MODE_ECB;
            break;
            case 'cfb':
                $this->mode = MCRYPT_MODE_CFB;
            break;
            case 'cbc':
                $this->mode = MCRYPT_MODE_CBC;
            break;
            case 'nofb':
                $this->mode = MCRYPT_MODE_NOFB;
            break;
            case 'ofb':
                $this->mode = MCRYPT_MODE_OFB;
            break;
            case 'stream':
                $this->mode = MCRYPT_MODE_STREAM;
            break;
            default:
                $this->mode = MCRYPT_MODE_ECB;
 
        }
 
    }
 
    public function setCipher( $blockSize ){
 
        switch( $blockSize ){
 
            case 128:
                $this->cipher = MCRYPT_RIJNDAEL_128;
            break;
            case 192:
                $this->cipher = MCRYPT_RIJNDAEL_192;
            break;
            case 256:
                $this->cipher = MCRYPT_RIJNDAEL_256;
            break;
            default:
                $this->cipher = MCRYPT_RIJNDAEL_128;
 
        }
 
    }
 
    private function getIV(){
 
        if( empty($this->iv) ){
            $this->iv = mcrypt_create_iv( mcrypt_get_iv_size($this->cipher, $this->mode ), MCRYPT_RAND);
        }
 
        return $this->iv;
 
    }
 
    public function setIV( $iv ){
 
        $this->iv = $iv;
 
    }
 
    public function val() {
 
        return ($this->data != null && $this->key != null && $this->cipher != null ) ? true : false;
    }
 
    public function encrypt(){
 
        if( $this->val() ){
 
            return trim(base64_encode(
                mcrypt_encrypt(
                    $this->cipher, $this->key, $this->data, $this->mode, $this->getIV())));
 
        }else{
 
            throw new Exception('[Invalid Options]');
 
        }
 
    }
 
    public function decrypt(){
 
        if( $this->val() ){
 
            return trim(mcrypt_decrypt(
                $this->cipher, $this->key, base64_decode($this->data), $this->mode, $this->getIV()));
 
        }else{
 
            throw new Exception('[Invalid Options]');
 
        }
 
    }
 
    private function generateUniqueKey( $length ){
 
        return substr( md5(uniqid(time())), $length);
 
    }
 
}
?>