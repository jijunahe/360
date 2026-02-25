<?php

# Vernam Cipher (One-time pad)
/*
$k1 = '1.key';
$k2 = '2.key';
$d = 'The quick brown fox jumped over the lazy dog';
VernamCipher::createTestKeyFile($k1, 1024);
copy($k1, $k2);
$c1 = new VernamCipher($k1);
$eD = $c1->encryptWithHMAC($d);
echo 'Encrypted: ', bin2hex($eD);
$c2 = new VernamCipher($k2);
echo PHP_EOL, 'Decrypted: ', $c2->decryptWithHMAC($eD);
*/



class VernamCipher
{
    const DEFAULT_HMAC_ALGO = 'sha3-256';
    const DEFAULT_HMAC_KEY_LENGTH = 16;
    const DEFAULT_HMAC_HASH_LENGTH = 32;
    private $keyFilePath;
    private $keyFileHandler;
    private $deferredFtruncate = false;
    private $deferredFtruncatePos;
    private $hmacAlgo = self::DEFAULT_HMAC_ALGO;
    private $hmacKeyLength = self::DEFAULT_HMAC_KEY_LENGTH;
    private $hmacHashLength = self::DEFAULT_HMAC_HASH_LENGTH;

    function __construct(string $keyFilePath, string $hmacAlgo = self::DEFAULT_HMAC_ALGO, int $hmacKeyLength = self::DEFAULT_HMAC_KEY_LENGTH)
    {
        $this->keyFilePath = $keyFilePath;
        $this->openKeyFile();
        
        if($hmacAlgo !== self::DEFAULT_HMAC_ALGO) {
            if(in_array($hmacAlgo, hash_algos())) {
                $this->hmacAlgo = $hmacAlgo;
                $this->hmacHashLength = strlen(hash($this->hmacAlgo, '', true));
            }
            else {
                $this->hmacAlgo = self::DEFAULT_HMAC_ALGO;
                $this->hmacHashLength = self::DEFAULT_HMAC_HASH_LENGTH;
            }
        }
        
        if($hmacKeyLength !== self::DEFAULT_HMAC_KEY_LENGTH) {
            $this->hmacKeyLength = $hmacKeyLength;
        }
    }
    public function encryptWithHMAC(string $data)
    {
        $hmacKey = $this->getBytes($this->hmacKeyLength);
        $encData = $this->encrypt($data);
        $dataHmac = $this->hashHmac($encData, $hmacKey);
        
        return $dataHmac.$encData;
    }
    public function decryptWithHMAC(string $data)
    {
        $dataLength = strlen($data);

        if($dataLength < $this->hmacHashLength)
            throw new Exception('data length '.$dataLength.' < hmac length '. $this->hmacHashLength);
        
        $dataHmacRemote = substr($data, 0, $this->hmacHashLength);
        $dataOnly = substr($data, $this->hmacHashLength);
        
        $hmacKey = $this->getBytes($this->hmacKeyLength, false);
        $dataHmacLocal = $this->hashHmac($dataOnly, $hmacKey);
        
        if(hash_equals($dataHmacLocal, $dataHmacRemote) === false)
            throw new Exception('Hashes not equals, remote: '.bin2hex($dataHmacRemote).' local:'. bin2hex($dataHmacLocal));
    
        $this->deferredFtruncate();

        return $this->encrypt($dataOnly);
    }
    public function encrypt(string $data) : string
    {
        $dataLength = strlen($data);
        $bytes = $this->getBytes($dataLength);
        for($i=0;$i<$dataLength;$i++)
            $data{$i} = $data{$i} ^ $bytes{$i};
        
        return $data;
    }
    public function decrypt(string $data) : string
    {
        return $this->encrypt($data);
    }
    private function hashHmac($data, $key)
    {
        return hash_hmac($this->hmacAlgo, $data, $key, true);
    }
    # Don't use in production. You must use true random number generator.
    public static function createTestKeyFile(string $filePath, int $size)
    {
        file_put_contents($filePath, random_bytes($size));
    }
    private function deferredFtruncate()
    {
        if(!$this->deferredFtruncate)
            return;
        
        ftruncate($this->keyFileHandler, $this->deferredFtruncatePos);
        $this->deferredFtruncate = false;
    }
    public function getBytes(int $length, $truncateNow = true) : string
    {
        fseek($this->keyFileHandler, 0, SEEK_END);
        $currentPos = ftell($this->keyFileHandler);

        if($currentPos < $length)
            throw new Exception('Not enough key materials, key size: '. $currentPos. ' needed: '.$length);

        fseek($this->keyFileHandler, -$length, SEEK_END);
        $bytes = fread($this->keyFileHandler, $length);
        
        if($truncateNow)
            ftruncate($this->keyFileHandler, $currentPos - $length);
        else {
            $this->deferredFtruncate = true;
            $this->deferredFtruncatePos = $currentPos - $length;
        }

        return $bytes;
    }
    private function openKeyFile()
    {
        if($this->keyFileHandler)
            return;

        if(($this->keyFileHandler = fopen($this->keyFilePath, 'rb+')) === false)
            throw new Exception('Cant open key file: '.$this->keyFilePath);
        
        if(!flock($this->keyFileHandler, LOCK_EX | LOCK_NB))
            throw new Exception('Cant lock key file: '.$this->keyFilePath);
    }
}
?>