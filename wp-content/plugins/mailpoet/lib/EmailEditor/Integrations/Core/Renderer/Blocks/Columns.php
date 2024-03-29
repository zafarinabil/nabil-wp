<?php declare(strict_types = 1);

namespace MailPoet\EmailEditor\Integrations\Core\Renderer\Blocks;

if (!defined('ABSPATH')) exit;


use MailPoet\EmailEditor\Engine\Renderer\BlockRenderer;
use MailPoet\EmailEditor\Engine\SettingsController;

class Columns implements BlockRenderer {
  public function render(string $blockContent, array $parsedBlock, SettingsController $settingsController): string {
    $content = '';
    foreach ($parsedBlock['innerBlocks'] ?? [] as $block) {
      $content .= render_block($block);
    }

    return str_replace(
      '{columns_content}',
      $content,
      $this->getBlockWrapper($parsedBlock, $settingsController)
    );
  }

  /**
   * Based on MJML <mj-section>
   */
  private function getBlockWrapper(array $parsedBlock, SettingsController $settingsController): string {
    $width = $parsedBlock['email_attrs']['width'] ?? $settingsController->getLayoutWidthWithoutPadding();
    $backgroundColor = $parsedBlock['attrs']['style']['color']['background'] ?? 'none';
    $paddingBottom = $parsedBlock['attrs']['style']['spacing']['padding']['bottom'] ?? '0px';
    $paddingLeft = $parsedBlock['attrs']['style']['spacing']['padding']['left'] ?? '0px';
    $paddingRight = $parsedBlock['attrs']['style']['spacing']['padding']['right'] ?? '0px';
    $paddingTop = $parsedBlock['attrs']['style']['spacing']['padding']['top'] ?? '0px';

    $align = $parsedBlock['attrs']['align'] ?? null;
    if ($align !== 'full') {
      $layoutPaddingLeft = $settingsController->getEmailLayoutStyles()['padding']['left'];
      $layoutPaddingRight = $settingsController->getEmailLayoutStyles()['padding']['right'];
    } else {
      $layoutPaddingLeft = '0px';
      $layoutPaddingRight = '0px';
    }

    return '
      <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" style="width:' . $width . ';" width="' . $width . '" bgcolor="' . $backgroundColor . '" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
      <div style="background:' . $backgroundColor . ';background-color:' . $backgroundColor . ';margin:0px auto;max-width:' . $width . ';padding-left:' . $layoutPaddingLeft . ';padding-right:' . $layoutPaddingRight . ';">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:' . $backgroundColor . ';background-color:' . $backgroundColor . ';max-width:' . $width . ';width:100%;">
          <tbody>
            <tr>
              <td style="font-size:0px;padding-left:' . $paddingLeft . ';padding-right:' . $paddingRight . ';padding-bottom:' . $paddingBottom . ';padding-top:' . $paddingTop . ';text-align:left;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                  <tr>
                    {columns_content}
                  </tr>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--[if mso | IE]></td></tr></table><![endif]-->
    ';
  }
}
