<?php declare(strict_types = 1);

namespace MailPoet\EmailEditor\Integrations\Core\Renderer\Blocks;

if (!defined('ABSPATH')) exit;


use MailPoet\EmailEditor\Engine\Renderer\BlockRenderer;
use MailPoet\EmailEditor\Engine\SettingsController;
use MailPoet\Util\Helpers;

class Heading implements BlockRenderer {
  public function render(string $blockContent, array $parsedBlock, SettingsController $settingsController): string {
    $level = $parsedBlock['attrs']['level'] ?? 2; // default level is 2
    $blockContent = $this->removePaddingFromElement($blockContent, ['tag_name' => "h{$level}"]);
    return str_replace('{heading_content}', $blockContent, $this->getBlockWrapper($parsedBlock, $settingsController));
  }

  /**
   * Based on MJML <mj-text>
   */
  private function getBlockWrapper(array $parsedBlock, SettingsController $settingsController): string {
    $contentStyles = $settingsController->getEmailContentStyles();
    $availableStylesheets = $settingsController->getAvailableStylesheets();

    // Styles for padding need to be set on the wrapping table cell due to support in Outlook
    $paddingBottom = $parsedBlock['attrs']['style']['spacing']['padding']['bottom'] ?? '0px';
    $paddingLeft = $parsedBlock['attrs']['style']['spacing']['padding']['left'] ?? '0px';
    $paddingRight = $parsedBlock['attrs']['style']['spacing']['padding']['right'] ?? '0px';
    $paddingTop = $parsedBlock['attrs']['style']['spacing']['padding']['top'] ?? '0px';

    $styles = [
      'min-width' => '100%', // prevent Gmail App from shrinking the table on mobile devices
      'padding-bottom' => $paddingBottom,
      'padding-left' => $paddingLeft,
      'padding-right' => $paddingRight,
      'padding-top' => $paddingTop,
    ];

    foreach ($parsedBlock['email_attrs'] ?? [] as $property => $value) {
      if ($property === 'width') continue; // width is handled by the wrapping blocks (columns, column)
      $styles[$property] = $value;
    }

    if (!isset($styles['font-size'])) {
      $styles['font-size'] = $contentStyles['typography']['fontSize'];
    }
    if (!isset($styles['font-family'])) {
      $styles['font-family'] = $contentStyles['typography']['fontFamily'];
    }

    $styles = array_merge($styles, $this->fetchStylesFromBlockAttrs($availableStylesheets, $parsedBlock['attrs']));

    return '
      <table
        role="presentation"
        border="0"
        cellpadding="0"
        cellspacing="0"
        style="min-width: 100%;"
        width="100%"
      >
        <tr>
          <td style="' . $settingsController->convertStylesToString($styles) . '">
            {heading_content}
          </td>
        </tr>
      </table>
    ';
  }

  private function fetchStylesFromBlockAttrs(?string $availableStylesheets, array $attrs = []): array {
    $styles = [];

    $supportedValues = ['textAlign'];

    foreach ($supportedValues as $supportedValue) {
      if (array_key_exists($supportedValue, $attrs)) {
        $styles[Helpers::camelCaseToKebabCase($supportedValue)] = $attrs[$supportedValue];
      }
    }

    // using custom rules because colors do not automatically resolve to hex value
    $supportedColorValues = ['backgroundColor', 'textColor'];
    foreach ($supportedColorValues as $supportedColorValue) {
      if (array_key_exists($supportedColorValue, $attrs)) {
        $colorKey = $attrs[$supportedColorValue];

        $cssString = $availableStylesheets ?? '';

        $colorRegex = "/--wp--preset--color--$colorKey: (#[0-9a-fA-F]{6});/";

        // fetch color hex from available stylesheets
        preg_match($colorRegex, $cssString, $colorMatch);

        $colorValue = '';
        if ($colorMatch) {
          $colorValue = $colorMatch[1];
        }

        if ($supportedColorValue === 'textColor') {
          $styles['color'] = $colorValue; // use color instead of textColor. textColor not valid CSS property
        } else {
          $styles[Helpers::camelCaseToKebabCase($supportedColorValue)] = $colorValue;
        }

      }
    }

    // fetch Block Style Typography e.g., fontStyle, fontWeight, etc
    if (isset($attrs['style']['typography'])) {
      $blockStyleTypographyKeys = array_keys($attrs['style']['typography']);
      foreach ($blockStyleTypographyKeys as $blockStyleTypographyKey) {
        $styles[Helpers::camelCaseToKebabCase($blockStyleTypographyKey)] = $attrs['style']['typography'][$blockStyleTypographyKey];
      }
    }

    return $styles;
  }

  /**
   * @param array{tag_name: string, class_name?: string} $tag
   */
  private function removePaddingFromElement($blockContent, array $tag): string {
    $html = new \WP_HTML_Tag_Processor($blockContent);
    if ($html->next_tag($tag)) {
      $elementStyle = $html->get_attribute('style') ?? '';
      $elementStyle = preg_replace('/padding.*:.?[0-9]+px;?/', '', $elementStyle);
      $html->set_attribute('style', $elementStyle);
      $blockContent = $html->get_updated_html();
    }

    return $blockContent;
  }
}
