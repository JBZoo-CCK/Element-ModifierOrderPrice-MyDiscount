<?php
/**
 * JBZoo App is universal Joomla CCK, application for YooTheme Zoo component
 * @package     jbzoo
 * @version     2.x Pro
 * @author      JBZoo App http://jbzoo.com
 * @copyright   Copyright (C) JBZoo.com,  All rights reserved.
 * @license     MIT
 * @coder       Denis Smetannikov <denis@jbzoo.com>
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Class JBCartElementModifierOrderPriceMydiscount
 */
class JBCartElementModifierOrderPriceMydiscount extends JBCartElementModifierOrderPrice
{
    /**
     * @return JBCartValue
     */
    public function getRate()
    {
        $orderSum = $this->_order->getTotalForItems(); // получили сумму за все товары (без доставки и прочего)
        $discount = 0;

        if ($orderSum->compare($this->config->get('limit', 1000), '>=')) { // сравниваем c суммой из настроек
            $discount = $this->config->get('rate', 0);
        }

        // обязательно вернуть объект, добавляем знак минус (чтобы была скидка, а не наценка)
        return $this->_order->val($discount)->negative();
    }

}
