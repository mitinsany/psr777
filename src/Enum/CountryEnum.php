<?php

namespace App\Enum;

enum CountryEnum
{
    case AT;
    case BE;
    case BG;
    case CY;
    case CZ;
    case DE;
    case DK;
    case EE;
    case ES;
    case FI;
    case FR;
    case GR;
    case HR;
    case HU;
    case IE;
    case IT;
    case LT;
    case LU;
    case LV;
    case MT;
    case NL;
    case PO;
    case PT;
    case RO;
    case SE;
    case SI;
    case SK;

    public function isAT(): bool
    {
        return $this->name === self::AT->name;
    }

    public function isBE(): bool
    {
        return $this->name === self::BE->name;
    }

    public function isBG(): bool
    {
        return $this->name === self::BG->name;
    }

    public function isCY(): bool
    {
        return $this->name === self::CY->name;
    }

    public function isCZ(): bool
    {
        return $this->name === self::CZ->name;
    }

    public function isDE(): bool
    {
        return $this->name === self::DE->name;
    }

    public function isDK(): bool
    {
        return $this->name === self::DK->name;
    }

    public function isEE(): bool
    {
        return $this->name === self::EE->name;
    }

    public function isES(): bool
    {
        return $this->name === self::ES->name;
    }

    public function isFI(): bool
    {
        return $this->name === self::FI->name;
    }

    public function isFR(): bool
    {
        return $this->name === self::FR->name;
    }

    public function isGR(): bool
    {
        return $this->name === self::GR->name;
    }

    public function isHR(): bool
    {
        return $this->name === self::HR->name;
    }

    public function isHU(): bool
    {
        return $this->name === self::HU->name;
    }

    public function isIE(): bool
    {
        return $this->name === self::IE->name;
    }



    public function isIT(): bool
    {
        return $this->name === self::IT->name;
    }

    public function isLT(): bool
    {
        return $this->name === self::LT->name;
    }

    public function isLU(): bool
    {
        return $this->name === self::LU->name;
    }

    public function isLV(): bool
    {
        return $this->name === self::LV->name;
    }

    public function isPO(): bool
    {
        return $this->name === self::PO->name;
    }

    public function isPT(): bool
    {
        return $this->name === self::PT->name;
    }

    public function isRO(): bool
    {
        return $this->name === self::RO->name;
    }

    public function isSE(): bool
    {
        return $this->name === self::SE->name;
    }

    public function isSI(): bool
    {
        return $this->name === self::SI->name;
    }

    public function isSK(): bool
    {
        return $this->name === self::SK->name;
    }

    public static function fromStringCode(string $code): ?self
    {
        return match ($code) {
            static::AT->name => static::AT,
            static::BE->name => static::BE,
            static::BG->name => static::BG,
            static::CY->name => static::CY,
            static::CZ->name => static::CZ,
            static::DE->name => static::DE,
            static::DK->name => static::DK,
            static::EE->name => static::EE,
            static::ES->name => static::ES,
            static::FI->name => static::FI,
            static::FR->name => static::FR,
            static::GR->name => static::GR,
            static::HR->name => static::HR,
            static::HU->name => static::HU,
            static::IE->name => static::IE,
            static::IT->name => static::IT,
            static::LT->name => static::LT,
            static::LU->name => static::LU,
            static::LV->name => static::LV,
            static::MT->name => static::MT,
            static::NL->name => static::NL,
            static::PO->name => static::PO,
            static::PT->name => static::PT,
            static::RO->name => static::RO,
            static::SE->name => static::SE,
            static::SI->name => static::SI,
            static::SK->name => static::SK,
            default => null,
        };
    }

    public static function isEuropeanCountryCode(string $code): bool
    {
        $countryEnum = self::fromStringCode($code);

        if (!$countryEnum) {
            return false;
        }

        return $countryEnum->isAT()
            || $countryEnum->isBE()
            || $countryEnum->isBG()
            || $countryEnum->isCY()
            || $countryEnum->isCZ()
            || $countryEnum->isDE()
            || $countryEnum->isDK()
            || $countryEnum->isEE()
            || $countryEnum->isES()
            || $countryEnum->isFI()
            || $countryEnum->isFR()
            || $countryEnum->isGR()
            || $countryEnum->isHR()
            || $countryEnum->isHU()
            || $countryEnum->isIE()
            || $countryEnum->isIT()
            || $countryEnum->isLT()
            || $countryEnum->isLU()
            || $countryEnum->isLV()
            || $countryEnum->isPO()
            || $countryEnum->isPT()
            || $countryEnum->isRO()
            || $countryEnum->isSE()
            || $countryEnum->isSI()
            || $countryEnum->isSK();
    }
}
