<?php

namespace App\Support;

final class PhoneNumber
{
    public const DISPLAY = '01733 569998';

    public const HREF = 'tel:01733569998';

    public static function normalizeHtml(mixed $html): string
    {
        $html = (string) $html;

        if ($html === '') {
            return '';
        }

        $hrefPlaceholder = '__SMARTFIT_PRIMARY_PHONE_HREF__';

        $normalized = preg_replace(
            '~tel:\s*(?:\+44\s*(?:\(0\)\s*)?|0)?1733[\s.\-]*569[\s.\-]*998~i',
            $hrefPlaceholder,
            $html
        ) ?? $html;

        $normalized = preg_replace(
            '~\+44\s*(?:\(0\)\s*)?1733[\s.\-]*569[\s.\-]*998~i',
            self::DISPLAY,
            $normalized
        ) ?? $normalized;

        $normalized = preg_replace(
            '~(?<!\d)0?1733[\s.\-]*569[\s.\-]*998(?!\d)~',
            self::DISPLAY,
            $normalized
        ) ?? $normalized;

        return str_replace($hrefPlaceholder, self::HREF, $normalized);
    }
}
