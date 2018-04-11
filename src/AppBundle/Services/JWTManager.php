<?php

namespace AppBundle\Services;


use Lcobucci\JWT\Builder as JWTBuilder;
use Lcobucci\JWT\Parser as JWTParser;
use Lcobucci\JWT\Signer\Hmac\Sha256 as JWTSha256;
use AppBundle\Entity\User;
use Lcobucci\JWT\ValidationData;

/**
 * Description of JWTManager
 * 
 * @author Samuel
 */
class JWTManager
{
    /*
    How to use
    get the service
    $jwt = $this->container->get('app.jwt_manager'); 
    $token = $jwt->createToken($user);
    $jwt->validateToken($token);

    DO NOT MODIFY the "secret keys" when the app is running in production
    unless you know what you are doing because it will cause that every 
    api-client get lost their current api-session */
    private CONST SECRET_KEY = "syMfony1sStR0ngGg!";
    private CONST PARAMS_SECRET_KEY = "Surf4c1ngSl!pkn0t#";
    private CONST EXPIRATION_TIME = 3600;
    private $signer;

    public function __construct() 
    {
        $this->signer = new JWTSha256();
    }

    public function createToken(User $user)
    {
        $creat_time = time();
        $exp_time   = $creat_time + self::EXPIRATION_TIME;

        $scms       = $this->createSCMS($creat_time, $exp_time);
        $token_id   = $this->createTokenId($user->getUsername(), $creat_time);

        $token      = (new JWTBuilder())
            //->setIssuer('http://example.com') // Configures the issuer (iss claim)
            //->setAudience('http://example.org') // Configures the audience (aud claim)
            //->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
            ->setId($token_id, true) // Configures the id (jti claim), replicating as a header item
            ->setIssuedAt($creat_time) // Configures the time that the token was issue (iat claim)
            ->setExpiration($exp_time) // Configures the expiration time of the token (exp claim)
            ->set('uid', $user->getId()) // Configures a new claim / param, called "uid"
            ->set('uname', $user->getUsername()) // Configures a new claim / param, called "uname"
            ->set('scms', $scms) // Configures a new claim / param, called "uname"
            ->sign($this->signer, self::SECRET_KEY) // creates a signature using "SECRET_KEY" as key
            ->getToken(); // Retrieves the generated token
        return (string) $token;
    }

    public function validateToken($str_token)
    {
        try {
            // trying to parse the string into a JWT token php object
            $token = (new JWTParser())->parse((string) $str_token);
            $valid = $token->verify($this->signer, self::SECRET_KEY);

            if ($valid) {
                $token_id       = $token->getHeader('jti');
                $created        = $token->getClaim('iat');
                $expiration     = $token->getClaim('exp');
                $username       = $token->getClaim('uname');
                $scms           = $token->getClaim('scms');
                $check_scms     = $this->createSCMS($created, $expiration);
                $check_token_id = $this->createTokenId($username, $created);
                $data           = new ValidationData();
                $data->setId($check_token_id);

                if ($token->validate($data) && ($scms == $check_scms) && ($token_id == $check_token_id)){
                    return true;
                }
            }
        } catch (\Exception $e) {
            // error en el JWT
            return false;
        }
        return false;
    }

    private function createSCMS($created, $expiration) {
        $hashed_creat_time = hash_hmac("md2", $created, self::PARAMS_SECRET_KEY);
        $hashed_exp_time   = hash_hmac("md2", $expiration, self::PARAMS_SECRET_KEY);
        $scms = $hashed_creat_time . $hashed_exp_time;
        return (hash_hmac("md5", $scms, self::SECRET_KEY));
    }

    private function createTokenId($username, $created) {
        return hash_hmac($this->signer->getAlgorithm(), $username . $created, self::SECRET_KEY);
    }

}