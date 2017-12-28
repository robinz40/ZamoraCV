composer require jms/translation-bundle "^1.3"
composer require jms/i18n-routing-bundle

AppKernel :
	new JMS\TranslationBundle\JMSTranslationBundle(),
        new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),