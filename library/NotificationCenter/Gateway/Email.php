<?php
/**
 * Created by JetBrains PhpStorm.
 * User: yanickwitschi
 * Date: 04.10.13
 * Time: 14:58
 * To change this template use File | Settings | File Templates.
 */

namespace NotificationCenter\Gateway;


class Email extends Base implements GatewayInterface
{
    /**
     * {@inheritdoc}
     */
    public function validateToken($strToken, $varValue)
    {
        // @todo
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyDca(&$arrDca)
    {
        $strPalette = 'email_subject,email_mode,email_text';

        if ($this->objLanguage->email_mode == 'textAndHtml') {
            $strPalette .= ',email_html';
        }

        $arrDca['palettes']['default'] .= $strPalette;
    }

    /**
     * {@inheritdoc}
     */
    public function send($arrTokens)
    {
        $objMail = new \Email();
        $objMail->subject   = \String::parseSimpleTokens($this->objLanguage->email_subject, $arrTokens);
        $objMail->text      = \String::parseSimpleTokens($this->objLanguage->email_text, $arrTokens);

        if ($this->objLanguage->email_mode == 'textAndHtml') {
            $objMail->html = \String::parseSimpleTokens($this->objLanguage->email_mode, $arrTokens);
        }

        $objMail->sendTo(\String::parseSimpleTokens($this->objLanguage->recipients, $arrTokens));
    }
}