<?php
declare (strict_types=1);
namespace MailPoetVendor\Doctrine\ORM\Exception;
if (!defined('ABSPATH')) exit;
use function sprintf;
final class MissingIdentifierField extends ORMException implements ManagerException
{
 public static function fromFieldAndClass(string $fieldName, string $className) : self
 {
 return new self(sprintf('The identifier %s is missing for a query of %s', $fieldName, $className));
 }
}