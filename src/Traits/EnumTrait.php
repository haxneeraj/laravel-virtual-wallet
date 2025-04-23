<?php 

namespace Haxneeraj\LaravelVirtualWallet\Traits;

use Kongulov\Traits\InteractWithEnum;

/**
 * EnumTrait provides utility methods for working with enums.
 * 
 * This trait uses the InteractWithEnum trait to add functionality for enum manipulation.
 * It also includes a method for validating enum values.
 * 
 * @author Neeraj Saini
 * @email hax-neeraj@outlook.com
 * @github https://github.com/haxneeraj/
 * @linkedin https://www.linkedin.com/in/hax-neeraj/
 */
trait EnumTrait
{
    use InteractWithEnum;

    /**
     * Check if a given value is a valid enum case.
     * 
     * This method iterates through all enum cases and verifies whether the provided
     * value matches any of the case values.
     *
     * @param string $type The value to check against enum cases.
     * @return bool True if the value is a valid enum case, false otherwise.
     */
    public static function isValid(string $type): bool
    {
        foreach (self::cases() as $case) {
            if ($case->value === $type) {
                return true;
            }
        }

        return false;
    }
}
