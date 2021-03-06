<?php

namespace Minter\SDK\MinterCoins;

use Minter\Contracts\MinterTxInterface;
use Minter\Library\Helper;
use Minter\SDK\MinterConverter;

/**
 * Class MinterMintTokenTx
 * @package Minter\SDK\MinterCoins
 */
class MinterMintTokenTx extends MinterCoinTx implements MinterTxInterface
{
    public $coin;
    public $value;

    const TYPE = 28;

    /**
     * MinterMintTokenTx constructor.
     * @param $coin
     * @param $value
     */
    public function __construct($coin, $value)
    {
        $this->coin  = $coin;
        $this->value = $value;
    }

    /**
     * Prepare data for signing
     *
     * @return array
     */
    public function encodeData(): array
    {
        return [
            $this->coin,
            MinterConverter::convertToPip($this->value)
        ];
    }

    public function decodeData()
    {
        $this->coin  = hexdec($this->coin);
        $this->value = MinterConverter::convertToBase(Helper::hexDecode($this->value));
    }
}