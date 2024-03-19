<?php

namespace App\Services;

use App\Models\CryptoKey;
use phpseclib3\Crypt\RSA;

class CryptoService
{
    public function generate_keys(): array
    {
        $private = RSA::createKey();
        $public = $private->getPublicKey();

        $privateKeyValues = [
            'private_key' => encrypt(base64_encode($private->toString('PKCS8')), 'AES-256'),
            'public_key' => encrypt(base64_encode($public->toString('PKCS8')), 'AES-256'),
        ];

        return $privateKeyValues;
    }

    public function get_key($userId): ?string
    {
        $key = CryptoKey::where('user_id', $userId)->first();
        if (!$key) {
            return null;
        }

        return $key->public_key;
    }

    public function validate_key($publicKey, $userId): bool
    {
        $savedKey = CryptoKey::where('user_id', $userId)->first();
        if (!$savedKey) {
            return false;
        }

        try {
            $saved_private_key = $savedKey->private_key;
            $private = RSA::loadPrivateKey(base64_decode(decrypt($saved_private_key, 'AES-256')));
            $public = RSA::loadPublicKey(base64_decode(decrypt($publicKey, 'AES-256')));
            return $private->getPublicKey() == $public;

        } catch (\Exception $e) {
            return false;
        }
    }

}