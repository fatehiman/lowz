<?php

namespace App\Services;

/**
 * Random but fair choice between items that each have a use count and a
 * last-used time (article subjects, products to link).
 *
 *   1. Cooldown: the C most recently used items are skipped, C = min(maxCooldown, floor(n / 4)),
 *      so the same item never comes back day after day.
 *   2. Every other item gets a share of a uniform chance: (1 - λ) / eligible.
 *   3. Items more than 5% below the average count ("behind") share the rest, λ = 0.35,
 *      in proportion to how far behind they are.
 *
 * So a new item is picked more often until it catches up (the λ part), but the
 * old items keep being picked too (the uniform part), and the cooldown stops
 * one new item from filling a whole month. Once all counts are within ~10% of
 * each other, the choice is almost uniform.
 */
class FairRotation
{
    public const CATCH_UP_SHARE = 0.35;

    public const TOLERANCE = 0.95;

    /**
     * @param  array<int|string, array{count: int, last: ?int}>  $items  key => [use count, last-used unix time or null]
     * @return array<int|string, float> key => probability (only eligible items)
     */
    public static function probabilities(array $items, int $maxCooldown = 5): array
    {
        if (! $items) {
            return [];
        }

        $n = count($items);
        $cooldown = min($maxCooldown, intdiv($n, 4));

        $recent = array_filter($items, fn ($i) => $i['last'] !== null);
        uasort($recent, fn ($a, $b) => $b['last'] <=> $a['last']);
        $eligible = array_diff_key($items, array_slice($recent, 0, $cooldown, true));

        $avg = array_sum(array_column($items, 'count')) / $n;
        $deficit = array_map(fn ($i) => max(0.0, self::TOLERANCE * $avg - $i['count']), $eligible);
        $totalDeficit = array_sum($deficit);

        $lambda = $totalDeficit > 0 ? self::CATCH_UP_SHARE : 0.0;
        $uniform = (1 - $lambda) / count($eligible);

        return array_map(
            fn ($d) => $uniform + ($totalDeficit > 0 ? $lambda * $d / $totalDeficit : 0.0),
            $deficit
        );
    }

    /**
     * @param  array<int|string, array{count: int, last: ?int}>  $items
     */
    public static function pick(array $items, int $maxCooldown = 5): int|string|null
    {
        $probabilities = self::probabilities($items, $maxCooldown);
        if (! $probabilities) {
            return null;
        }

        $roll = mt_rand() / mt_getrandmax();
        foreach ($probabilities as $key => $p) {
            $roll -= $p;
            if ($roll <= 0) {
                return $key;
            }
        }

        return array_key_last($probabilities);
    }
}
