<?php
declare(strict_types=1);

namespace App\Constants;

class Labels
{
    public const FULLNAME_LABEL = 'fullname';
    public const PERSONAL_ID_LABEL = 'personal_id';
    public const PERSONAL_PHOTO_LABEL = 'personal_photo';

    public const TAXES_LABEL = 'taxes';
    public const PAYMENTS_LABEL = 'payments';
    public const EMPLOYING_LABEL = 'employing';
    public const MEDICINE_LABEL = 'medicine';
    public const OFFENCES_LABEL = 'offences';
    public const CONVICTION_LABEL = 'conviction';
    public const TRAVEL_LABEL = 'travel';

    public static function getLabels()
    {
        return [
            self::FULLNAME_LABEL => 'Full name of person',
            self::PERSONAL_ID_LABEL => 'Personal ID of person',
            self::PERSONAL_PHOTO_LABEL => 'Personal photo',

            self::TAXES_LABEL => 'Taxes',
            self::PAYMENTS_LABEL => 'Other payments',

            self::EMPLOYING_LABEL => 'Employing history',
            self::MEDICINE_LABEL => 'Medicine history',
            self::OFFENCES_LABEL => 'Offences history',
            self::CONVICTION_LABEL => 'Person convictions',
            self::TRAVEL_LABEL => 'Person travels'
        ];
    }
}
