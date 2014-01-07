<?php

class tx_newrelic_hooks {

    /**
     * Handles and dispatches the shutdown of the current process.
     *
     * @return void
     */
    public function frontendPreprocessRequest() {
        /** @var \AOE\Newrelic\Service $service */
        $service = t3lib_div::makeInstance('Tx_Newrelic_Service');
        $service->setConfiguredAppName();
        $service->setTransactionNameDefault('Frontend-Pre');
    }


    /**
     * Handles and dispatches the shutdown of the current frontend process.
     *
     * @return void
     */
    public function frontendEndOfFrontend() {
        /** @var \AOE\Newrelic\Service $service */
        $service = t3lib_div::makeInstance('Tx_Newrelic_Service');

        if ($temp_extId = t3lib_div::_GP('eID'))        {
            $service->setTransactionNameImmutable('eId_'.$temp_extId);
        }
        $service->setTransactionName('Frontend');
        $service->addMemoryUsageCustomMetric();
        $service->addTslibFeCustomParameters();
    }

}