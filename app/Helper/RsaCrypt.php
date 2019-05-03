
<?php

class RsaCrypt {

    /**
     * encrypt with public key
     * @param $data;
     * @param $rsakeypath
     */
    public static function encryptPublic($data, $content) {
        //$content = self::getContent($rsakeypath); 
        if ($content) {
            $pem = self::transJavaRsaKeyToPhpOpenSSL($content);
            $pem = self::appendFlags($pem, true);
            $res = openssl_pkey_get_public($pem); 
            if ($res) {
                $opt = openssl_public_encrypt($data, $result, $res);
                $result =  base64_encode($result);
                if ($opt) {
                    return $result;
                }
            }
        }
        return false;
    }

    /**
     * decrypt with private key
     * @param $data
     * @param $rsakeypath
     */
    public static function decryptPrivate($data, $content) {
        //$content = self::getContent($rsakeypath);    
        if ($content) {
            $pem = self::transJavaRsaKeyToPhpOpenSSL($content);
            $pem = self::appendFlags($pem, false);
            $res = openssl_pkey_get_private($pem);
            if ($res) {
                $opt = openssl_private_decrypt($data, $result, $res);
                if ($opt) {
                    return $result;
                }
            }
        }
        return false;
    }

    /**
     * get content forom file
     * @param $filepath
     * @return $content
     */
    private static function getContent($filepath) {
        if (is_file($filepath)) {
            $content = file_get_contents($filepath);
            return strtr($content, array(
                "\r\n" => "",
                "\r" => "",
                "\n" => "",
            ));
        }
        return false;
    }

    /**
     * trans java's rsa key format to php openssl can read
     * @param $content
     * @return string
     */
    private static function transJavaRsaKeyToPhpOpenSSL($content) {
        if ($content) {
            return trim(chunk_split($content, 64, "\n"));
        } 
        return false;
    }

    /**
     * append Falgs to content
     * @param $content
     * @param $isPublic
     * @return string
     */
    private static function appendFlags($content, $isPublic = true) {
        if ($isPublic) {
            return "-----BEGIN PUBLIC KEY-----\n" . $content . "\n-----END PUBLIC KEY-----\n";
        } 
        else {
            return "-----BEGIN PRIVATE KEY-----\n" . $content . "\n-----END PRIVATE KEY-----\n";
        }
    }
}